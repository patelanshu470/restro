<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Restaurant;
use DataTables;
use Auth;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->first();
        if ($request->ajax()) {
            $data = Table::where('restaurant_id',$restaurant_id->id)->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($table){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#" data-bs-toggle="modal" data-bs-target="#EditModalCenter'.$table->id.'">
                       <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-pen-to-square" width="32"></i>
                           </div>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$table->id.')">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-trash"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$table->id.'" href="'.route('table.destroys',$table->id).'" style="display: none">
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
                ->rawColumns(['action'])
                ->make(true);
        }
        $table = Table::all();
        return view('pages.restaurant.table.index',compact('table'));
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
        $id_find = Restaurant::where('user_id',auth()->user()->id)->first();
        Table::create([
            'name' => $request->name,
            'guest_number' => $request->guest_number,
            'restaurant_id' => $id_find->id,
        ]);
        return back()->with('success', 'Table Created Successfully');
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
        $table = Table::find($id);
        $table->update([
            'name' => $request->name,
            'guest_number' => $request->guest_number,
        ]);
        return back()->with('success', 'Table updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id)->delete();
        return back()->with('error', 'Table Deleted Successfully');
    }
}
