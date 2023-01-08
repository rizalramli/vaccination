@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Pegawai</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pegawai</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Detail Pegawai
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        <a href="{{route('employee.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
    </div>
</div>
<div class="row row-xs">
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card">
            <div class="card-header">
                <div class="row row-xs">
                    <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="tx-medium tx-montserrat mg-b-0">{{$employee->name}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-list">
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nama</span>
                    <p class="mg-b-0">{{$employee->name}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIK</span>
                    <p class="mg-b-0">{{$employee->nik}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Kelamin</span>
                    <p class="mg-b-0">{{$employee->gender == 0 ? 'Laki-laki' : 'Perempuan'}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Lahir</span>
                    <p class="mg-b-0">{{date('d/m/Y',strtotime($employee->birth_date))}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIP/NPP</span>
                    <p class="mg-b-0">{{$employee->nip}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Golongan Darah</span>
                    <p class="mg-b-0">{{$employee->blood_type}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nomor HP</span>
                    <p class="mg-b-0">{{$employee->phone}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Status</span>
                    <p class="mg-b-0">{{$employee->is_active == 0 ? 'Tidak Aktif' : 'Aktif'}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Password</span>
                    <p class="mg-b-0">{{$employee->password}}</p>
                </div>

            </div>
        </div>
    </div>

</div><!-- row -->
@endsection