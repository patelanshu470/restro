<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use App\Models\Addons;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Restaurant;
use App\Models\DefaultCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $restaurant_fetch = Restaurant::where('user_id', Auth::user()->id)->first();
            // $data = Product::where('restaurent_id',$restaurant_fetch->id)->orderBy('id','DESC');
            $data = Product::join('categories', 'products.product_category', '=', 'categories.id')->where([['categories.status', '=', 1]])
                ->where('products.restaurent_id', $restaurant_fetch->id)->select('products.*')->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($datas) {
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="' . route('product.edit', $datas->id) . '">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                             <i class="fa-regular fa-pen-to-square" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord(' . $datas->id . ')">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                            <i class="fa-solid fa-trash"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del' . $datas->id . '" href="' . route('product.destroys', $datas->id) . '" style="display: none">
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
                ->addColumn('status', function ($product) {
                    return '<div class="form-switch"><input data-id="' . $product->id . '" class="form-check-input status" id="status' . $product->id . '" type="checkbox" data-href="' . route('productstatus', $product->id) . '" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" ' . ($product->status ? 'checked' : '') . ' onclick="statusRecord(' . $product->id . ')"></div>';
                })
                ->editColumn('product_category', function ($categories) {
                    return $categories->category->name;
                })
                ->editColumn('name', function ($datas) {
                    $data = Product::with('image')->get();
                    $id = $datas->id;
                    $images = Attachment::where([['attachable_id', $id], ['field_name', 'product_thumbnail']])->get();
                    foreach ($images as $imagess) {
                        return '<img style="object-fit:contain;border-radius:5px;" src="' . asset('images/product/thumbnail/' . $imagess->path) . '" alt="" width="100" height="70">
                        ' . $datas->name . '';
                    }
                })
                ->editColumn('sell_price', function ($categories) {
                    // return $categories->category->name;
                    $default_country = DefaultCountry::first();
                    if ($default_country) {
                        if ($default_country->country_code == "+91") {
                            return "₹$categories->sell_price.00";
                        }
                        if ($default_country->country_code == "+44") {
                            return "£$categories->sell_price.00";
                        } else {
                            return "$$categories->sell_price.00";
                        }
                    } else {
                        return "$$categories->sell_price.00";
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('category') != '') {
                        $category = $request->get('category');
                        $instance->where('product_category', 'LIKE', "%$category%");
                    }
                    if ($request->get('name') != '') {
                        $name = $request->get('name');
                        $instance->where('products.name', 'LIKE', "%$name%");
                    }
                    if ($request->get('type') != '') {
                        $type = $request->get('type');
                        $instance->where('type', 'LIKE', "%$type%");
                    }
                    if ($request->get('status') != '') {
                        $status = $request->get('status');
                        $instance->where('products.status', 'LIKE', "%$status%");
                    }
                })
                ->rawColumns(['action', 'product_category', 'restaurent_id', 'name', 'status', 'sell_price'])
                ->make(true);
        }

        //  return   auth()->user()->id;
        $rest_data = Restaurant::where('user_id', '=', auth()->user()->id)->first();

        $category = Category::where([['restaurent_id', '=', $rest_data->id], ['status', '=', 1]])->get();
        return view('pages.restaurant.product.index', compact('category'));
    }

    public function fetchSubCat(Request $request)
    {
        $data['subcat'] = SubCategory::where("category_id", $request->catId)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function changestatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['success' => 'Product Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error' => 'Product Deactivate.']);
        }
    }

    public function addImage(Request $request)
    {
        dd($request->all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $rest_data = Restaurant::where('user_id', '=', auth()->user()->id)->first();

        $category = Category::where([['restaurent_id', '=', $rest_data->id], ['status', '=', 1]])->get();

        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();
        $addon = Addons::where("restaurant_id", $restaurant->id)->where('status', 1)->get();
        return view('pages.restaurant.product.create', compact('category', 'addon'));
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
        $product = new Product();
        $id_find = Restaurant::where('user_id', auth()->user()->id)->first();

        a:
        $rand_no = rand(999, 999999);
        $created_name = 'PDT' . $rand_no;
        $check_name_available = DB::table('products')->where([
            ['special_id', '=', $created_name], ['restaurent_id', '=', $id_find->id]
        ])->get('id');
        if (!empty($check_name_available)) {
            $product->special_id = $created_name;
        } else {
            goto a;
        }
        $product->restaurent_id = $id_find->id;
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->final_price = $request->final_price;

        $product->product_category = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->type = $request->type;
        $product->discount = $request->discount;
        // $product->weight_per_piece = $request->weight_per_piece;
        // $product->quantity = $request->quantity;
        $product->cooking_time = $request->cooking_time;
        $product->size = $request->size;
        $product->addon_id = json_encode($request->addons);
        // $product->discount_type = $request->discount_type;
        $product->discount_type = "percent";
        $product->save();


        if ($request->product_thumnail) {
            $attachment = new Attachment();
            $uploadFile = $request->product_thumnail;
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/product/thumbnail'), $file_name);
            $attachment['path'] = $file_name;
            $attachment->field_name = "product_thumbnail";
            $product->image()->save($attachment);
        }

        if ($request->gallary) {
            foreach ($request->gallary as $img) {
                $attachment = new Attachment();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/product/gallary'), $file_name);
                $attachment['path'] = $file_name;
                $attachment->field_name = "product_gallary";
                $product->image()->save($attachment);
            }
        }
        return redirect()->route('product.index')->with('success', 'Product Added Successfully');
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

        $data = Product::with('image')->find($id);
        $gallary = [];
        for ($i = 0; $i < count($data->image); $i++) {
            $img = $data->image[$i];

            if ($img->field_name == "product_thumbnail") {
                $thumbnail = $img->path;
            }
            if ($img->field_name == "product_gallary") {
                $gallary[] = $img;
            }
        }
        $data['thumbnail'] = $thumbnail;
        $data['gallary'] = $gallary;
        $rest_data = Restaurant::where('user_id', '=', auth()->user()->id)->first();

        $category = Category::where([['restaurent_id', '=', $rest_data->id], ['status', '=', 1]])->get();
        // $category=Category::all();
        $subcategory = SubCategory::all();
        $addon = Addons::all();

        return view('pages.restaurant.product.edit', compact('data', 'category', 'subcategory', 'addon'));
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
        // return $request->all();
        $product = Product::with('image')->find($id);
        // $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->final_price = $request->final_price;
        $product->product_category = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->type = $request->type;
        $product->discount = $request->discount;
        // $product->weight_per_piece = $request->weight_per_piece;
        // $product->quantity = $request->quantity;
        $product->cooking_time = $request->cooking_time;
        $product->size = $request->size;
        $product->addon_id = json_encode($request->addons);
        // $product->discount_type = $request->discount_type;
        $product->discount_type = "percent";

        $product->save();


        if ($request->product_thumnail) {
            $attachment = $product->image;
            for ($i = 0; $i < count($attachment); $i++) {
                if ($attachment[$i]->field_name == "product_thumbnail") {
                    $data_img = Attachment::find($attachment[$i]->id);

                    // Store the old file name
                    $old_file_name = $data_img->path;

                    $uploadFile = $request->product_thumnail;
                    $file_name = $uploadFile->hashName();
                    $path = $uploadFile->move(public_path('images/product/thumbnail'), $file_name);
                    $data_img['path'] = $file_name;
                    $data_img->save();

                    // Delete the old image file if it exists
                    if ($old_file_name && file_exists(public_path('images/product/thumbnail/'.$old_file_name))) {
                        unlink(public_path('images/product/thumbnail/'.$old_file_name));
                    }
                }
            }
        }

        if ($request->gallary) {
            foreach ($request->gallary as $img) {
                $attachment = new Attachment();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/product/gallary'), $file_name);
                $attachment['path'] = $file_name;
                $attachment->field_name = "product_gallary";
                $product->image()->save($attachment);
                // $attachment->save();
            }
        }

        // return $request->all();
        return redirect()->route('product.index')->with('success', 'Product updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id)->delete();
        // $attachment = Attachment::where([['attachable_id', '=', $id], ['attachable_type', '=', "App\Models\Product"]])->get();

        // foreach ($attachment as $d) {

        //     if ($d->field_name == "product_thumbnail") {
        //         unlink('images/product/thumbnail/' . $d->path);
        //     }
        //     if ($d->field_name == "product_gallary") {
        //         unlink('images/product/gallary/' . $d->path);
        //     }
        // }

        // Attachment::where([['attachable_id', '=', $id], ['attachable_type', '=', "App\Models\Product"]])->delete();

        // $attachment->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted Successfully');
    }
    public function imgDelete($id)
    {

        $d = Attachment::find($id);

        $check_data =   Attachment::where('attachable_id', $d->attachable_id)->where('attachable_type', 'App\Models\Product')->where('field_name', 'product_gallary')->count();

        if ($d->field_name == "product_thumbnail") {
            unlink('images/product/thumbnail/' . $d->path);
        }
        if ($d->field_name == "product_gallary") {
            unlink('images/product/gallary/' . $d->path);
        }
        $d->delete();

        return response()->json($check_data);
        //    return back()->with($id);

    }
}
