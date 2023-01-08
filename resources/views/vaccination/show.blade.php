@extends('layouts.app')

@section('content')

@php 
$now = date('Y-m-d H:i:s');
$implementation_date_start = date('Y-m-d H:i:s',strtotime($vaccination->schedule->implementation_date.' '.$vaccination->schedule->implementation_time_start));
$implementation_date_end = date('Y-m-d H:i:s',strtotime($vaccination->schedule->implementation_date.' '.$vaccination->schedule->implementation_time_end));
if($vaccination->is_vaccinated === 0 || $vaccination->is_vaccinated === 1){
    $status = 'Selesai';
} else if($now < $implementation_date_start && $vaccination->is_vaccinated == 0){
    $status = 'Menunggu vaksinasi';
} else {
    $status = 'Selesai';
}

@endphp

<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('vaccination.index')}}">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">KIPI</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Detail Riwayat
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        <a href="{{route('vaccination.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
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
                                <h5 class="tx-medium tx-montserrat mg-b-0">{{\Helper::getDayNameIndonesian(date('D',strtotime($vaccination->schedule->implementation_date)))}}, {{date('d M Y',strtotime($vaccination->schedule->implementation_date))}}</h5>
                                <p class="mg-b-5">{{date('H.i',strtotime($vaccination->schedule->implementation_time_start))}} - {{date('H.i',strtotime($vaccination->schedule->implementation_time_end))}}</p>
                                @if($vaccination->is_vaccinated == 1)
                                <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                @elseif($status == 'Selesai')
                                <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                @else 
                                <span class="tx-13"><span class="tx-info"><i class="far fa-arrow-alt-circle-right mg-r-5"></i>Menunggu vaksinasi</span></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-list">
                <p class="tx-medium tx-15">Tentang Vaksinasi Ini</p>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nama Karyawan</span>
                    <p class="mg-b-0">{{$vaccination->employee->name}} ({{$vaccination->employee->nik}})</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinator</span>
                    <p class="mg-b-0">{{$vaccination->schedule->vaccinator->name}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Vaksin</span>
                    <p class="mg-b-0">{{$vaccination->schedule->vaccineType->name}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendaftaran</span>
                    <p class="mg-b-0">{{date('d M Y',strtotime($vaccination->schedule->registration_date_start))}} - {{date('d M Y',strtotime($vaccination->schedule->registration_date_end))}}</p>
                </div>
                <hr class="mg-t-20 mg-b-20">
                <p class="tx-medium tx-15">Pelaksanaan</p>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Vaksinasi</span>
                    <p class="mg-b-0">{{date('d M Y',strtotime($vaccination->schedule->implementation_date))}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Sesi Vaksinasi</span>
                    <p class="mg-b-0">{{date('H.i',strtotime($vaccination->schedule->implementation_time_start))}} - {{date('H.i',strtotime($vaccination->schedule->implementation_time_end))}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Lokasi</span>
                    <p class="mg-b-0">{{$vaccination->schedule->location}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Kuota</span>
                    <p class="mg-b-0">{{$vaccination->schedule->quota}} orang</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinasi Ke</span>
                    <p class="mg-b-0">{{$vaccination->vaccination_number}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card">
            <div class="card-header">
                <div class="row row-xs">
                    <div class="col-10 col-sm-10 col-lg-10 d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="tx-medium tx-montserrat mg-b-0">KIPI</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 col-lg-2 d-flex align-items-center justify-content-end">
                    </div>
                </div>
            </div>
            <div class="card-body pd-0">
                <div class="table-responsive">
                    <table id="dataTable4" class="table table-borderless table-hover" width="100%">
                        <thead>
                            <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                <th class="wd-20p th-its">Tanggal Kejadian</th>
                                <th class="wd-40p th-its">Gejala</th>
                                <th class="wd-25p th-its">Tindakan</th>
                                <th class="wd-15p th-its">Hubungi Dokter</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><!-- row -->

@include('vaccination.script')

@endsection