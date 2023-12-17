<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Addons;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class AddonsController extends Controller
{
    // public function addonIndex(Request $request){
    //     if ($request->ajax()) {
    //         $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
    //         $data = Addons::where('restaurant_id',$restaurant_fetch->id);
    //         // $data = Addons::select('*');
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->editColumn('status', function($categories) {
    //                 if ($categories->status == 1) {
    //                    return '<span class="badge bg-success">Active</span>';
    //                 } else {
    //                    return '<span class="badge bg-danger">Deactive</span>';
    //                 }
    //             })
    //             ->filter(function ($instance) use ($request) {
    //                 // dd($instance);
    //                 if ($request->get('name') != '') {
    //                     $name = $request->get('name');
    //                     $instance->where('name', 'LIKE',"%$name%");
    //                 }
    //                 if ($request->get('status') != '') {
    //                     $status = $request->get('status');
    //                     $instance->where('status', 'LIKE',"%$status%");
    //                 }
    //                 })
    //             ->rawColumns(['status'])
    //             ->make(true);
    //     }
    //     $data= Addons::all();
    //     return view('pages.restaurant.addons.addons',compact('data'));
    // }
}
