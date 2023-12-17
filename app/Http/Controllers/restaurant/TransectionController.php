<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Payment;
use DataTables;

class TransectionController extends Controller
{
    public function index(Request $request)
    {
        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();
        if ($request->ajax()) {
            $data = Payment::join('orders', 'payments.order_id', '=', 'orders.id')->where([['orders.restaurant_id', '=', $rest_data->id]])->select('payments.*')->orderBy('id', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($order){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('restro.order.show',$order->order_id).'" >
                       <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-eye" width="32"></i>
                           </div>
                    </a>
                 </div>';
                    return $actionBtn;
                })
                ->editColumn('order_id', function($reservation) {
                    return ' <a href="'.route('restro.order.show',$reservation->order_id).'" class="text-primary">#'. $reservation->order_id.'</a>';

                })
                ->addColumn('payment_status', function($reservation) {
                    if ($reservation->payment_status == 'captured') {
                        return '<span class="badge bg-soft-success">Captured</span>';
                    } else {
                        return '<span class="badge bg-danger">Pending</span>';
                    }
                })
                ->rawColumns(['order_id','payment_status','action'])
                ->make(true);
        }

        return view('pages.restaurant.transection.index');
    }
}
