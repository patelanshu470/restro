<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addons;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\DefaultCountry;

use DataTables;

class AddonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();

        if ($request->ajax()) {

            $data = Addons::join('restaurants', 'addons.restaurant_id', '=', 'restaurants.id')->where([['restaurants.status','=',1],['addons.restaurant_id','=',$rest_data->id]])
            ->select('addons.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($addons){
                    $actionBtn = ' <div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('addons.edit',$addons->id).'" role="button" data-bs-toggle="modal" data-bs-target="#EditModalCenter'.$addons->id.'">
                       <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-pen-to-square" width="32"></i>
                           </div>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$addons->id.')">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-trash"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$addons->id.'" href="'.route('addons.destroys',$addons->id).'" style="display: none">
                       <span class="btn-inner">
                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                             <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                             <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                             <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                       </span>
                    </a>
                 </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function($addons) {
                    return '<div class="form-switch"><input data-id="'.$addons->id.'" class="form-check-input status" id="status'.$addons->id.'" type="checkbox" data-href="'.route('addonsstatus', $addons->id).'" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" '.($addons->status ? 'checked' : '').' onclick="statusRecord('.$addons->id.')"></div>';
                })
                // ->editColumn('restaurant_id', function($categories) {
                //     return $categories->restaurant->restaurant_name;
                // })
                ->editColumn('price', function($categories) {
                    $default_country = DefaultCountry::first();
                    if ($default_country) {
                        if ($default_country->country_code == "+91") {
                        return "₹$categories->price.00";
                        }
                        if ($default_country->country_code == "+44") {
                            return "£$categories->price.00";
                        } else {
                            return "$$categories->price.00";
                        }
                    } else {
                        return "$$categories->price.00";
                    }
                })
                ->editColumn('cost_price', function($categories) {
                    $default_country = DefaultCountry::first();
                    if ($default_country) {
                        if ($default_country->country_code == "+91") {
                        return "₹$categories->cost_price.00";
                        }
                        if ($default_country->country_code == "+44") {
                            return "£$categories->cost_price.00";
                        } else {
                            return "$$categories->cost_price.00";
                        }
                    } else {
                        return "$$categories->cost_price.00";
                    }
                })
                ->filter(function ($instance) use ($request) {
                    // dd($instance);
                    if ($request->get('restaurant_id') != '') {
                        $restaurant_id = $request->get('restaurant_id');
                        $instance->where('restaurant_id', 'LIKE',"%$restaurant_id%");
                    }
                    if ($request->get('status') != '') {
                        $status = $request->get('status');
                        $instance->where('addons.status', 'LIKE',"%$status%");
                    }
                    if ($request->get('name') != '') {
                        $name = $request->get('name');
                        $instance->where('name', 'LIKE',"%$name%");
                    }
                })
                ->rawColumns(['action','restaurant_id','status','price','cost_price'])
                ->make(true);
        }
        $addon = Addons::all();
        $restaurant = Restaurant::where('status',1)->get();
        // return view('pages.admin.Addons.index',compact('addon','restaurant'));
        return view('pages.restaurant.addons.addons',compact('addon','restaurant'));
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $addon=Addons::where('restaurant_id','LIKE','%'.$request->search."%")->get();
            if($addon)
            {
                foreach ($addon as $key => $addons) {
                $output.='<tr>'.
                '<td>'.$addons->id.'</td>'.
                '<td>'.$addons->name.'</td>'.
                '<td>'.$addons->restaurant->restaurant_name.'</td>'.
                '<td>'.$addons->price.'</td>'.
                '<td><div class="form-switch"><input data-id="'.$addons->id.'" class="form-check-input status" id="status'.$addons->id.'" type="checkbox" data-href="'.route('addonsstatus', $addons->id).'" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" '.($addons->status ? 'checked' : '').' onclick="statusRecord('.$addons->id.')"></div>'.
                '<td> <div class="flex align-items-center list-user-action">
                <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('addons.edit',$addons->id).'" role="button" data-bs-toggle="modal" data-bs-target="#EditModalCenter'.$addons->id.'">
                   <div style="position: relative; top: -2px; width: 20px;
                       text-align: center;
                       vertical-align: middle;">
                           <i class="fa-regular fa-pen-to-square" width="32"></i>
                       </div>
                </a>
                <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$addons->id.' }})">
                   <span class="btn-inner">
                       <div style="position: relative; top: -2px; width: 20px;
                       text-align: center;
                       vertical-align: middle;">
                          <i class="fa-solid fa-trash"></i>
                       </div>
                   </span>
                </a>
                <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$addons->id.'" href="'.route('addons.destroys',$addons->id).'" style="display: none">
                   <span class="btn-inner">
                      <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                         <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                         <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                         <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                   </span>
                </a>
             </div></td>'.
                '</tr>';
            }
            return Response($output);
            }
        }
    }

    public function changestatus(Request $request)
    {
        $addons = Addons::find($request->addons_id);
        $addons->status = $request->status;
        $addons->save();

        if ($request->status == 1) {
            return response()->json(['success'=>'Addons Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error'=>'Addons Deactivate.']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
        $restro_data = Restaurant::where([['user_id','=',Auth()->user()->id]])->get()->first();
        $sub_category = Addons::where('name','like',$request->name)->where('restaurant_id','=',$restro_data->id)->first();
        if (isset($sub_category)) {
            return back()->with('warning', 'Duplicate entry is not allow.');
        }

        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();

        Addons::create([
            'name' => $request->name,
            'restaurant_id' => $rest_data->id,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
        ]);
        return redirect()->route('addons.index')->with('success', 'Addons Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $addon = Addons::find($id);
        $restro_data = Restaurant::where([['user_id','=',Auth()->user()->id]])->get()->first();

        $sub_category = Addons::where('name','like',$request->name)->where('restaurant_id','=',$restro_data->id)->first();
        if (isset($sub_category)) {
            return back()->with('warning', 'Duplicate entry is not allow.');
        }

        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();

        $addon->update([
            'name' => $request->name,
            'restaurant_id' => $rest_data->id,
            'cost_price' => $request->cost_price,
            'price' => $request->price,
        ]);
        return redirect()->route('addons.index')->with('success', 'Addons Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addons = Addons::find($id);
        Product::where('addon_id',$id)->get();
        Addons::where('id',$addons->id)->delete();
        return redirect()->route('addons.index')->with('error', 'Addons Deleted Successfully');
    }
}
