<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Addons;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurentInformation extends Controller
{
    public function index(){

        $country = Country::all();
        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();
        $restaurant_info = Restaurant::with(['address','image'])->find($rest_data->id);
        $gallary=[];
        for($i=0;$i<count($restaurant_info->image);$i++){
            $img=$restaurant_info->image[$i];
    
            if($img->field_name == "restaurant_gallary"){
                $gallary[]= $img;
            }

        }
   
        $restaurant_info['restaurant_gallary']=$gallary;

        return view('pages.restaurant.restaurent_info.restaurent_info',compact('country','restaurant_info'));

    }

    public function store(Request $request)
    {

        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();
        $restaurant = Restaurant::with('address')->find($rest_data->id);
        $restaurant->update([
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
      
        ]);
        $restaurant->save();


        if($request->gallary){
            foreach($request->gallary as $img){
                $attachment = new Attachment();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/restaurant/gallary'), $file_name);
                $attachment['path']=$file_name;
                $attachment->field_name = "restaurant_gallary";
                $restaurant->image()->save($attachment);
                // $attachment->save();
            }
        }

        return redirect()->back()->with('success', 'Restaurant Updated Successfully');
  
  

    
        
    }

    public function imgDelete($id){

        $d= Attachment::find($id);
        $check_data =   Attachment::where('attachable_id',$d->attachable_id)->where('attachable_type','App\Models\Restaurant')->where('field_name','restaurant_gallary')->count();
        if($d->field_name == "product_thumbnail"){
         unlink('images/product/thumbnail/'.$d->path);
         }
         if($d->field_name == "product_gallary"){
             unlink('images/product/gallary/'.$d->path);
         }
        $d->delete();
        return response()->json($check_data);
     }
}
