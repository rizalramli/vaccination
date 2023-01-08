<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon edit"><i data-feather="edit" class="wd-10"></i></a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-white btn-icon delete"><i data-feather="trash" class="wd-10"></i></a>';
                            return $btn;
                    })
                    ->editColumn('name', function($row) {
                        $html = '<a href="'.route('employee.show',$row->id).'">
                        <p class="mg-b-0 tx-medium tx-color-its3">'.$row->name.'</p>
                        <p class="mg-b-0 tx-13 tx-color-03">'.$row->nik.'</p>
                        </a>';
                        return $html;
                    })
                    ->editColumn('gender', function($row) {
                        return $row->gender == 0 ? 'Laki-laki' : 'Perempuan';
                    })
                    ->editColumn('birth_date', function($row) {
                        return date('d/m/Y', strtotime($row->birth_date));
                    })
                    ->editColumn('is_active', function($row) {
                        return $row->is_active == 0 ? 'Tidak Aktif' : 'Aktif';
                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
        }
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nik' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'nip' => 'required',
            'blood_type' => 'required',
            'phone' => 'required',
            'is_active' => 'required',
        ],
        [
            'nik.required' => 'NIK harus diisi',
            'name.required' => 'Nama harus diisi',
            'gender.required' => 'Jenis kelamin harus diisi',
            'birth_date.required' => 'Tanggal lahir harus diisi',
            'nip.required' => 'NIP/NPP harus diisi',
            'blood_type.required' => 'Golongan darah harus diisi',
            'phone.required' => 'Nomor HP harus diisi',
            'is_active.required' => 'Status harus diisi',
        ]);

        $random_password = \Str::random(8);

        $user = User::updateOrCreate([
            'id' => $request->user_id
        ],
        [
            'name' => $request->name,
            'email' => $request->nip,
            'password' => bcrypt($random_password),
        ]);

        $user->assignRole('employee');

        Employee::updateOrCreate([
            'id' => $request->id
        ],
        [
            'user_id' => $user->id,
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'nip' => $request->nip,
            'blood_type' => $request->blood_type,
            'phone' => $request->phone,
            'password' => $random_password,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['success'=>'Pegawai berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee){
            User::find($employee->user_id)->delete();
            $employee->delete();
        }
        return response()->json(['success'=>'Pegawai berhasil dihapus.']);
    }
}
