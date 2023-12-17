<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
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
                #For getting all the confirm order in given date range
                // $currentMonth = \Carbon\Carbon::now()->startOfMonth();
                $currentMonth = date('m');
                $start_date = date('Y-' . $currentMonth . '-01 00:00:00');
                $end_date = date('Y-' . $currentMonth . '-t 23:59:59');
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

                // For getting Product details
                $restro_total_product = Product::where([['status', '=', 1]])->count();

                $total_branch=count(Restaurant::all());
                $active_users=count(User::where([['role','=',0]])->get());
                $active_products=count(Product::where([['status','=',1]])->get());

                #This Year Totoal earning
                $currentYear = date('Y');
                $yearly_orders = Order::where([
                    ['payment_status', '=', 'captured'],
                    [DB::raw('YEAR(created_at)'), '=', $currentYear]
                ])->sum('grand_total');

            $restaurents = Restaurant::all();

            $month = date('m');

            #Monthly Sell
            // $CurrentMonthSell = OrderProduct::with('getproductsData')
            // ->join('products', 'order_products.product_id', '=', 'products.id')
            // ->join('categories', 'products.product_category', '=', 'categories.id')
            // ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            // ->select('products.id', 'products.name', 'categories.id as category_id', 'order_products.product_id', DB::raw('SUM(order_products.quantity) as total_quantity'))
            // ->whereMonth('order_products.created_at', '=', $month)
            // ->where('categories.status', 1)
            // ->where('sub_categories.status', 1)
            // ->groupBy('products.id', 'products.name', 'categories.id', 'order_products.product_id')
            // ->orderByDesc('total_quantity')
            // ->get();

            #Earning Categories
            $topCategories = OrderProduct::join('products', 'order_products.product_id', '=', 'products.id')
            ->join('categories', 'products.product_category', '=', 'categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->select('categories.id as category_id', DB::raw('SUM(order_products.quantity) as total_quantity'), DB::raw('SUM(order_products.total_price) as total_price_sum'))
            ->whereMonth('order_products.created_at', '=', $month)
            ->where('categories.status', 1)
            ->where('sub_categories.status', 1)
            ->where('orders.payment_status', 'captured')
            ->groupBy('categories.id')
            ->orderByDesc('total_quantity')
            ->limit(3)
            ->get();

            #All Branches
            // $allBranches = Restaurant::all();
            $allBranches = Restaurant::with('getaddress')->get();

            #Bar Graph
            $monthlyOrders = Order::where('payment_status', '=', 'captured')->selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, COUNT(*) AS count')
            ->groupBy('year', 'month')
            ->get();

        return view('pages.admin.dashboard', compact('active_products','active_users','total_branch','all_order_costing', 'profit_loss', 'restaurents', 'all_orders', 'total_sale', 'restro_total_product','yearly_orders','topCategories','allBranches','monthlyOrders'));
    }
}
