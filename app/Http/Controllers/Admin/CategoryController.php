<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Restaurant;
use DataTables;

class CategoryController extends Controller
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
            $data = Category::where([['restaurent_id','=',$rest_data->id]])->select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function($categories){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#" data-bs-toggle="modal" data-bs-target="#EditModalCenter'.$categories->id.'">
                       <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-pen-to-square" width="32"></i>
                           </div>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$categories->id.')">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-trash"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$categories->id.'" href="'.route('category.destroys',$categories->id).'" style="display: none">
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
                ->addColumn('status', function($categories) {
                    return '<div class="form-switch"><input data-id="'.$categories->id.'" class="form-check-input status" id="status'.$categories->id.'" type="checkbox" data-href="'.route('changecategory', $categories->id).'" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" '.($categories->status ? 'checked' : '').' onclick="statusRecord('.$categories->id.')"></div>';
                 })
                 ->editColumn('name', function ($datas) {
                        return '<img style="object-fit:contain;border-radius:7px;" src="' . asset('images/restaurant/category/' . $datas->cat_img) . '" alt="" width="100" height="70">
                        ' . $datas->name . '';
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('category') != '') {
                        $name = $request->get('category');
                        $instance->where('name', 'LIKE',"%$name%");
                    }
                    if ($request->get('status') != '') {
                        $status = $request->get('status');
                        $instance->where('status', 'LIKE',"%$status%");
                    }
                })
                ->rawColumns(['action','status','name'])
                ->make(true);
        }
        $category = Category::where([['restaurent_id','=',$rest_data->id]])->get();
        return view('pages.admin.category.index',compact('category'));
    }

    public function changestatus(Request $request)
    {
        $category = Category::find($request->category_id);
        $category->status = $request->status;
        $category->save();

        if ($request->status == 1) {
            return response()->json(['success'=>'Category Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error'=>'Category Deactivate.']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // pending from here attention:
        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();

        $category = Category::where('name','=',$request->name)->where('restaurent_id','=',$rest_data->id)->first();
        if (isset($category)) {
            return back()->with('warning', 'Duplicate entry is not allowed');
        }

        $cat_data=new Category();
        $cat_data->name=$request->name;
        $cat_data->restaurent_id=$rest_data->id;
        $cat_data->status=1;

        if ($request->cat_img) {

            $uploadFile = $request->file('cat_img');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/restaurant/category'), $file_name);
            $cat_data['cat_img'] = $file_name;
        }
        $cat_data->save();

        // return redirect()->route('category.index')->with('success', 'Category Created Successfully');
        return redirect()->back()->with('success', 'Category Created Successfully');
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
        $category = Category::find($id);
        return view('pages.admin.category.edit',compact('category'));
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
        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();
        $category_check = Category::where('name','=',$request->name)->where('id','<>',$id)->where('restaurent_id','=',$rest_data->id)->first();
        if (isset($category_check)) {
            return back()->with('warning', 'Duplicate entry is not allow');
        }

        $cat_data = Category::find($id);
        $cat_data->name=$request->name;
        // $cat_data->restaurent_id=$rest_data->id;
        // $cat_data->status=1;

        if ($request->cat_img) {

            $uploadFile = $request->file('cat_img');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/restaurant/category'), $file_name);

            // Delete the old image file if it exists
            if ($cat_data->cat_img) {
                $oldImagePath = public_path('images/restaurant/category') . '/' . $cat_data->cat_img;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $cat_data['cat_img'] = $file_name;

        }
        $cat_data->save();
        // $category->update([
        //     'name' => $request->name,
        // ]);

        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        Category::where('id',$category->id)->delete();
        SubCategory::where('category_id',$category->id)->delete();
        Product::where('product_category',$id)->delete();
        // return redirect()->route('category.index')->with('error', 'Category Deleted Successfully');
        return redirect()->back()->with('error', 'Category Deleted Successfully');
    }
}
