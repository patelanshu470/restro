<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Restaurant;
use App\Models\Reservation;
use DataTables;
use Mail;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rest_data = Restaurant::where('user_id','=',auth()->user()->id)->first();
        if ($request->ajax()) {
            // $data = Reservation::select('*');
            $data = Reservation::select('*')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END, status ASC")->where('restaurant_id',$rest_data->id)
            ->latest();

            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($table){
                //     $actionBtn = '<div class="flex align-items-center list-user-action">
                //     <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="'.route('reservation.edit',$table->id).'" >
                //        <div style="position: relative; top: -2px; width: 20px;
                //            text-align: center;
                //            vertical-align: middle;">
                //                <i class="fa-regular fa-pen-to-square" width="32"></i>
                //            </div>
                //     </a>
                //     <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$table->id.')">
                //        <span class="btn-inner">
                //            <div style="position: relative; top: -2px; width: 20px;
                //            text-align: center;
                //            vertical-align: middle;">
                //               <i class="fa-solid fa-trash"></i>
                //            </div>
                //        </span>
                //     </a>
                //     <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$table->id.'" href="'.route('reservation.destroy',$table->id).'" style="display: none">
                //        <span class="btn-inner">
                //           <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                //              <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                //              <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                //              <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                //           </svg>
                //        </span>
                //     </a>
                //  </div>';
                //     return $actionBtn;
                // })
                ->editColumn('first_name', function($reservation) {
                    return '
                    <div class="customer--name">
                    '.$reservation->first_name.' '.$reservation->last_name.'
                    </div>';
                })
                ->editColumn('res_date', function($reservation) {
                    return date('d M Y', strtotime($reservation->res_date));;
                })
                ->editColumn('table_id', function($reservation) {
                    return $reservation->table->name;
                })
                ->addColumn('status', function($reservation) {
                    return ' <div class="form-group ">
                    <select data-id="'.$reservation->id.'" id="status'.$reservation->id.'" data-href="'.route('restro.reservation_status', $reservation->id).'"  name="type" class="selectpicker form-control" id="type" >
                     <option selected disabled>Select status</option>
                     <option '.(($reservation->status=="approve") ? 'selected' : '').' value="approve">Approve</option>
                     <option '.(($reservation->status=="pending") ? 'selected' : '').' value="pending">Pending</option>
                     <option '.(($reservation->status=="reject") ? 'selected' : '').' value="reject" >Reject</option>
                     <option '.(($reservation->status=="visited") ? 'selected' : '').' value="visited" >Visited</option>
                  </select>
                 </div>';
                    // return '<div class="form-switch"><input data-id="'.$reservation->id.'" class="form-check-input status" id="status'.$reservation->id.'" type="checkbox" data-href="'.route('restro.reservation_status', $reservation->id).'" data-on="1" data-off="0" name="status" id="flexSwitchCheckDefault"  style="width: 40px; height:20px;" '.($reservation->status ? 'checked' : '').' onclick="statusRecord('.$reservation->id.')"></div>';
                })
                ->rawColumns(['first_name','res_date','table_id','status'])
                ->make(true);
        }
        $reservation = Reservation::all();
        return view('pages.restaurant.reservation.index',compact('reservation'));
    }

    public function changestatus(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = $request->status;
        $reservation->save();

        if ($request->status) {
            return response()->json(['success'=>'Status updated successfully.']);
        }

        // if ($request->status == 0) {
        //     return response()->json(['error'=>'Reservation Deactivate.']);
        // }
    }

    public function approve(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $data = array('tomail'=>$reservation->email,'tonamemail'=>$reservation->first_name .' '. $reservation->last_name,'reservation_id'=>$reservation->id);
            Mail::send('pages.restaurant.reservation.acceptmail', $data, function($message)use ($data) {
                $message->to($data['tomail'], $data['tonamemail'])->subject
                   ('Reservation');
                // $message->from('Veggiegrill');
             });
        $reservation->status = "approve";
        $reservation->save();
        return back()->with('success','Mail Send Successfully');
    }

    public function reject(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $data = array('tomail'=>$reservation->email,'tonamemail'=>$reservation->first_name .' '. $reservation->last_name,'reservation_id'=>$reservation->id,'reject_reason'=>$request->reject_reason);
            Mail::send('pages.restaurant.reservation.rejectmail', $data, function($message)use ($data) {
                $message->to($data['tomail'], $data['tonamemail'])->subject
                   ('Reservation');
            });

        $reservation->status = "reject";
        $reservation->reject_reason = $request->reject_reason;
        $reservation->save();
        return back()->with('success','Mail Send Successfully');
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
        //
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
        $data = Reservation::find($id);
        $tables = Table::where('status','available')->get();
        return view('pages.restaurant.reservation.edit',compact('data','tables'));
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
