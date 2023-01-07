<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use DataTables;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccination $vaccination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $schedule_id = $id;
        if ($request->ajax()) {
            $data = Vaccination::with('employee')->where('schedule_id',$schedule_id)->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon delete"><i data-feather="trash" class="wd-10"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('vaccination.edit', compact('schedule_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccination $vaccination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vaccination = Vaccination::find($id);
        if($vaccination){
            $vaccination->delete();
        }
        return response()->json(['success'=>'Vaksinasi berhasil dihapus.']);
    }

    public function loadEmployee(Request $request)
    {
        if($request->ajax()){
            $data = Employee::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('nip', function($row){
                        $html = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="user1" name="user">
                        <label class="custom-control-label" for="user1">'.$row->nip.'</label>
                      </div>';
                        return $html;
                    })
                    ->rawColumns(['nip'])
                    ->make(true);
        }
    }
}
