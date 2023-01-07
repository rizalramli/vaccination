<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Vaccinator;
use App\Models\VaccineType;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::orderBy('implementation_date', 'desc')->get();
        return view('schedule.index', compact('schedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vaccinator = Vaccinator::pluck('name', 'id')->prepend('Pilih', '');
        $vaccineType = VaccineType::pluck('name', 'id')->prepend('Pilih', '');
        return view('schedule.create', compact('vaccinator', 'vaccineType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vaccinator_id' => 'required',
            'vaccine_type_id' => 'required',
            'organizer' => 'required',
            'registration_date_start' => 'required',
            'registration_date_end' => 'required',
            'implementation_date' => 'required',
            'implementation_time_start' => 'required',
            'implementation_time_end' => 'required',
            'location' => 'required',
            'quota' => 'required',
        ],
        [
            'vaccinator_id.required' => 'Vaksinator harus diisi',
            'vaccine_type_id.required' => 'Jenis vaksin harus diisi',
            'organizer.required' => 'Penyelenggara harus diisi',
            'registration_date_start.required' => 'Pendaftaran dimulai harus diisi',
            'registration_date_end.required' => 'Pendaftaran selesai harus diisi',
            'implementation_date.required' => 'Tanggal Vaksinasi harus diisi',
            'implementation_time_start.required' => 'Sesi Vaksinasi Dimulai harus diisi',
            'implementation_time_end.required' => 'Sesi Vaksinasi Selesai harus diisi',
            'location.required' => 'Lokasi harus diisi',
            'quota.required' => 'Kuota harus diisi',
        ]);
        
        Schedule::updateOrCreate([
            'id' => $request->id
        ],
        [
            'vaccinator_id' => $request->vaccinator_id,
            'vaccine_type_id' => $request->vaccine_type_id,
            'organizer' => $request->organizer,
            'registration_date_start' => $request->registration_date_start,
            'registration_date_end' => $request->registration_date_end,
            'implementation_date' => $request->implementation_date,
            'implementation_time_start' => $request->implementation_time_start,
            'implementation_time_end' => $request->implementation_time_end,
            'location' => $request->location,
            'quota' => $request->quota,
        ]);        

        return response()->json(['success'=>'Jadwal vaksinasi berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        $countParticipant = $schedule->participants()->count();
        return view('schedule.show', compact('schedule', 'countParticipant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::find($id);
        $vaccinator = Vaccinator::pluck('name', 'id')->prepend('Pilih', '');
        $vaccineType = VaccineType::pluck('name', 'id')->prepend('Pilih', '');
        return view('schedule.create', compact('vaccinator', 'vaccineType', 'schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if($schedule){
            $schedule->delete();
        }
        return response()->json(['success'=>'Jadwal vaksinasi berhasil dihapus.']);
    }
}
