<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Address;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductReview;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index($id)
    {
        #restaurants
        $restaurant = Restaurant::with('address')->find($id);
        if (!$restaurant) {
            abort(404);
        }
        foreach($restaurant->address as $datas){
            $addresess = $datas;
        }
        $gallary = [];
        for($i=0;$i<count($restaurant->image);$i++){
            $img=$restaurant->image[$i];

             if($img->field_name == "restaurant_gallary"){
                $gallary[]= $img->path;
            }

        }
        
        $total_rating = ProductReview::where('restaurant_id', $id)->count();
        // Get the sum of ratings for the restaurant
        $ratingSum = ProductReview::where('restaurant_id', $id)->sum('rating');
        // Calculate the average rating
        $avg_rating = ceil($total_rating > 0 ? $ratingSum / $total_rating : 0);

       
        $restaurant['restaurant_gallary']=$gallary;

        #products...
        $restro_id = $restaurant->id;
        $get_product = Product::where('restaurent_id',$restro_id)->get();
        $product=[];
        foreach($get_product as $product_datas){
            $img=$product_datas->image;
            foreach($img as $img){
                if($img->field_name == "product_thumbnail"){
                    $product_datas['thumbnail']= $img->path;
                }
            }


            #Getting AVG Rating of all product
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
           $product[]=$product_datas;
        }

        #category...
        $category = Category::where([['restaurent_id','=',$id],["status",'=',1]])->get();
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();

        return view('pages.user.restaurant.view',compact('total_rating','avg_rating','restaurant','addresess','product','category','min_date','max_date'));
    }


    public function listing()
    {

        $restaurant = Restaurant::all();
        $final=[];
        foreach($restaurant as $datas){
            $address=$datas->address;
            foreach($address as $address){
                if($address->addresable_type  == get_class($datas)){
                    $datas['street']= $address->street;
                    $datas['landmark']= $address->landmark;
                    $datas['pincode']= $address->pincode;
                    $datas['country']= $address->country;
                }
            }
            $img = $datas->image;
            foreach ($img as $img) {
                if ($img->field_name == "restaurant_image") {
                    $datas['img']= $img->path;
                }
            }


             #Getting AVG Rating of all restaurent
                $reviewCount = ProductReview::where('restaurant_id', $datas->id)->count();
                // Get the sum of ratings for the restaurant
                $ratingSum = ProductReview::where('restaurant_id', $datas->id)->sum('rating');
                // Calculate the average rating
                $averageRating = $reviewCount > 0 ? $ratingSum / $reviewCount : 0;
                // Round the average rating to 1 decimal place
                $averageRating = ceil($averageRating);
                $datas['avg_rating'] = $averageRating;
                $datas['total_rating'] = $reviewCount;
            #end 


            unset($datas->address);
            $final[]=$datas;
        }
        return view('pages.user.restaurant.list',compact('final'));
    }
}
