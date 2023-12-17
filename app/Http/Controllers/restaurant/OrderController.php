<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use App\Models\OrderProduct;
use App\Models\Restaurant;
use App\Models\Addons;
use App\Models\Product;
use App\Models\Address;
use App\Models\Payment;
use Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use PDF;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
            $data = Order::where('restaurant_id',$restaurant_fetch->id)->where('payment_status','captured')->orderBy('id','DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($datas){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('restro.order.show',$datas->id).'">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                             <i class="fa-regular fa-eye" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" href="'.route('download-pdf',$datas->id).'">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                         <i class="fa-solid fa-print" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$datas->id.'" href="'.route('product.destroys',$datas->id).'" style="display: none">
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
                ->addColumn('order_id', function($row){
                    return ' <a href="'.route('restro.order.show',$row->id).'" class="text-primary">#'. $row->id.'</a>';
                })
                ->editColumn('status', function($order) {
                    if ($order->status == 0) {
                       return '<span class="badge bg-soft-primary">Pending</span>';
                    }
                    if ($order->status == 1) {
                        return '<span class="badge bg-soft-success">Confirmed</span>';
                    }
                    if ($order->status == 2) {
                        return '<span class="badge bg-soft-danger">Canceled</span>';
                    }

                })
                ->editColumn('user_id', function($order) {
                    return '<a class="text-body" href="#">
                    <div class="customer--name">
                    '.$order->user->first_name.' '.$order->user->last_name.'
                    </div>
                    <span class="phone">
                    +91 '.$order->user->phone_number.'
                    </span>
                    </a>';
                })
                ->rawColumns(['action','order_id','status','user_id'])
                ->make(true);
        }
        return view('pages.restaurant.orders.index');
    }

    public function show(Request $request,$id)
    {
        $order = Order::findOrfail($id);

        $payment_id_get = Payment::where('order_id',$id)->first();
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($payment_id_get->payment_id);
        // $payment->method;
        if($payment->method == 'card') {
            $cardNetwork = $payment->card->network;
            $cardIssuer = $payment->card->issuer;
            $cardName = $payment->card->name;
            $cardLast4 = $payment->card->last4;
        }
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
          $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $id)->where('atype', 'shipping')->first();

        $Favourite_Product = OrderProduct::join('products', 'order_products.product_id', '=', 'products.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('orders', 'order_products.order_id', '=', 'orders.id')
        ->selectRaw('sub_categories.id, sub_categories.name, COUNT(*) as order_count')
        ->where('orders.user_id', $order->user_id)
        ->where('orders.payment_status', '=', 'captured')
        ->groupBy('sub_categories.id', 'sub_categories.name')
        ->orderBy('order_count', 'desc')
        ->limit(2)
        ->get();



        return view('pages.restaurant.orders.show',compact('order', 'billing_address', 'shipping_address', 'OrderProduct','Favourite_Product','payment'));
    }

    public function invoice(Request $request,$id)
    {
        $restaurant = Restaurant::where('user_id',auth()->user()->id)->first();
        $restaurant_address = Address::where('addresable_id', $restaurant->id)->where('addresable_type', 'App\Models\Restaurant')->first();
        $order = Order::findOrfail($id);
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $id)->where('atype', 'shipping')->first();
        return view('pages.restaurant.orders.invoice',compact('restaurant','restaurant_address','order', 'billing_address', 'shipping_address', 'OrderProduct'));
    }

    public function pending(Request $request)
    {
        if ($request->ajax()) {
            $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
            $data = Order::where([['restaurant_id',$restaurant_fetch->id],['status',0]])->where('payment_status','captured')->orderBy('id','DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($datas){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('restro.order.show',$datas->id).'">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                             <i class="fa-regular fa-eye" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$datas->id.')">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                         <i class="fa-solid fa-print" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$datas->id.'" href="'.route('product.destroys',$datas->id).'" style="display: none">
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
                ->addColumn('order_id', function($row){
                    return ' <a href="'.route('restro.order.show',$row->id).'" class="text-primary">#'. $row->id.'</a>';
                })
                ->editColumn('status', function($order) {
                    if ($order->status == 1) {
                       return '<span class="badge bg-success">Active</span>';
                    } else {
                       return '<span class="badge bg-soft-primary">Pending</span>';
                    }
                })
                ->editColumn('user_id', function($order) {
                    return '<a class="text-body" href="#">
                    <div class="customer--name">
                    '.$order->user->first_name.' '.$order->user->last_name.'
                    </div>
                    <span class="phone">
                    +91 '.$order->user->phone_number.'
                    </span>
                    </a>';
                })
                ->rawColumns(['action','order_id','status','user_id'])
                ->make(true);
        }
        return view('pages.restaurant.orders.pending');
    }

    public function confirmed(Request $request)
    {
        if ($request->ajax()) {
            $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
            $data = Order::where([['restaurant_id',$restaurant_fetch->id],['status',1]])->where('payment_status','captured')->orderBy('id','DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($datas){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('restro.order.show',$datas->id).'">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                             <i class="fa-regular fa-eye" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$datas->id.')">
                       <span class="btn-inner">
                         <div style="position: relative; top: -2px; width: 20px;
                         text-align: center;
                         vertical-align: middle;">
                         <i class="fa-solid fa-print" width="32"></i>
                         </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$datas->id.'" href="'.route('product.destroys',$datas->id).'" style="display: none">
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
                ->addColumn('order_id', function($row){
                    return ' <a href="'.route('restro.order.show',$row->id).'" class="text-primary">#'. $row->id.'</a>';
                })
                ->editColumn('status', function($order) {
                    if ($order->status == 0) {
                        return '<span class="badge bg-soft-primary">Pending</span>';
                     }
                     if ($order->status == 1) {
                         return '<span class="badge bg-soft-success">Confirmed</span>';
                     }
                     if ($order->status == 2) {
                         return '<span class="badge bg-soft-danger">Canceled</span>';
                     }
                })
                ->editColumn('user_id', function($order) {
                    return '<a class="text-body" href="#">
                    <div class="customer--name">
                    '.$order->user->first_name.' '.$order->user->last_name.'
                    </div>
                    <span class="phone">
                    +91 '.$order->user->phone_number.'
                    </span>
                    </a>';
                })
                ->rawColumns(['action','order_id','status','user_id'])
                ->make(true);
        }
        return view('pages.restaurant.orders.confirmed');
    }

    public function OrderCanceled(Request $request,$order_id)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $order = Order::findOrfail($order_id);
            $order->status = 2;
            $order->cancel_by = 'restaurant';
            $order->cancel_resoan = $request->canceled_reason;
            $order->save();
            return response()->json(['error'=>'Order Canceled Successfully.']);
        }

        return redirect()->route('restro.order.index')->with('error', 'Order Canceled Successfully');
    }

    public function OrderConfirmed(Request $request,$order_id)
    {
        $order = Order::findOrfail($order_id);
        $order->status = 1;
        $order->save();
        return redirect()->route('restro.order.index')->with('success', 'Order Confirmed Successfully');
    }

    public function CheckNewOrder(Request $request)
    {
        $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
        $data = Order::where([['restro_read_at',0],['restaurant_id',$restaurant_fetch->id]])->where('payment_status','captured')->first();
        if(!$data == null) {
            return response()->json($data);
        }
    }

    public function ReadNewOrder(Request $request)
    {
        $restaurant_fetch = Restaurant::where('user_id',Auth::user()->id)->first();
        $data = Order::where([['restro_read_at',0],['restaurant_id',$restaurant_fetch->id]])->where('payment_status','captured')->first();
        $data->restro_read_at = 1;
        $data->save();
    }

    public function downloadPDF($id)
    {
        $restaurant = Restaurant::where('user_id',auth()->user()->id)->first();
        $restaurant_address = Address::where('addresable_id', $restaurant->id)->where('addresable_type', 'App\Models\Restaurant')->first();
        $order = Order::findOrfail($id);
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('addresable_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('addresable_id', $id)->where('atype', 'shipping')->first();

        $pdf = PDF::loadView('pages.restaurant.orders.invoice', array('restaurant' =>  $restaurant,'restaurant_address'=>$restaurant_address,'order'=>$order,'OrderProduct'=>$OrderProduct))
        ->setPaper('a4', 'portrait');

        return $pdf->download('invoice.pdf');
    }
}
