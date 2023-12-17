<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Addons;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
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

    public function isOnline($site = "https://youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    public function checkmail()
    {
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $order->id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $order->id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $order->id)->where('atype', 'shipping')->first();

        return view('order_mail', compact('order', 'billing_address', 'shipping_address', 'OrderProduct'));
    }

    public function user_pass(Request $request)
    {
        $path = base_path('.env');
        $test = file_get_contents($path);
        $old_password =  env('MAIL_PASSWORD');

        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $checkmail = \App\Models\Mail::where('restaurant_id', $order->restaurant_id)->first();
        if (!$checkmail == null) {
            if (file_exists($path)) {
                file_put_contents($path, str_replace('MAIL_PASSWORD=' . $old_password . '', 'MAIL_PASSWORD=' . $checkmail->mail_password . '', $test));
            }
        }
    }

    public function user_mail()
    {
        $path = base_path('.env');
        $test = file_get_contents($path);
        $old_frommail =  env('MAIL_FROM_ADDRESS');

        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $checkmail = \App\Models\Mail::where('restaurant_id', $order->restaurant_id)->first();

        if (!$checkmail == null) {
            if (file_exists($path)) {
                file_put_contents($path, str_replace('MAIL_FROM_ADDRESS=' . $old_frommail . '', 'MAIL_FROM_ADDRESS=' . $checkmail->mail_username . '', $test));
            }
        }
    }

    public function checkenv(Request $request)
    {
        $path = base_path('.env');
        $test = file_get_contents($path);
        $old_username =  env('MAIL_USERNAME');

        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $checkmail = \App\Models\Mail::where('restaurant_id', $order->restaurant_id)->first();
        if (!$checkmail == null) {
            if (file_exists($path)) {
                file_put_contents($path, str_replace('MAIL_USERNAME=' . $old_username . '', 'MAIL_USERNAME=' . $checkmail->mail_username . '', $test));
                $this->user_mail($request);
                $this->user_pass($request);
            }
        }
    }

    public function configclear(Request $request)
    {
        Artisan::call('config:clear');
    }


    public function html_email(Request $request)
    {
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $checkmail = \App\Models\Mail::where('restaurant_id', $order->restaurant_id)->first();
        $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $order->id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $order->id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $order->id)->where('atype', 'shipping')->first();

        $data = array('tomail' => $order->billing_contact_email, 'tonamemail' => $order->billing_contact_name);
        Mail::send('order_mail', $data, function ($message) use ($data) {
            $message->to($data['tomail'], 'rk')->subject('Order');
            $message->from('anshu.coders@gmail.com', 'TheDinersClub');
        });
    }

    public function addOrder(Request $request)
    {

       

        $user_id = Auth::user()->id;

        $cart_data = Cart::where('user_id', Auth::user()->id)->get();

        $cart_product = [];
        $total_products_price_list = [];
        $discount = [];
        $total_products_sellprice_list = [];
        $only_addon = [];
        $only_addon_costprice = [];


        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id', $cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['cost_price'] = $get_products->cost_price;
                $cart_datas['product_finalprice'] = $get_products->final_price;
                $cart_datas['product_sellprice'] = $get_products->sell_price;
                $cart_datas['product_id'] = $get_products->id;
                $cart_datas['product_category'] = $get_products->category->name;
                $cart_datas['product_status'] = $get_products->status;
                $cart_datas['product_discount'] = $get_products->sell_price - $get_products->final_price;
                // $cart_datas['product_discount'] = $get_products->discount;
            }

            $total_cart_product = $cart_datas->product_finalprice * $cart_datas->quantity;
            $total_products_price_list[] = $total_cart_product;
            $discount[] = $cart_datas->product_discount * $cart_datas->quantity;
            $total_products_sellprice_list[] = $cart_datas->product_sellprice * $cart_datas->quantity;
            // unset($get_product);
            $imgs = $get_products->image;
            foreach ($imgs as $imgs) {
                if ($imgs->field_name == "product_thumbnail") {
                    $cart_datas['thumbnail'] = $imgs->path;
                }
            }
            unset($get_products->image);
            $get_addon = json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[] =  \App\Models\Addons::where('id', $addon)->get()->first();
                }

                $addon_costprice = null;
                $addon_price = null;
                foreach ($abc as $get_addons) {
                    $addon_price[] = $get_addons->price * $cart_datas->quantity;
                }

                $cart_datas['addon_total'] = array_sum($addon_price);
            } else {
            }
            $only_addon[] = $cart_datas->addon_total;
            $only_addon_costprice[] = $cart_datas->addon_total_costprice;

            $cart_product[] = $cart_datas;
        }


        $all_addons_total = array_sum($only_addon);
        $cart_product_subtotal = array_sum($total_products_sellprice_list);
        $cart_product_grandtotal = array_sum($total_products_price_list);
        $cart_product_discount = array_sum($discount);
        if ($request->type == "dining_in") {
            $order_data = [
                'user_id' => $user_id,
                'subtotal' => $cart_product_subtotal,
                'total_discount' => $cart_product_discount,
                'addons_total' => $all_addons_total,
                'grand_total' => $cart_product_grandtotal + $all_addons_total,
                'payment_method' => $request->payment_method,

                // 'billing_contact_name' => $request->billing_contact_name,
                // 'billing_contact_email' => $request->billing_contact_email,
                // 'billing_contact_number' => $request->billing_contact_number,
                // 'shipping_contact_name' => $shipping_contact_name,
                // 'shipping_contact_email' => $shipping_contact_email,
                // 'shipping_contact_number' => $shipping_contact_number,
                'status' => 0,
                'billing_contact_name' => auth()->user()->first_name .' '. auth()->user()->last_name,
                'billing_contact_email' => auth()->user()->email,
                'billing_contact_number' => auth()->user()->phone_number,
                'shipping_contact_name' => auth()->user()->first_name,
                'shipping_contact_email' => auth()->user()->email,
                'shipping_contact_number' => auth()->user()->phone_number,
                'order_note' => $request->order_note,

                'restaurant_id' => $cart_datas->restaurant_id,
                'payment_status' => "pending",
                'type' => $request->type,
                'tbl_reservation_id' => $request->tbl_reservation_id,

            ];
        } else {
            $order_data = [
                'user_id' => $user_id,
                'subtotal' => $cart_product_subtotal,
                'total_discount' => $cart_product_discount,
                'addons_total' => $all_addons_total,
                'grand_total' => $cart_product_grandtotal + $all_addons_total,
                'payment_method' => $request->payment_method,
                'billing_contact_name' => auth()->user()->first_name .' '. auth()->user()->last_name,
                'billing_contact_email' => auth()->user()->email,
                'billing_contact_number' => auth()->user()->phone_number,
                'shipping_contact_name' => auth()->user()->first_name,
                'shipping_contact_email' => auth()->user()->email,
                'shipping_contact_number' => auth()->user()->phone_number,
                'order_note' => $request->order_note,
                'status' => 0,
                'restaurant_id' => $cart_datas->restaurant_id,
                'payment_status' => "pending",
                'delivery_day' => $request->delivery_day,
                'delivery_time' => $request->delivery_time . ' ' . $request->time_at,
                'type' => $request->type,

            ];
        }

        $order = Order::create($order_data);


        if ($order) {
            $order_id = $order->id;
            if (!empty($cart_data) && count($cart_data) > 0) {
                $order_items = [];

                $total_cost_price = null;
                foreach ($cart_product as $cart_products) {
                    $product_total_price = $cart_products->product_finalprice * $cart_products->quantity;
                    $total_product_price = $product_total_price + $cart_products->addon_total;
                    #for getting addons cost price
                    $addons_cost = 0;
                    $data = null;
                    $final_addons_cost = 0;
                    $cc[] = $cart_products->addons_id;


                    if($cart_products->addons_id !="null"){
                        $addonsIds=json_decode($cart_products->addons_id);
                        for($i=0;$i<count($addonsIds);$i++){
                            $data=Addons::find($addonsIds[$i]);
                            $addons_cost=$addons_cost+$data->cost_price;
                        }
                    }
                    #for getting total costing to product include addons
                    $total_cost_price= ($cart_products->cost_price + $addons_cost) * $cart_products->quantity;
                    #end
                    $order_items[] = [
                        'order_id' => $order_id,
                        'product_id' => $cart_products->product_id,
                        'quantity' => $cart_products->quantity,
                        'price' => $cart_products->product_sellprice,
                        'addon_id' => $cart_products->addons_id,
                        'discount' => $cart_products->product_discount,
                        'addons_total' => $cart_products->addon_total,
                        'total_price' => $total_product_price,
                        'total_cost_price' => $total_cost_price,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }

            if (!empty($order_items)) {
                $order_products = OrderProduct::insert($order_items);
            } else {
                $order_products = true;
            }

            if ($order_products && $order) {
                // $this->clearCart($request);
                // $this->configclear($request);
                // $this->checkenv($request);

                return redirect()->route('payment.page.view', encrypt($order_id));
            } else {
                return redirect()->back()->with('error', trans('translation.error'));
            }
        }
    }

    public function orderConfirmIndex(Request $request, $order_id)
    {

        try {
            $decrypt_order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(

                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        $user_id = Auth::user()->id;
        $order = Order::findOrfail($decrypt_order_id);
        $this->html_email($request);
        if ($order->user_id != $user_id) {
            return redirect()->route('index')->with('error', trans('translation.not_found'));
        }
        $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $decrypt_order_id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $decrypt_order_id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $decrypt_order_id)->where('atype', 'shipping')->first();

        return view('pages.user.checkout.order-confirm', compact('order', 'billing_address', 'shipping_address', 'OrderProduct'));
    }
}
