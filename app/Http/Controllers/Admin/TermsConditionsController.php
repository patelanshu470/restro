<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function terms_and_conditions()
    {
        return view('pages.extra.terms_&_conditions');
    }
    public function privacypolicy()
    {
        return view('pages.extra.privacy_policy');
    }
}
