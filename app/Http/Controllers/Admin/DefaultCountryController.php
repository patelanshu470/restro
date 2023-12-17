<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefaultCountry;

class DefaultCountryController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->country_name=="canada"){
            $country_code=null;
            $country_code="+1";
        }
        elseif($request->country_name=="australia"){
            $country_code=null;
            $country_code="+61";
        }
        elseif($request->country_name=="usa"){
            $country_code=null;
            $country_code="+1";
        }

        $create_default_country = DefaultCountry::first();
       if (!empty($create_default_country)) {
           $id = $create_default_country->id;
           $default_country = DefaultCountry::find($id);
           $default_country->update([
            'country_code' => $country_code,
            'country_name' => $request->country_name,

        ]);
        return back()->with('success', 'Default Country Updated Successfully');
       } else {

        DefaultCountry::create([
               'country_code' => $country_code,
                'country_name' => $request->country_name,

           ]);
           return back()->with('success', 'Default Country Created Successfully');
       }
    }
}
