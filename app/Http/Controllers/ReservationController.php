<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Restaurant;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function FindTables(Request $request)
    {
        $from_time_final_d = $request->from_time . ' ' . $request->from_am_pm;
        $to_time_final_d = $request->to_time . ' ' . $request->to_am_pm;

        $from_time_final = Carbon::createFromFormat('h:i a', $from_time_final_d)->format('H:i:s');
        $to_time_final = Carbon::createFromFormat('h:i a', $to_time_final_d)->format('H:i:s');

        #getting reseve ids of all user
        $res_table_ids = Reservation::where([
            ['restaurant_id', '=' ,$request->restaurant_id],
            ['res_date', '=' ,Carbon::createFromFormat('d-m-Y', $request->res_date)->format('Y-m-d')],
            ['from_time','=' ,$from_time_final],
            ['to_time','=' , $to_time_final],
        ])->whereIn('status', ["pending", "approve"])->pluck('table_id');


        $res_check = Reservation::where([
            ['res_date', '=' ,Carbon::createFromFormat('d-m-Y', $request->res_date)->format('Y-m-d')],
        ])->whereIn('status', ["pending", "approve"])->get();

        if(count($res_check)>0 ){
            $tables='already-booked';
        }else{
            $tables=null;
            $tables = Table::where('status', 'available')->where('restaurant_id', $request->restaurant_id)
             ->where('guest_number', '>=', $request->guest_number)
             ->whereNotIn('id', $res_table_ids)
             ->get();
        }

           

        return response()->json($tables);
        // return response()->json(['error'=>"booked"]);
    }

    public function create_reservation(Request $request)
    {
        // return $request->all();
        if($request->tab_name=="details"){
            return back()->withFragment('confirm');
            
        }
        else if($request->tab_name=="confirm"){
            $data=Reservation::find($request->reservation_id);
            $data->status="pending";
            $data->save();
            return redirect(route('home'))->with('success', 'Your Booking request is received successfully');

        }
        else{
            $from_time_final_d = $request->from_time . ' ' . $request->from_am_pm;
            $to_time_final_d = $request->to_time . ' ' . $request->to_am_pm;
    
            $from_time_final = Carbon::createFromFormat('h:i a', $from_time_final_d)->format('H:i:s');
            $to_time_final = Carbon::createFromFormat('h:i a', $to_time_final_d)->format('H:i:s');
    
            Reservation::create([
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'email' => auth()->user()->email,
                'phone_number' => auth()->user()->phone_number,
                'res_date' => Carbon::createFromFormat('d-m-Y', $request->res_date)->format('Y-m-d'),
                // 'res_date' => $request->res_date,
                'guest_number' => $request->guest_number,
                'restaurant_id' => $request->restaurant_id,
                'table_id' => $request->tables,
                // 'status' => 'pending',
                'from_time' => $from_time_final,
                'to_time' => $to_time_final,
                'user_id' => auth()->user()->id,
            ]);
        
            return back()->withFragment('details');
        }
   
    }

    public function index()
    {

        $all_products=Product::with('image')->get();

        $product_list = [];
        foreach($all_products as $item){
            $imgs = $item->image;
            foreach ($imgs as $imgs) {

                if ($imgs->field_name == "product_thumbnail") {
                    $item['thumbnail'] = $imgs->path;
                }

            }
            $product_list[]=$item;

        }

    //    return collect($product_list);
        $restaurant = Restaurant::where('status',1)->get();
        return view('pages.user.restaurant.table_reservation',compact('restaurant','product_list'));
    }
}
