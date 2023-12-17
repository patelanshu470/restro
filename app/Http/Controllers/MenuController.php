<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class MenuController extends Controller
{
    public function index()
    {
        $category_data = Category::get()->map(function($categories){
            $count_category_product = Product::where('product_category',$categories->id)->count();
             $categories['total'] = $count_category_product;
            return $categories;
        });

        $get_product = Product::with('image')->get();
        $product=[];
        foreach($get_product as $product_datas){
            $img=$product_datas->image;
            foreach($img as $img){
                if($img->field_name == "product_thumbnail"){
                    $product_datas['thumbnail']= $img->path;
                }
            }
            unset($product_datas->image);
           $product[]=$product_datas;
        }

        return view('pages.user.menu.index',compact('category_data','product'));
    }

    public function fetchCategory(Request $request)
    {
        // dd($request->id);
        $get_product = Product::where('product_category',$request->id)->get();
        $product=[];
        foreach($get_product as $product_datas){
            $img=$product_datas->image;
            foreach($img as $img){
                if($img->field_name == "product_thumbnail"){
                    $product_datas['thumbnail']= $img->path;
                }
            }
            unset($product_datas->image);
           $product[]=$product_datas;
        }
        $category_id = $request->id;
        $get_category_name = Category::where('id',$category_id)->first();
        $category_name = $get_category_name->name;
        echo view('pages.user.menu.ajaxcategory',compact('product','category_name'));
    }
}
