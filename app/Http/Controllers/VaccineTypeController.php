<?php

namespace App\Http\Controllers;

use App\Models\VaccineType;
use Illuminate\Http\Request;
use DataTables;

class VaccineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VaccineType::latest()->get();
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
        return view('vaccine-type.index');
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
            'name' => 'required',
        ],
        [
            'name.required' => 'Nama harus diisi',
        ]);

        VaccineType::updateOrCreate([
            'id' => $request->id
        ],
        [
            'name' => $request->name,
        ]);        

        return response()->json(['success'=>'Jenis Vaksin berhasil disimpan.']);
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
        $vaccineTypes = VaccineType::find($id);
        return response()->json($vaccineTypes);
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
        $vaccine = VaccineType::find($id);
        if($vaccine){
            $vaccine->delete();
        }
        return response()->json(['success'=>'Jenis vaksin berhasil dihapus.']);
    }
}
