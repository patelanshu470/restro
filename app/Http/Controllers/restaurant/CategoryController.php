<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    // Note: visit Admin/Category 
    // public function categoryIndex(Request $request){
    //     if ($request->ajax()) {
    //         $data = Category::select('*');
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('status', function($categories) {
    //                  if ($categories->status == 1) {
    //                     return '<span class="badge bg-success">Active</span>';
    //                  } else {
    //                     return '<span class="badge bg-danger">Deactive</span>';
    //                  }
    //             })
    //             ->filter(function ($instance) use ($request) {
    //                 if ($request->get('category') != '') {
    //                     $name = $request->get('category');
    //                     $instance->where('name', 'LIKE',"%$name%");
    //                 }
    //                 if ($request->get('status') != '') {
    //                     $status = $request->get('status');
    //                     $instance->where('status', 'LIKE',"%$status%");
    //                 }
    //             })
    //             ->rawColumns(['status'])
    //             ->make(true);
    //     }
    //     $data= Category::all();
    //     $category = Category::all();
    //     return view('pages.restaurant.category.category',compact('data','category'));
    // }
}
