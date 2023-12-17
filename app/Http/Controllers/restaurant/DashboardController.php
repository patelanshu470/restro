<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB ;

class DashboardController extends Controller
{
    public function index()
    {
      
    #financial
    $all_orders = null;
    $total_sale = null;
    $restro_data = null;
    $restro_total_product = null;
    $all_order_costing = null;
    $profit_loss = null;

        #For getting all the confirm order in given date range

        $currentMonth = date('m');
        $start_date = date('Y-' . $currentMonth . '-01 00:00:00');
        $end_date = date('Y-' . $currentMonth . '-t 23:59:59');
        $all_orders = Order::where([
            ['payment_status', '=', 'captured'],
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date]
        ])->get();


        // $dates = explode(" - ", $request->daterange);
        // $start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay();
        // $end_date = \Carbon\Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay();
        $all_orders = Order::where([
            ['restaurant_id', '=', Auth()->user()->id],
            ['payment_status', '=', 'captured'],
            ['created_at', '>=', $start_date],
            ['created_at', '<=', $end_date]
        ])->get();

        #For getting Total amount of sell and total costing of that order id
        $total_sale = null;

        foreach ($all_orders as $order) {
            #For getting Total amount of sell
            $total_sale = $total_sale + (int)$order->grand_total;
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
        $restro_data = Restaurant::where([['user_id','=',Auth()->user()->id]])->get()->first();
        $restro_total_product = Product::where([['restaurent_id', '=',$restro_data->id],['status', '=', 1]])->count();
    #end

    $restaurant_fetch = Restaurant::where('user_id', Auth()->user()->id)->first();

    #Getting trending product
       $get_product = Product::where([['restaurent_id','=',$restaurant_fetch->id],['status', 1]])->limit(2)->get();

        #For getting trending products count according to Confirm Order;
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

    #end trending

    #getting all reviews of customers     
      $product_review=ProductReview::where('restaurant_id','=',$restro_data->id)->get();

    #Restaurent Rating
    $reviewCount = ProductReview::where('restaurant_id', $restaurant_fetch->id)->count();
    $ratingSum = ProductReview::where('restaurant_id', $restaurant_fetch->id)->sum('rating');
    $averageRating = $reviewCount > 0 ? $ratingSum / $reviewCount : 0;
    $restro_rating = round($averageRating, 1);
    #end


        return view('pages.restaurant.dashboard',compact('reviewCount','restro_rating','restro_data','all_orders','product_review','product','all_order_costing','profit_loss','total_sale','restro_total_product'));
    }
}
