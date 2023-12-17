<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion as ModelsPromotion;
use Illuminate\Http\Request;

class Promotion extends Controller
{
    public function largeBannerIndex()
    {
        $promotion_large=ModelsPromotion::where('type','=',"large_banner")->first();
        $promotion_small=ModelsPromotion::where('type','=',"small_banner")->first();
        $promotion_gif=ModelsPromotion::where('type','=',"gif_banner")->first();
        $bg_banner=ModelsPromotion::where('type','=',"bg_banner")->first();
        return view('pages.admin.promotion.index',compact('bg_banner','promotion_large','promotion_small','promotion_gif'));
    }

    public function bannerStore(Request $request)
    {
        // return $request->all();
        if($request->large_banner_id or $request->small_banner_id or $request->bg_banner_id){
            // return "edit";
            if($request->large_banner_id){
                $data_edit=null;
                $data_edit = ModelsPromotion::find($request->large_banner_id);
            }
            elseif($request->small_banner_id){
                $data_edit=null;
                $data_edit = ModelsPromotion::find($request->small_banner_id);
            }elseif($request->bg_banner_id){
                $data_edit=null;
                $data_edit = ModelsPromotion::find($request->bg_banner_id);
            }
            $data_edit->name = $request->name;
            $data_edit->offer = $request->offer;
            $data_edit->type = $request->type;
            $data_edit->product_id = $request->product_id;
            $data_edit->description = $request->description;
            $data_edit->link = $request->link;

            if ($request->file('img')) {
                $uploadFile = $request->file('img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                // Remove the old image
                if ($data_edit->img) {
                    $oldImagePath = public_path('images/promotion') . '/' . $data_edit->img;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data_edit['img'] = $file_name;
            }
            if ($request->file('bg_banner')) {
                $uploadFile = $request->file('bg_banner');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                // Remove the old image
                if ($data_edit->img) {
                    $oldImagePath = public_path('images/promotion') . '/' . $data_edit->img;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data_edit['img'] = $file_name;
            }
            if ($request->file('small_img')) {
                $uploadFile = $request->file('small_img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                // Remove the old image
                if ($data_edit->img) {
                    $oldImagePath = public_path('images/promotion') . '/' . $data_edit->img;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data_edit['img'] = $file_name;
            }
            $data_edit->save();
            return redirect()->back()->with('success', 'Promotion Updated Successfully');

        }else{
            // return "new";

            $data = new ModelsPromotion();
            $data->name = $request->name;
            $data->offer = $request->offer;
            $data->type = $request->type;
            $data->product_id = $request->product_id;
            $data->description = $request->description;
            $data->link = $request->link;

            if ($request->file('img')) {
                $uploadFile = $request->file('img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                $data['img'] = $file_name;
            }
            if ($request->file('small_img')) {
                $uploadFile = $request->file('small_img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                $data['img'] = $file_name;
            }
            if ($request->file('bg_banner')) {
                $uploadFile = $request->file('bg_banner');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                $data['img'] = $file_name;
            }
            $data->save();
            return redirect()->back()->with('success', 'Promotion Created Successfully');
        }


    }

    public function gifBanner(Request $request)
    {
        // dd($request->all());
        if ($request->gif_banner_id) {
            $data =  ModelsPromotion::find($request->gif_banner_id);
            $data->type = $request->type;
            $data->link = $request->url;
            if ($request->file('gif_img')) {
                $uploadFile = $request->file('gif_img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                // Remove the old image
                if ($data->gif_img) {
                    $oldImagePath = public_path('images/promotion') . '/' . $data->gif_img;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data['img'] = $file_name;
            }
            $data->save();
            return redirect()->back()->with('success', 'GIF Banner Updated Successfully');
        } else {
            if ($request->file('gif_img')) {
                $data = new ModelsPromotion();
                $data->type = $request->type;
                $data->link = $request->url;
                $uploadFile = $request->file('gif_img');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/promotion'), $file_name);
                $data['img'] = $file_name;
                $data->save();
            }
            return redirect()->back()->with('success', 'GIF Banner Created Successfully');
        }


    }
}
