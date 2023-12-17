<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\ProductReview;
use App\Models\Attachment;
use Auth;
use DataTables;
use Illuminate\Support\Str;


class ProductReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $restaurant_fetch = Restaurant::where('user_id', Auth::user()->id)->first();
            // $data = Product::where('restaurent_id',$restaurant_fetch->id)->orderBy('id','DESC');
            $data = ProductReview::where('restaurant_id', $restaurant_fetch->id)->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($product) {
                    return '<div class="form-switch"><input data-id="' . $product->id . '" class="form-check-input status" id="status' . $product->id . '" type="checkbox" data-href="' . route('productstatus', $product->id) . '" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" ' . ($product->status ? 'checked' : '') . ' onclick="statusRecord(' . $product->id . ')"></div>';
                })
                ->editColumn('user_id', function ($reviews) {
                    return $reviews->user->first_name .' '. $reviews->user->last_name;
                })
                ->editColumn('product_id', function ($datas) {
                    $images = Attachment::where([['attachable_id', $datas->product_id], ['field_name', 'product_thumbnail']])->get();
                    foreach ($images as $imagess) {
                        return '<img style="object-fit:contain;border-radius:5px;" src="' . asset('images/product/thumbnail/' . $imagess->path) . '" alt="" width="100" height="70">
                        ' . $datas->product->name . '';
                    }
                })
                ->editColumn('rating', function ($reviews) {
                    if ($reviews->rating == 1) {
                        $rating = '<i class="fa-solid fa-star checked"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>';
                        return $rating;
                    } elseif ($reviews->rating == 2) {
                        $rating = '<i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>';
                        return $rating;
                    } elseif ($reviews->rating == 3) {
                        $rating = '<i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>';
                        return $rating;
                    } elseif ($reviews->rating == 4) {
                        $rating = '<i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-regular fa-star"></i>';
                        return $rating;
                    } elseif ($reviews->rating == 5) {
                        $rating = '<i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>
                        <i class="fa-solid fa-star checked"></i>';
                        return $rating;
                    }

                })
                ->editColumn('image', function ($datas) {
                    if (isset($datas->image)) {
                        return '<img style="object-fit:contain;border-radius:5px;" src="' . asset('images/review_image/' . $datas->image) . '" alt="" width="100" height="70" data-bs-toggle="modal" data-bs-target="#review_image_view'.$datas->id.'">';
                    } else {
                        return '<span style="object-fit:contain;">-</span>';
                    }

                })
                ->editColumn('description', function ($datas) {
                    // return '<span>'.Str::of($datas->description)->limit(30, '...').'</span>';
                    return '<div class="custom-tooltip">
                        '.Str::of($datas->description)->limit(30, '...').'
                        <div class="tooltip-content">'.$datas->description.'</div>
                    </div>';

                })
                ->rawColumns(['rating', 'product_id', 'user_id', 'status','image','description'])
                ->make(true);
        }

        $productReview = ProductReview::join('products', 'product_reviews.product_id', '=', 'products.id')
        ->where('products.status', '1')
        ->whereNull('products.deleted_at')
        ->select('product_reviews.*')
        ->get();
        return view('pages.restaurant.product_review.index',compact('productReview'));
    }

    public function changestatus(Request $request)
    {
        $product = ProductReview::find($request->product_id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['success' => 'Product Review Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error' => 'Product Review Deactivate.']);
        }
    }
}
