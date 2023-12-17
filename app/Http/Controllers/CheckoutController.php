<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Addons;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Order;
use App\Models\Reservation;
use Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function add_to_cart(Request $request)
    {
        // dd($request->all());
        $check_restaurant_id = Cart::first();
        if (isset($check_restaurant_id)) {
            if ($request->restaurant_id != $check_restaurant_id->restaurant_id ) {
                // dd($check_restaurant_id->restaurant_id);
                $user_id = Auth::user()->id;
                $data = Cart::where('user_id', $user_id)->delete();
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->product_id,
                    'addons_id' => json_encode($request->addon_id),
                    'quantity' => $request->quantity,
                    'restaurant_id' => $request->restaurant_id,
                ]);

            } else {
                // $check_product = Cart::where([['product_id',$request->product_id],['user_id',Auth::user()->id]])->first();
                // if ($check_product) {
                //     $id = $check_product->id;
                //     $cart = Cart::find($id);
                //     $cart->update([
                //         'quantity' => $request->quantity + $check_product->quantity,
                //     ]);
                // } else {
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $request->product_id,
                        'addons_id' => json_encode($request->addon_id),
                        'quantity' => $request->quantity,
                        'restaurant_id' => $request->restaurant_id,
                    ]);
                // }
            }
        } else {
            // $check_product = Cart::where([['product_id',$request->product_id],['user_id',Auth::user()->id]])->first();
            //     if ($check_product) {
            //         $id = $check_product->id;
            //         $cart = Cart::find($id);
            //         $cart->update([
            //             'quantity' => $request->quantity + $check_product->quantity,
            //         ]);
            //     } else {
                    Cart::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $request->product_id,
                        'addons_id' => json_encode($request->addon_id),
                        'quantity' => $request->quantity,
                        'restaurant_id' => $request->restaurant_id,
                    ]);
                // }
        }

        // $addons_check = json_decode($check_product->addons_id);
        // for ($i=0; $i <count($request->addons_id) ; $i++) {
        //     if(!in_array($request->addons_id[$i],$addons_check))
        //     {
        //         $id = $check_product->id;
        //         $cart = Cart::find($id);
        //         // $cart->update([
        //         //     'addons_id' => $request->addons_id,
        //         // ]);
        //     }
        // }
        // $check_restaurant_id->restaurant_id;

        return back()->with('success', 'Add to cart Successfully');
    }
    public function delete_to_cart(Request $request)
    {
        Cart::find($request->id)->delete();
        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        $cart_product = [];
        $sum = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id',$cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
            }
            // unset($get_product);
            $imgs=$get_products->image;
            foreach($imgs as $imgs){
                if($imgs->field_name == "product_thumbnail"){
                    $cart_datas['thumbnail']= $imgs->path;
                }
            }
            unset($get_products->image);
            $get_addon=json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[]=   Addons::where('id',$addon)->get()->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[]= $get_addons->price;
                }
                $cart_datas['addon_total'] = array_sum($addon_price);
            }
            $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
            $sum[] = $total_cart_product;
            $cart_product[] = $cart_datas;
        }
        $cart_datas['total'] = array_sum($sum);
        // dd($cart_data);
        echo view('pages.user.product.add_to_cart',compact('cart_product'));
    }

    public function view_cart()
    {


        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        $cart_product = [];
        // dd($cart_data);
        $only_addon = [];
        $sum = [];
        $discount = [];
        $all_quantity_addon_totals = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id',$cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
                $cart_datas['product_category'] = $get_products->category->name;
                $cart_datas['product_status'] = $get_products->status;
                $cart_datas['product_discount'] = $get_products->sell_price - $get_products->final_price;
            }
            $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
            $sum[] = $total_cart_product;
            $discount[] = $cart_datas->product_discount *$cart_datas->quantity;
            // unset($get_product);
            $imgs=$get_products->image;
            foreach($imgs as $imgs){
                if($imgs->field_name == "product_thumbnail"){
                    $cart_datas['thumbnail']= $imgs->path;
                }
            }
            unset($get_products->image);
            $get_addon=json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[]=  \App\Models\Addons::where('id',$addon)->get()->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[]= $get_addons->price;
                    $cart_datas['addon_total'] = $get_addons->price;
                    $cart_datas['all_quantity_addon_total'] = $get_addons->price * $cart_datas->quantity;
                }
            }
            $only_addon[] = $cart_datas->addon_total;
            $all_quantity_addon_totals[] = $cart_datas->all_quantity_addon_total;
            $cart_product[] = $cart_datas;
        }
        // dd($cart_product);
        $all_addons_total = array_sum($only_addon);
        $quantity_addons_total = array_sum($all_quantity_addon_totals);
        $cart_product_total = array_sum($sum);
        $cart_product_discount = array_sum($discount);
        return view('pages.user.product.cart_view',compact('cart_product','cart_product_total','all_addons_total','cart_product_discount','quantity_addons_total'));
    }

    public function view_cart_incr_product(Request $request)
    {
        $check_product = Cart::where([['id',$request->id],['user_id',Auth::user()->id]])->first();
        $id = $check_product->id;
        $cart = Cart::find($id);
        $cart->update([
            'quantity' => $check_product->quantity + 1,
        ]);

        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        $cart_product = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id',$cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
            }
            unset($get_products->image);
            $get_addon=json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[]=  \App\Models\Addons::where('id',$addon)->get()->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[]= $get_addons->price;
                    // $cart_datas['addon_total'] = $get_addons->price;
                }
                $cart_datas['all_quantity_addon_total'] = $get_addons->price * $cart_datas->quantity;
                $cart_datas['addon_total'] = array_sum($addon_price);
            }
            $only_addon[] = $cart_datas->addon_total;
            $all_quantity_addon_totals[] = $cart_datas->all_quantity_addon_total;
            $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
            $sum[] = $total_cart_product;
            $cart_product[] = $cart_datas;
        }
        $cart_datas['total_value'] = array_sum($sum);
        $cart_product_total = array_sum($sum);
        $all_addons_total = array_sum($only_addon);
        $all_addons_total_products = array_sum($all_quantity_addon_totals);
        $cart_datas['total'] = $cart_product_total + $all_addons_total_products;
        $cart_datas['addons_all_total'] = $all_addons_total_products;

        return response()->json($cart_datas);
    }

    public function view_cart_decr_product(Request $request)
    {
        $check_product = Cart::where([['id',$request->id],['user_id',Auth::user()->id]])->first();
        $id = $check_product->id;
        $cart = Cart::find($id);
        $cart->update([
            'quantity' => $check_product->quantity - 1,
        ]);

        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        $cart_product = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id',$cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
            }
            unset($get_products->image);
            $get_addon=json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[]=  \App\Models\Addons::where('id',$addon)->get()->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[]= $get_addons->price;
                }
                $cart_datas['all_quantity_addon_total'] = $get_addons->price * $cart_datas->quantity;
                $cart_datas['addon_total'] = array_sum($addon_price);
            }
            $only_addon[] = $cart_datas->addon_total;
            $all_quantity_addon_totals[] = $cart_datas->all_quantity_addon_total;
            $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
            $sum[] = $total_cart_product;
            $cart_product[] = $cart_datas;
        }
        $cart_datas['total_value'] = array_sum($sum);
        $cart_product_total = array_sum($sum);
        $all_addons_total = array_sum($only_addon);
        $all_addons_total_products = array_sum($all_quantity_addon_totals);
        $cart_datas['total'] = $cart_product_total + $all_addons_total_products;
        $cart_datas['addons_all_total'] = $all_addons_total_products;

        return response()->json($cart_datas);
    }

    public function delete_to_view_cart(Request $request)
    {
        Cart::find($request->id)->delete();

        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        $cart_product = [];
        // dd($cart_data);
        $only_addon = [];
        $sum = [];
        $discount = [];
        $all_quantity_addon_totals = [];
        foreach ($cart_data as $cart_datas) {
            $get_product = Product::where('id',$cart_datas->product_id)->get();
            foreach ($get_product as $get_products) {
                $cart_datas['product_name'] = $get_products->name;
                $cart_datas['product_price'] = $get_products->final_price;
                $cart_datas['product_id'] = $get_products->id;
                $cart_datas['product_category'] = $get_products->category->name;
                $cart_datas['product_status'] = $get_products->status;
                $cart_datas['product_discount'] = $get_products->discount;
            }
            $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
            $sum[] = $total_cart_product;
            $discount[] = $cart_datas->product_discount;
            // unset($get_product);
            $imgs=$get_products->image;
            foreach($imgs as $imgs){
                if($imgs->field_name == "product_thumbnail"){
                    $cart_datas['thumbnail']= $imgs->path;
                }
            }
            unset($get_products->image);
            $get_addon=json_decode($cart_datas->addons_id);
            if ($get_addon) {
                $abc = [];
                foreach ($get_addon as $addon) {
                    $abc[]=  \App\Models\Addons::where('id',$addon)->get()->first();
                }
                foreach ($abc as $get_addons) {
                    $addon_price[]= $get_addons->price;
                    $cart_datas['addon_total'] = $get_addons->price;
                    $cart_datas['all_quantity_addon_total'] = $get_addons->price * $cart_datas->quantity;
                }
            }
            $only_addon[] = $cart_datas->addon_total;
            $all_quantity_addon_totals[] = $cart_datas->all_quantity_addon_total;
            $cart_product[] = $cart_datas;
        }
        // dd($cart_product);
        $all_addons_total = array_sum($only_addon);
        $quantity_addons_total = array_sum($all_quantity_addon_totals);
        $cart_product_total = array_sum($sum);
        $cart_product_discount = array_sum($discount);
        echo view('pages.user.product.ajax_view_cart',compact('cart_product','cart_product_total','all_addons_total','cart_product_discount','quantity_addons_total'));
    }

    // attention:
    public function checkout()
    {
        $cart_data = Cart::where('user_id',Auth::user()->id)->get();
        if (count($cart_data) > 0) {
            $cart_product = [];
            $only_addon = [];
            $sum = [];
            $discount = [];
            $all_quantity_addon_totals = [];
            foreach ($cart_data as $cart_datas) {
                $get_product = Product::where('id',$cart_datas->product_id)->get();
                foreach ($get_product as $get_products) {
                    $cart_datas['product_name'] = $get_products->name;
                    $cart_datas['product_price'] = $get_products->final_price;
                    $cart_datas['product_id'] = $get_products->id;
                    $cart_datas['product_category'] = $get_products->category->name;
                    $cart_datas['product_status'] = $get_products->status;
                    $cart_datas['product_discount'] = $get_products->sell_price - $get_products->final_price;
                }
                $total_cart_product = $cart_datas->product_price*$cart_datas->quantity;
                $sum[] = $total_cart_product;
                $discount[] = $cart_datas->product_discount *$cart_datas->quantity;
                // unset($get_product);
                $imgs=$get_products->image;
                foreach($imgs as $imgs){
                    if($imgs->field_name == "product_thumbnail"){
                        $cart_datas['thumbnail']= $imgs->path;
                    }
                }
                unset($get_products->image);
                $get_addon=json_decode($cart_datas->addons_id);
                if ($get_addon) {
                    $abc = [];
                    foreach ($get_addon as $addon) {
                        $abc[]=  \App\Models\Addons::where('id',$addon)->get()->first();
                    }
                    foreach ($abc as $get_addons) {
                        $addon_price[]= $get_addons->price;
                        $cart_datas['addon_total'] = $get_addons->price;
                        $cart_datas['all_quantity_addon_total'] = $get_addons->price * $cart_datas->quantity;
                    }
                }
                $only_addon[] = $cart_datas->addon_total;
                $all_quantity_addon_totals[] = $cart_datas->all_quantity_addon_total;
                $cart_product[] = $cart_datas;
            }

            $all_addons_total = array_sum($only_addon);
            $quantity_addons_total = array_sum($all_quantity_addon_totals);
            $cart_product_total = array_sum($sum);
            $cart_product_discount = array_sum($discount);

            #Gettting this logged in user Reservation data
            $today = Carbon::now()->format('Y-m-d');

            $check_reservation =Reservation::where([
            ['user_id','=',auth()->user()->id],
            ['res_date','=',$today],
            ['status','=','approve'],
            ])->get();

            $check_order=null;
            $check_restaurant=null;
            if(count($check_reservation)==0){
                $check_reservation=null;
            }else{
                $check_restaurant = Cart::where('user_id',Auth::user()->id)->first();
                $check_order=Order::where([['tbl_reservation_id','=',$check_reservation[0]->id],['payment_status', '=', 'captured']])->get()->first();
            }

            return view('pages.user.checkout.checkout',compact('check_order','check_reservation','cart_product','cart_product_total','all_addons_total','cart_product_discount','quantity_addons_total','check_restaurant'));
        } else {
            return back()->with('error', 'Your Cart is Empty');
        }
    }

    public function clear_cart(Request $request)
    {
        // dd($request->all());
        // return "Working";
        // return redirect()->route('user.add_cart');
    }
}
