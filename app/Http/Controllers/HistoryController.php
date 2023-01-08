<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Kipi;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use DataTables;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $employee_id = Employee::where('user_id',$user_id)->first()->id;
        $vaccination = Vaccination::with('schedule')->where('employee_id', $employee_id)->orderBy('id', 'asc')->get();
        return view('history.index', compact('vaccination'));
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
    public function show($id, Request $request)
    {
        $vaccination_id = $id;
        $vaccination = Vaccination::with(['employee','schedule.vaccinator','schedule.vaccineType'])->find($id);
        if($request->ajax()){
            $data = Kipi::where('vaccination_id',$vaccination_id)->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('incident_date',function($row){
                        return date('d M Y',strtotime($row->incident_date));
                    })
                    ->editColumn('is_contact_doctor',function($row){
                        if($row->is_contact_doctor === 1){
                            return 'Sudah';
                        } else {
                            return 'Belum';
                        }
                    })
                    ->addColumn('actionn', function($row){
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon delete"><i data-feather="trash" class="wd-10"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['actionn'])
                    ->make(true);
        }

        return view('history.show',compact('vaccination_id','vaccination'));
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
