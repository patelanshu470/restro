<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\State;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function clearCart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $data = Cart::where('user_id', $user_id);
            $result = $data->delete();
            if ($result) {
                return redirect()->route('user.view_cart')
                    ->with('success', trans('translation.cart_cleared'));
            }
        } else {
            abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.',
            ], 401));
        }
        $cartData = Cart::where('user_id', $user_id)->get();
        if ($cartData == '[]' || $cartData == NULL) {
            return redirect()->route('user.view_cart');
        }
    }

    public function paymentPage($order_id)
    {

        #throw error when Order-id is Manipulated by User
        try {
            $decrypt_order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(

                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        $cart_product = [];
        $cart_data = Cart::where('user_id', Auth::user()->id)->get();
        if (count($cart_data) > 0) {
            $cart_product = [];
            foreach ($cart_data as $cart_datas) {
                $get_product = Product::where('id', $cart_datas->product_id)->get();
                foreach ($get_product as $get_products) {
                    $cart_datas['product_name'] = $get_products->name;
                    $cart_datas['product_id'] = $get_products->id;
                    $cart_datas['product_category'] = $get_products->category->name;
                    $cart_datas['product_status'] = $get_products->status;
                    $cart_datas['discount'] = $get_products->discount;
                    $cart_datas['sell_price'] = $get_products->sell_price;
                    $cart_datas['product_price'] = $get_products->final_price;
                    $cart_datas['discount_amount'] = $get_products->sell_price - $get_products->final_price;
                }
                $cart_product[] = $cart_datas;
            }

            $customer_order_data= Order::find($decrypt_order_id);
            $total_discount = $customer_order_data->total_discount;
            $all_addons_total =$customer_order_data->addons_total;
            $payment_amount =$customer_order_data->grand_total * 100;

            $order_id=null;
            $order_id=encrypt($decrypt_order_id);
          

            #For getting trending products count according to Confirm Order;
               $get_product = Product::where('status', 1)->get();

               $products = DB::table('products')
                   ->join('order_products', 'order_products.product_id', '=', 'products.id')
                   ->join('orders', 'orders.id', '=', 'order_products.order_id')
                   ->where([['orders.payment_status', '=', 'captured']])  //change "confirm" string according to Payment Method
                   ->select('products.*', 'orders.payment_status')
                   ->get();
   
               $counts = [];
               $uniqueIds = [];
               #For getting count
               foreach ($products as $product) {
                   $id = $product->id;
                   if (!in_array($id, $uniqueIds)) {
                       $counts[$id] = 1;
                       $uniqueIds[] = $id;
                   } else {
                       $counts[$id]++;
                   }
               }
   
               #For getting all products without dublicate ,here count will be added in all products to getting trend
               $product = [];
               foreach ($get_product as $product_datas) {
                   if (in_array($product_datas->id, $uniqueIds)) {
                       $img = $product_datas->image;
                       foreach ($img as $img) {
                           if ($img->field_name == "product_thumbnail") {
                               $product_datas['thumbnail'] = $img->path;
                           }
                       }
   
                       #Getting AVG Rating of all products
                       $rating = null;
                       $totalRating = null;
                       $rating_sum = null;
                       $rating = ProductReview::where([['product_id', '=', $product_datas->id]])->pluck('rating');
                       $totalRating = count($rating);
                       if ($totalRating > 0) {
                           $rating_sum = $rating->sum();
                           $product_datas["avg_rating"] = ceil($rating_sum / $totalRating);
                           $product_datas["total_rating"] = $totalRating;
                       } else {
                           $product_datas["avg_rating"] = null;
                           $product_datas["total_rating"] = $totalRating;
                       }
                       #end 
   
                       unset($product_datas->image);
                       $id = $product_datas->id;
                       $product_datas->count = $counts[$id];
                       $product[] = $product_datas;
                   }
               }
               #For sorting according to Count value
               usort($product, function ($a, $b) {
                   return $b->count - $a->count;
               });
          
            #end

            return view('pages.user.payment.payment', compact('product','order_id', 'total_discount', 'cart_product', 'payment_amount', 'all_addons_total'));
        }


     

        return redirect()->back()->with('error', trans('translation.error'));
    }

    public function payNow(Request $request, $order_id)
    {

        #throw error when Order-id is Manipulated by User
        try {
            $decrypt_order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        $input = $request->all();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (empty($payment)) {
            return redirect()->back()
                ->with('error', 'Something went wrong ,try to refresh the page');
        }

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        if ($payment['status'] == "authorized" or $payment['status'] == "captured") {

            $this->clearCart();
            $this->storePaymentStatus($input['razorpay_payment_id'], $decrypt_order_id);

            $order_id = null;
            $order_id = encrypt($decrypt_order_id);
            return redirect()->route('user.order_confirm', $order_id)
                ->with('success', 'Payment is Successfull');
        } else {
            return redirect()->back()
                ->with('error', 'Payment failed');
        }
    }


    public function storePaymentStatus($payment_id, $order_id)
    {

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($payment_id);
        if ($payment_id or $payment['status']) {
            #store payment in database
            $paymentData = new Payment();
            $paymentData->payment_id = $payment_id;

            $order = Order::findOrFail($order_id);
            $order->payment_status = $payment['status'];
            $order->save();
            // $paymentData->payment_method = $order->payment_method;
            $paymentData->amount = $order->grand_total;

            $paymentData->order_id = $order_id;
            $paymentData->payment_status = $payment['status'];
            $paymentData->save();
        }
    }
}
