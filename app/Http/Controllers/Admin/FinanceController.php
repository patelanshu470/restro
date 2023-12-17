<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    #Restaurent Profit & Loss
    public function restaurentStats(Request $request)
    {
        $all_orders = null;
        $total_sale = null;
        $restro_data = null;
        $restro_total_product = null;
        $all_order_costing = null;
        $profit_loss = null;
        if ($request->daterange and $request->restaurent_id) {

            #For getting all the confirm order in given date range
            $dates = explode(" - ", $request->daterange);
            $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay();
            $all_orders = Order::where([
                ['restaurant_id', '=', $request->restaurent_id],
                ['payment_status', '=', 'captured'],
                ['created_at', '>=', $start_date],
                ['created_at', '<=', $end_date]
            ])->get();

            #For getting Total amount of sell and total costing of that order id
            $total_sale = null;

            foreach ($all_orders as $order) {
                #For getting Total amount of sell
                $total_sale = $total_sale + (float)$order->grand_total;
                $single_order[] = OrderProduct::where([['order_id', '=', $order->id]])->get();
                $all_order_costing = 0;
                foreach ($single_order as $singles) {
                    $single_cost = 0;
                    foreach ($singles as $single) {
                        $single_cost = $single_cost + $single->total_cost_price;
                    }
                    $all_order_costing = $all_order_costing + $single_cost;
                }
            }

            #getting profit or loss
            $profit_loss = null;
            $profit_loss = $total_sale - $all_order_costing;

            // For getting restaurent details
            $restro_data = Restaurant::find($request->restaurent_id);
            $restro_total_product = Product::where([['restaurent_id', '=', $request->restaurent_id], ['status', '=', 1]])->count();
        }



        $restaurents = Restaurant::all();
        return view('pages.admin.finance.restaurent_profit_loss', compact('all_order_costing', 'profit_loss', 'restaurents', 'all_orders', 'total_sale', 'restro_data', 'restro_total_product'));
    }


      
        public function allStats(Request $request)
        {
            $all_orders = null;
            $total_sale = null;
            $restro_data = null;
            $restro_total_product = null;
            $all_order_costing = null;
            $profit_loss = null;
            $total_branch=null;
            $active_users=null;
            $active_products=null;
            if ($request->daterange) {

                #For getting all the confirm order in given date range
                $dates = explode(" - ", $request->daterange);
                $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay();
                $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay();
                $all_orders = Order::where([
                    ['payment_status', '=', 'captured'],
                    ['created_at', '>=', $start_date],
                    ['created_at', '<=', $end_date]
                ])->get();

                #For getting Total amount of sell and total costing of that order id
                $total_sale = null;

                foreach ($all_orders as $order) {
                    #For getting Total amount of sell
                    $total_sale = $total_sale + (float)$order->grand_total;
                    $single_order[] = OrderProduct::where([['order_id', '=', $order->id]])->get();
                    $all_order_costing = 0;
                    foreach ($single_order as $singles) {
                        $single_cost = 0;
                        foreach ($singles as $single) {
                            $single_cost = $single_cost + $single->total_cost_price;
                        }
                        $all_order_costing = $all_order_costing + $single_cost;
                    }
                }

                #getting profit or loss
                $profit_loss = null;
                $profit_loss = $total_sale - $all_order_costing;

                // For getting restaurent details
                $restro_total_product = Product::where([['status', '=', 1]])->count();

                $total_branch=count(Restaurant::all());
                $active_users=count(User::where([['role','=',0]])->get());
                $active_products=count(Product::where([['status','=',1]])->get());

            }



            $restaurents = Restaurant::all();
            return view('pages.admin.finance.profit_loss', compact('active_products','active_users','total_branch','all_order_costing', 'profit_loss', 'restaurents', 'all_orders', 'total_sale', 'restro_total_product'));
        }
}
