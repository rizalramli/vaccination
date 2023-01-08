<?php

namespace App\Http\Controllers;

use App\Models\Kipi;
use Illuminate\Http\Request;

class KipiController extends Controller
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
        $request->validate([
            'incident_date' => 'required',
            'indication' => 'required',
            'action' => 'required',
            'is_contact_doctor' => 'required',
        ],
        [
            'incident_date.required' => 'Tanggal kejadian harus diisi',
            'indication.required' => 'Gejala harus diisi',
            'action.required' => 'Tindakan harus diisi',
            'is_contact_doctor.required' => 'Sudah menghubungi dokter harus diisi',
        ]);
        
        $kipi = new Kipi();
        $kipi->vaccination_id = $request->vaccination_id;
        $kipi->incident_date = $request->incident_date;
        $kipi->indication = $request->indication;
        $kipi->action = $request->action;
        $kipi->is_contact_doctor = $request->is_contact_doctor;
        $kipi->save();

        return response()->json(['success'=>'Kipi berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kipi  $kipi
     * @return \Illuminate\Http\Response
     */
    public function show(Kipi $kipi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kipi  $kipi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kipi $kipi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kipi  $kipi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kipi $kipi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kipi  $kipi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kipi::find($id);
        if($data){
            $data->delete();
        }
        return response()->json(['success'=>'kipi berhasil dihapus.']);
    }
}
