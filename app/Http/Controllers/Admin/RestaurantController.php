<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\Address;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Product;
use App\Models\Addons;
use App\Models\Logo;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Table;
use Hash;
use DataTables;
use Image;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Restaurant::select('*')->orderBy('id', 'DESC');
            // $data = Restaurant::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($restaurants) {
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="' . route('restaurant.show', $restaurants->id) . '">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-regular fa-eye" width="32"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href=" ' . route('restaurant.edit', $restaurants->id) . '">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-pen-to-square" width="32"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord(' . $restaurants->id . ')">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-trash"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del' . $restaurants->id . '" href="' . route('restaurant.destroys', $restaurants->id) . '" style="display: none">
                       <span class="btn-inner">
                          <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                             <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                             <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                             <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="PasswordChange" href="' . route('restaurant.changepassword', $restaurants->user_id) . '" >
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-lock"></i>
                           </div>
                       </span>
                    </a>
                 </div>';
                    return $actionBtn;
                })
                ->editColumn('email', function ($restaurant) {
                    return $restaurant->user->email;
                })
                ->addColumn('status', function ($categories) {
                    return '<div class="form-switch"><input data-id="' . $categories->id . '" class="form-check-input status" id="status' . $categories->id . '" type="checkbox" data-href="' . route('restaurantstatus', $categories->id) . '" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" ' . ($categories->status ? 'checked' : '') . ' onclick="statusRecord(' . $categories->id . ')"></div>';
                })
                // ->addColumn('restaurant_name', function ($categories) {
                //     $data = Restaurant::with('image')->get();
                //     $id = $categories->id;
                //     $images = Attachment::where([['attachable_id', $id], ['field_name', 'restaurant_image']])->get();
                //     foreach ($images as $imagess) {
                //         // return '<img style="object-fit:contain;border-radius:5px;width: 100px;height: 70px;" src="'.asset('images/restaurant/image/'.$imagess->path).'" alt="" width="100" height="70">
                //         // '.$categories->restaurant_name.'';
                //         return  '<a href="#" alt="view restaurant" class="table-rest-info d-flex">
                //             <img src="' . asset('images/restaurant/image/' . $imagess->path) . '" style="object-fit:contain;border-radius:5px;width: 100px;height: 70px;>
                //             <div class="info">
                //             <span class="d-block" style="color:#07143B;margin-left:7px">
                //             ' . $categories->restaurant_name . '<br>
                //                 <span class="rating text-primary">
                //                 <i class="fa-regular fa-star"></i> 0
                //                 </span>
                //             </span>
                //             </div>
                //             </a>';
                //     }
                // }
                // )
                ->filter(function ($instance) use ($request) {
                    // dd($instance);
                    if ($request->get('restaurant_name') != '') {
                        $restaurant_name = $request->get('restaurant_name');
                        $instance->where('restaurant_name', 'LIKE', "%$restaurant_name%");
                    }
                    if ($request->get('status') != '') {
                        $status = $request->get('status');
                        $instance->where('status', 'LIKE', "%$status%");
                    }
                })
                ->rawColumns(['action', 'email', 'status'])
                ->make(true);
        }
        $restaurant = Restaurant::all();
        return view('pages.admin.restaurant.index', compact('restaurant'));
    }
    public function changestatus(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        $restaurant->status = $request->status;
        $restaurant->save();

        if ($request->status == 1) {
            return response()->json(['success' => 'Restaurant Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error' => 'Restaurant Deactivate.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return view('pages.admin.restaurant.create', compact('country'));
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchEmail(Request $request)
    {
        $email = User::where('email', 'LIKE', $request->email)->first();

        // dd($email);
        return response()->json($email);
    }

    public function fetchphone_number(Request $request)
    {
        $phone_number = User::where('phone_number', 'LIKE', $request->phone_number)->first();
        // dd($phone_number);
        return response()->json($phone_number);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();

        $restaurant = Restaurant::where('restaurant_name','=',$request->restaurant_name)->first();
        if (isset($restaurant)) {
            return back()->with('warning', 'Duplicate entry is not allowed');
        }
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->manager_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->confirm_password = Hash::make($request->confirm_password);
        $user->role = 2;
        $user->verified_phone_number = 1;
        $user->save();
        $result = Restaurant::create([
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'restaurant_name' => $request->restaurant_name,
            'restro_contact_number' => $request->restro_contact_number,
            'status' => 1,
        ]);
        $result->user_id = $user->id;
        $result->save();

        if ($request->restro_image) {
            $attachment = new Attachment();
            $uploadFile = $request->restro_image;
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/restaurant/image'), $file_name);
            $attachment['path'] = $file_name;
            $attachment->field_name = "restaurant_image";
            $result->image()->save($attachment);
        }

        if ($request->cover_image) {
            $attachment = new Attachment();
            $uploadFile = $request->cover_image;
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/restaurant/cover'), $file_name);
            $attachment['path'] = $file_name;
            $attachment->field_name = "restaurant_cover";
            $result->image()->save($attachment);
        }

        if ($request->logo_image) {
            $attachment = new Attachment();
            $uploadFile = $request->logo_image;
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/restaurant/logo'), $file_name);
            $attachment['path'] = $file_name;
            $attachment->field_name = "restaurant_logo";
            $result->image()->save($attachment);
        }

        if ($request->gallary) {
            foreach ($request->gallary as $img) {
                $attachment = new Attachment();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/restaurant/gallary'), $file_name);
                $attachment['path'] = $file_name;
                $attachment->field_name = "restaurant_gallary";
                $result->image()->save($attachment);
            }
        }
        //    $result->save();
        $address = new Address;
        $address->street = $request->street;
        $address->landmark = $request->landmark;
        $address->pincode = $request->pincode;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->addresable_id = $result->id;
        $address->addresable_type = get_class($result);
        $address->save();

        return redirect()->route('restaurant.index')->with('success', 'Restaurant Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $restaurant = Restaurant::with('address')->find($id);
        $get_id =  $restaurant->user_id;
        $get_data = User::where('id', $get_id)->first();

        foreach ($restaurant->address as $datas) {
            $addresess = $datas;
        }


        $logo = Logo::first();

        return view('pages.admin.restaurant.view', compact('restaurant', 'addresess', 'get_data','logo'));
    }

    public function changepassword($id)
    {
        $restaurant = User::find($id);
        return view('pages.admin.restaurant.password_change', compact('restaurant'));
    }
    public function updatepassword(Request $request, $id)
    {
        $restaurant = User::find($id);
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        // old password match...
        if (!Hash::check($request->old_password, $restaurant->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }
        // Update the new Password....
        $restaurant->update([
            'password' => Hash::make($request->new_password),
            'confirm_password' => Hash::make($request->confirm_password)
        ]);
        return redirect()->route('restaurant.index')->with('success', 'Password Updated Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::with('address')->find($id);
        foreach ($restaurant->address as $addresess) {
            $fetch_address = $addresess;
        }
        $fetch_id = $restaurant->user_id;
        $fetch_manager = User::where('id', $fetch_id)->first();

        $gallary = [];
        for ($i = 0; $i < count($restaurant->image); $i++) {
            $img = $restaurant->image[$i];
            // if ($img->field_name == "restaurant_image") {
            //     $thumbnail = $img->path;
            // }
            // if ($img->field_name == "restaurant_cover") {
            //     $cover = $img->path;
            // }
            // if ($img->field_name == "restaurant_logo") {
            //     $logo = $img->path;
            // }
            if ($img->field_name == "restaurant_gallary") {
                $gallary[] = $img;
            }
        }
        // $restaurant['restaurant_image'] = $thumbnail;
        // $restaurant['restaurant_cover'] = $cover;
        // $restaurant['restaurant_logo'] = $logo;

        $restaurant['restaurant_gallary'] = $gallary;
        $country = Country::all();
        return view('pages.admin.restaurant.edit', compact('restaurant', 'country', 'fetch_address', 'fetch_manager'));
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
        // dd($request->all());
        $restaurant_check = Restaurant::where('restaurant_name','=',$request->restaurant_name)->where('id','<>',$id)->first();
        if (isset($restaurant_check)) {
            return back()->with('warning', 'Duplicate entry is not allow');
        }
        $restaurant = Restaurant::with('address')->find($id);
        $user_id = $restaurant->user_id;
        $user = User::find($user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->manager_number;
        $user->role = 2;
        $user->verified_phone_number = 1;
        $user->save();
        $restaurant->update([
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'restaurant_name' => $request->restaurant_name,
            'restro_contact_number' => $request->restro_contact_number,
        ]);
        $restaurant->save();

        if ($request->restro_image) {
            $attachment = $restaurant->image;
            for ($i = 0; $i < count($attachment); $i++) {
                if ($attachment[$i]->field_name == "restaurant_image") {
                    $data_img = Attachment::find($attachment[$i]->id);
                    $uploadFile = $request->restro_image;
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('images/restaurant/image'), $file_name);
                    $data_img['path'] = $file_name;
                    $data_img->save();
                }
            }
        }

        if ($request->cover_image) {
            $attachment = $restaurant->image;
            for ($i = 0; $i < count($attachment); $i++) {
                if ($attachment[$i]->field_name == "restaurant_cover") {
                    $data_img = Attachment::find($attachment[$i]->id);
                    $uploadFile = $request->cover_image;
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('images/restaurant/cover'), $file_name);
                    $data_img['path'] = $file_name;
                    $data_img->save();
                }
            }
        }

        if ($request->logo_image) {
            $attachment = $restaurant->image;
            for ($i = 0; $i < count($attachment); $i++) {
                if ($attachment[$i]->field_name == "restaurant_logo") {
                    $data_img = Attachment::find($attachment[$i]->id);
                    $uploadFile = $request->logo_image;
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('images/restaurant/logo'), $file_name);
                    $data_img['path'] = $file_name;
                    $data_img->save();
                }
            }
        }

        if ($request->gallary) {
            foreach ($request->gallary as $img) {
                $attachment = new Attachment();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/restaurant/gallary'), $file_name);
                $attachment['path'] = $file_name;
                $attachment->field_name = "restaurant_gallary";
                $restaurant->image()->save($attachment);
                // $attachment->save();
            }
        }

        $id_find = $restaurant->address;
        $idd =  $id_find[0]['id'];
        $restaurants = Address::find($idd);
        $restaurants->street = $request->street;
        $restaurants->landmark = $request->landmark;
        $restaurants->pincode = $request->pincode;
        $restaurants->country = $request->country;
        $restaurants->state = $request->state;
        $restaurants->city = $request->city;
        $restaurants->addresable_id = $restaurant->id;
        $restaurants->addresable_type = get_class($restaurant);
        $restaurants->save();

        return redirect()->route('restaurant.index')->with('success', 'Restaurant Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $addresable_type = get_class($restaurant);
        Restaurant::where('id', $restaurant->id)->delete();
        $address = Address::where([['addresable_id', $id], ['addresable_type', $addresable_type]])->delete();
        $user = User::where('id', $restaurant->user_id)->delete();

        // $image = Attachment::where([['attachable_id', $id], ['attachable_type', $addresable_type]])->get();
        // foreach ($image as $images) {
        //     $images_field[] = $images->field_name;
        //     $images_path[] = $images->path;
        // }
        // if ($images_field[0] == "restaurant_image") {
        //     unlink('images/restaurant/image/' . $images_path[0]);
        // }
        // $images = Attachment::where([['attachable_id', $id], ['attachable_type', $addresable_type]])->get();
        // foreach ($images as $imagess) {
        //     $imagess_field = $imagess->field_name;
        //     $imagess_path = $imagess->path;
        // }
        // if ($imagess_field == "restaurant_cover") {
        //     unlink('images/restaurant/cover/' . $imagess_path);
        // }
        Attachment::where([['attachable_id', $id], ['attachable_type', $addresable_type]])->delete();
        Product::where('restaurent_id', $id)->delete();
        Addons::where('restaurant_id', $id)->delete();
        Category::where('restaurent_id', $id)->delete();
        SubCategory::where('restaurent_id', $id)->delete();
        Table::where('restaurant_id', $id)->delete();
        return redirect()->route('restaurant.index')->with('error', 'Restaurant Deleted Successfully');
    }
    public function imgDelete($id)
    {

        $d = Attachment::find($id);
        $check_data =   Attachment::where('attachable_id', $d->attachable_id)->where('attachable_type', 'App\Models\Restaurant')->where('field_name', 'restaurant_gallary')->count();
        if ($d->field_name == "product_thumbnail") {
            unlink('images/product/thumbnail/' . $d->path);
        }
        if ($d->field_name == "product_gallary") {
            unlink('images/product/gallary/' . $d->path);
        }
        $d->delete();
        return response()->json($check_data);
    }
}
