<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class TableReservationController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('status',1)->get();
        return view('pages.user.restaurant.table_reservation',compact('restaurant'));
    }
}
