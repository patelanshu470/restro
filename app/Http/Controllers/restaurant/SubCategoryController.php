<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use DataTables;

class SubCategoryController extends Controller
{
    // public function subCategoryIndex(Request $request){

    //     $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();


    //     if ($request->ajax()) {
    //         $data = SubCategory::select('*');
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('status', function($categories) {
    //                  if ($categories->status == 1) {
    //                     return '<span class="badge bg-success">Active</span>';
    //                  } else {
    //                     return '<span class="badge bg-danger">Deactive</span>';
    //                  }
    //             })
    //             ->editColumn('category_id', function($categories) {
    //                 return $categories->category->name;
    //             })
    //             ->filter(function ($instance) use ($request) {
    //                 if ($request->get('subcategory') != '') {
    //                     $subcategory = $request->get('subcategory');
    //                     $instance->where('name', 'LIKE',"%$subcategory%");
    //                 }
    //                 if ($request->get('category') != '') {
    //                     $category = $request->get('category');
    //                     $instance->where('category_id', 'LIKE',"%$category%");
    //                 }
    //                 if ($request->get('status') != '') {
    //                     $status = $request->get('status');
    //                     $instance->where('status', 'LIKE',"%$status%");
    //                 }
    //             })
    //             ->rawColumns(['status','category_id'])
    //             ->make(true);
    //     }
    //     $data= SubCategory::where([['restaurent_id','=',$rest_data->id]])->get();
    //     $category = Category::where([['restaurent_id','=',$rest_data->id]])->get();
    //     $subcategory = SubCategory::where([['restaurent_id','=',$rest_data->id]])->get();

    // //     $subcategory = SubCategory::where([['restaurent_id','=',$rest_data->id]])->get();
    // //     $category = Category::where([['status','=',1],['restaurent_id','=',$rest_data->id]])->get();

    //     return view('pages.restaurant.category.subcategory',compact('data','category','subcategory'));
    // }
}
