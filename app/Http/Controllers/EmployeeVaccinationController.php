<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Vaccination;
use Illuminate\Http\Request;

class EmployeeVaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::orderBy('implementation_date', 'desc')->get();
        return view('employee-vaccination.index', compact('schedule'));
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
        $employee_id = 6;
        $schedule_id = $request->schedule_id;
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

        return response()->json(['success'=>'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee_id = 6;
        $schedule_id = $id;
        $schedule = Schedule::find($id);
        $quota = $schedule->quota - $schedule->participants->count();
        // check if employee already registered
        $vaccination = Vaccination::where('schedule_id',$schedule_id)->where('employee_id',$employee_id)->first();
        if($vaccination){
            $is_registered = true;
        } else {
            $is_registered = false;
        }
        return view('employee-vaccination.show', compact('schedule', 'quota', 'is_registered'));
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
