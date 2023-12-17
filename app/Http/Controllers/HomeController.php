<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Addons;
use App\Models\ProductReview;
use App\Models\Promotion;
use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    #This functuion is use to check auth
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        $final = [];
        foreach ($restaurant as $datas) {
            $address = $datas->address;
            foreach ($address as $address) {
                if ($address->addresable_type  == get_class($datas)) {
                    $datas['street'] = $address->street;
                    $datas['landmark'] = $address->landmark;
                    $datas['pincode'] = $address->pincode;
                    $datas['country'] = $address->country;
                }
            }
            $img = $datas->image;
            foreach ($img as $img) {
                if ($img->field_name == "restaurant_image") {
                    $datas['img'] = $img->path;
                }
            }
            unset($datas->address);

               
                #Getting AVG Rating of all restaurent
                    $reviewCount = ProductReview::where([['restaurant_id', $datas->id],['status','=',1]])->count();
                    // Get the sum of ratings for the restaurant
                    $ratingSum = ProductReview::where([['restaurant_id', $datas->id],['status','=',1]])->sum('rating');
                    // Calculate the average rating
                    $averageRating = $reviewCount > 0 ? $ratingSum / $reviewCount : 0;
                    // Round the average rating to 1 decimal place
                    $averageRating = ceil($averageRating);
                    $datas['avg_rating'] = $averageRating;
                    $datas['total_rating'] = $reviewCount;
                #end 

            $final[] = $datas;
        }

        
        #category..
        $category = Category::where([['status', '=', 1]])->limit(10)->get();
        #product..
        $get_product = Product::where('status', 1)->get();

        #For getting trending products count according to Confirm Order;
        $products = DB::table('products')
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where([['orders.payment_status', '=', 'captured'],['products.status','=',1]])  //change "confirm" string according to Payment Method
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

       

        #Cart Data....
        if (Auth::check()) {
            $cart_data = Cart::where('user_id', Auth::user()->id)->get();
            $cart_product = [];
            foreach ($cart_data as $cart_datas) {
                $get_product = Product::where('id', $cart_datas->product_id)->get();
                foreach ($get_product as $get_products) {
                    $cart_datas['product_name'] = $get_products->name;
                    $cart_datas['product_price'] = $get_products->final_price;
                    $cart_datas['product_id'] = $get_products->id;
                }
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
                    foreach ($abc as $get_addons) {
                        $addon_price[] = $get_addons->price;
                    }
                    $cart_datas['addon_total'] = array_sum($addon_price);
                }
                $total_cart_product = $cart_datas->product_price * $cart_datas->quantity;
                $sum[] = $total_cart_product;
                $cart_product[] = $cart_datas;
            }
        } else {
            $cart_product = null;
        }

        if ($cart_data = []) {
            $cart_datas['total'] = array_sum($sum);
        }



        $promotion_large = Promotion::where('type', '=', "large_banner")->first();
        $promotion_small = Promotion::where('type', '=', "small_banner")->first();
        $promotion_gif = Promotion::where('type', '=', "gif_banner")->first();
        $bg_banner = Promotion::where('type', '=', "bg_banner")->first();


        // getting all products as popular product
        $popular_product = [];
        $all_products = Product::where([['status','=',1]])->with('image')->get();
        // $rating=[];
        foreach ($all_products as $item) {
            $imgs = $item->image;
            foreach ($imgs as $imgs) {

                if ($imgs->field_name == "product_thumbnail") {
                    $item['thumbnail'] = $imgs->path;
                }
            }

            #Getting AVG Rating of all products
            $rating = null;
            $totalRating = null;
            $rating_sum = null;
            $rating = ProductReview::where([['product_id', '=', $item->id]])->pluck('rating');
            $totalRating = count($rating);
            if ($totalRating > 0) {
                $rating_sum = $rating->sum();
                $item["avg_rating"] = ceil($rating_sum / $totalRating);
                $item["total_rating"] = $totalRating;
            } else {
                $item["avg_rating"] = null;
                $item["total_rating"] = $totalRating;
            }


            $popular_product[] = $item;
        }


        return view('pages.user.dashboard', compact('bg_banner','popular_product', 'final', 'category', 'product', 'cart_product', 'promotion_large', 'promotion_small', 'promotion_gif'));
    }
    public function categoryPage()
    {

        $restaurant = Restaurant::all();
        $final = [];
        foreach ($restaurant as $datas) {
            $address = $datas->address;
            foreach ($address as $address) {
                if ($address->addresable_type  == get_class($datas)) {
                    $datas['street'] = $address->street;
                    $datas['landmark'] = $address->landmark;
                    $datas['pincode'] = $address->pincode;
                    $datas['country'] = $address->country;
                }
            }
            $img = $datas->image;
            foreach ($img as $img) {
                if ($img->field_name == "restaurant_image") {
                    $datas['img'] = $img->path;
                }
            }
            unset($datas->address);
            $final[] = $datas;
        }

        #category..
        $category = Category::where([['status', '=', 1]])->limit(10)->get();
        #product..
        $get_product = Product::where('status', 1)->get();

        #For getting trending products count according to Confirm Order;
        $products = DB::table('products')
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where([['orders.payment_status', '=', 'captured'],['products.status','=',1]])  //change "confirm" string according to Payment Method
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

        #Cart Data....
        if (Auth::check()) {

            $cart_data = Cart::where('user_id', Auth::user()->id)->get();
            $cart_product = [];
            foreach ($cart_data as $cart_datas) {
                $get_product = Product::where('id', $cart_datas->product_id)->get();
                foreach ($get_product as $get_products) {
                    $cart_datas['product_name'] = $get_products->name;
                    $cart_datas['product_price'] = $get_products->final_price;
                    $cart_datas['product_id'] = $get_products->id;
                }
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
                    foreach ($abc as $get_addons) {
                        $addon_price[] = $get_addons->price;
                    }
                    $cart_datas['addon_total'] = array_sum($addon_price);
                }
                $total_cart_product = $cart_datas->product_price * $cart_datas->quantity;
                $sum[] = $total_cart_product;
                $cart_product[] = $cart_datas;
            }
        } else {
            $cart_product = null;
        }

        if ($cart_data = []) {
            $cart_datas['total'] = array_sum($sum);
        }


        $promotion_large = Promotion::where('type', '=', "large_banner")->first();
        $promotion_small = Promotion::where('type', '=', "small_banner")->first();
        $bg_banner = Promotion::where('type', '=', "bg_banner")->first();

        // dd($product);
        return view('pages.user.category.categoryIndex', compact('bg_banner','final', 'category', 'product', 'cart_product', 'promotion_large', 'promotion_small'));
    }
}
