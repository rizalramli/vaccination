<?php

namespace App\Http\Controllers;

use App\Models\Vaccinator;
use Illuminate\Http\Request;
use DataTables;

class VaccinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Vaccinator::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon edit"><i data-feather="edit" class="wd-10"></i></a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon delete"><i data-feather="trash" class="wd-10"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('vaccinator.index');
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
        Vaccinator::updateOrCreate([
            'id' => $request->id
        ],
        [
            'name' => $request->name,
        ]);        

        return response()->json(['success'=>'Vaksinator berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccinator $vaccinator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vaccineTypes = Vaccinator::find($id);
        return response()->json($vaccineTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vaccinator $vaccinator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccinator  $vaccinator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vaccine = Vaccinator::find($id);
        if($vaccine){
            $vaccine->delete();
        }
        return response()->json(['success'=>'Vaksinator berhasil dihapus.']);
    }
}
