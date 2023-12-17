<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use DataTables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = State::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($categories){
                    $actionBtn = '<div class="flex align-items-center list-user-action">
                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#" data-bs-toggle="modal" data-bs-target="#EditModalCenter'.$categories->id.'">
                       <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                               <i class="fa-regular fa-pen-to-square" width="32"></i>
                           </div>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" onclick="deleteRecord('.$categories->id.')">
                       <span class="btn-inner">
                           <div style="position: relative; top: -2px; width: 20px;
                           text-align: center;
                           vertical-align: middle;">
                              <i class="fa-solid fa-trash"></i>
                           </div>
                       </span>
                    </a>
                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" id="del'.$categories->id.'" href="'.route('state.destroys',$categories->id).'" style="display: none">
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
                ->editColumn('country_id', function($state) {
                    return $state->country->name;

                 })
                ->rawColumns(['action','country_id'])
                ->make(true);
        }
        $state = State::all();
        $country = Country::all();
        return view('pages.admin.state.index',compact('state','country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all();
        return view('pages.admin.state.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $states = State::where('name','=',$request->name)->where('country_id','=',$request->country_id)->first();
        if (isset($states)) {
            return back()->with('warning', 'Duplicate entry is not allow');
        }
        State::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        return redirect()->route('state.index')->with('success', 'State Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::all();
        $state = State::find($id);
        return view('pages.admin.state.edit',compact('state','country'));
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
        $state = State::find($id);

        $states_check = State::where('name','=',$request->name)->where('country_id','=',$request->country_id)->first();
        if (isset($states_check)) {
            return back()->with('warning', 'Duplicate entry is not allow');
        }
        $state->update([
            'name' => $request->name,
            'country_id' => $request->country_id
        ]);
        return redirect()->route('state.index')->with('success', 'State Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id)->delete();
        $city = City::where('state_id',$id)->delete();
        return redirect()->route('state.index')->with('error', 'State Deleted Successfu lly');
    }
}
