<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Vaccination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Vaccination::with('employee','schedule.vaccinator')->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('employee_id', function($row){
                        $html = '<a href="'.route('employee.show',$row->employee->id).'">
                        <p class="mg-b-0 tx-medium tx-color-its3">'.$row->employee->name.'</p>
                        <p class="mg-b-0 tx-13 tx-color-03">'.$row->employee->nik.'</p>
                        </a>';
                        return $html;
                    })
                    ->editColumn('is_vaccinated', function($row){
                        if($row->is_vaccinated === 0){
                            $html = '<span class="tx-color-01"><i class="fas fa-times-circle mg-r-5 tx-danger"></i>Tidak hadir</span>';
                        } else if($row->is_vaccinated === 1){
                            $html = '<span class="tx-color-01"><i class="fas fa-check-circle mg-r-5 tx-success"></i>Hadir</span>';
                        } else {
                            $html = '
                                <button class="btn btn-white btn-icon btnPresenceTrue" data-id="'.$row->id.'" type="button" data-toggle="tooltip" data-placement="bottom" title="Hadir"><i class="fas fa-check-circle tx-success"></i></button>
                                <button class="btn btn-white btn-icon btnPresenceFalse" data-id="'.$row->id.'" type="button" data-toggle="tooltip" data-placement="bottom" title="Tidak hadir"><i class="fas fa-times-circle tx-danger"></i></button>';
                        }
                        return $html;
                    })
                    ->editColumn('schedule_id',function($row){
                        return date('d/m/Y',strtotime($row->schedule->implementation_date));
                    })
                    ->editColumn('next_vaccination_date',function($row){
                        if($row->next_vaccination_date){
                            return date('d/m/Y',strtotime($row->next_vaccination_date));
                        }
                    })
                    ->rawColumns(['employee_id','is_vaccinated','schedule_id'])
                    ->make(true);
        }
        return view('vaccination.index');
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
        // remove employee_id if registered
        $employee_id = $request->employee_id;
        $schedule_id = $request->schedule_id;
        $vaccination = Vaccination::where('schedule_id',$schedule_id)->get();
        foreach($vaccination as $v){
            $key = array_search($v->employee_id, $employee_id);
            if($key !== false){
                unset($employee_id[$key]);
            }
        }

        $employee_count = count($employee_id);
        $schedule = Schedule::find($schedule_id);
        $vaccination_count = Vaccination::where('schedule_id',$schedule_id)->count();
        $quota = $schedule->quota - $vaccination_count;

        if($employee_count > $quota){
            return response()->json(['error'=>'Kuota tidak mencukupi.']);
        }

        foreach($employee_id as $employee_id){
            $check_vaccination_number = Vaccination::where('employee_id',$employee_id)->where('is_vaccinated',1)->count();
            Vaccination::updateOrCreate(
                [
                    'employee_id' => $employee_id,
                    'schedule_id' => $schedule_id
                ],
                [
                    'employee_id' => $employee_id,
                    'schedule_id' => $schedule_id,
                    'vaccination_number' => $check_vaccination_number + 1
                ]
            );
        }
        
        return response()->json(['success'=>'Data berhasil ditambahkan.']);
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
        $employee = Employee::latest()->get();
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
        return view('vaccination.edit', compact('employee','schedule_id'));
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

    public function presence(Request $request)
    {
        $vaccination = Vaccination::find($request->id);
        if($vaccination){
            if($request->is_vaccinated == 1){
                $vaccination->vaccination_date = Carbon::now();
                $vaccination->next_vaccination_date = $request->next_vaccination_date;
            }
            $vaccination->is_vaccinated = $request->is_vaccinated;
            $vaccination->save();
        }
        return response()->json(['success'=>'Data berhasil diubah.']);
    }
}
