<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recaptcha;

class ReCaptchaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recaptchas = Recaptcha::first();
        return view('pages.admin.recaptcha.create',compact('recaptchas'));
    }

    public function changestatus(Request $request)
    {
        $recaptcha = Recaptcha::find($request->recaptcha_id);
        $recaptcha->status = $request->status;
        $recaptcha->save();

        if ($request->status == 1) {
            return response()->json(['success'=>'ReCaptcha Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error'=>'ReCaptcha Deactivate.']);
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
       $recaptcha_create = Recaptcha::first();
       if (!empty($recaptcha_create)) {
           $id = $recaptcha_create->id;
           $recaptcha = Recaptcha::find($id);
           $recaptcha->update([
            'site_key' => $request->site_key,
            'secret_key' => $request->secret_key,
        ]);
        return back()->with('success', 'Recaptcha Updated Successfully');
       } else {

           Recaptcha::create([
               'site_key' => $request->site_key,
               'secret_key' => $request->secret_key,
           ]);
           return back()->with('success', 'Recaptcha Created Successfully');
       }
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
