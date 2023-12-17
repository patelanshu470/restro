<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use Validator;
use Image;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logo = Logo::first();
        return view('pages.admin.logo.index',compact('logo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $logo_create = Logo::first();
        if (!empty($logo_create)) {
            $id = $logo_create->id;
            $logo = Logo::find($id);
            if ($request->restro_image) {
                $uploadFile = $request->restro_image;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                // Remove the old image
                if ($logo->logo) {
                    $oldImagePath = public_path('images/logo') . '/' . $logo->logo;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $logo->logo = $file_name;
            }
            if ($request->favicon_icon) {
                $uploadFile = $request->favicon_icon;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                // Remove the old image
                if ($logo->favicon_icon) {
                    $oldImagePath = public_path('images/logo') . '/' . $logo->favicon_icon;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $logo->favicon_icon = $file_name;
            }
            if ($request->sidebar_logo) {
                $uploadFile = $request->sidebar_logo;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                // Remove the old image
                if ($logo->sidebar_logo) {
                    $oldImagePath = public_path('images/logo') . '/' . $logo->sidebar_logo;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $logo->sidebar_logo = $file_name;
            }
            if ($request->cover_image) {
                $uploadFile = $request->cover_image;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                // Remove the old image
                if ($logo->cover_image) {
                    $oldImagePath = public_path('images/logo') . '/' . $logo->cover_image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $logo->cover_image = $file_name;
            }
                $logo->save();


        } else {
            $logo=null;
            $logo = new Logo();

            if ($request->restro_image) {
                $uploadFile = $request->restro_image;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                $logo->logo = $file_name;
                // $logo->save();
            }
            if ($request->favicon_icon) {
                $uploadFile = $request->favicon_icon;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                $logo->favicon_icon = $file_name;
                // $logo->save();
            }
            if ($request->sidebar_logo) {
                $uploadFile = $request->sidebar_logo;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                $logo->sidebar_logo = $file_name;
                // $logo->save();
            }
            if ($request->cover_image) {
                $uploadFile = $request->cover_image;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile-> move(public_path('images/logo'), $file_name);
                $logo->cover_image = $file_name;
                // $logo->save();
            }
                $logo->save();
        }
        return redirect()->back()->with('success', 'Logo Created Successfully');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
