@extends('layouts.app')

@section('content')
@php 
    $registration_date_start = date('Y-m-d',strtotime($schedule->registration_date_start));
    $registration_date_end = date('Y-m-d',strtotime($schedule->registration_date_end));
    $now = date('Y-m-d');
    $status = 'Pendaftaran dibuka';
    if($now < $registration_date_start){
        $status = 'Pendaftaran belum dibuka';
    }else if($now > $registration_date_end){
        $status = 'Pendaftaran ditutup';
    }
@endphp
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('schedule.index')}}">Jadwal Vaksinasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Vaksinasi</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Detail Vaksinasi
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        <a href="{{route('schedule.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
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
                                <h5 class="tx-medium tx-montserrat mg-b-0">{{\Helper::getDayNameIndonesian(date('D',strtotime($schedule->implementation_date)))}}, {{date('d M Y',strtotime($schedule->implementation_date))}}</h5>
                                <p class="mg-b-5">{{date('H.i',strtotime($schedule->implementation_time_start))}} - {{date('H.i',strtotime($schedule->implementation_time_end))}}</p>
                                @if($status == 'Pendaftaran dibuka')
                                <span class="tx-13"><span class="tx-info"><i class="far fa-play-circle mg-r-5"></i>{{$status}}</span></span>
                                @elseif($status == 'Pendaftaran belum dibuka')
                                <span class="tx-13"><span class="tx-gray-700"><i class="far fa-circle mg-r-5"></i>{{$status}}</span></span>
                                @else
                                <span class="tx-13"><span class="tx-danger"><i class="far fa-times-circle mg-r-5"></i>{{$status}}</span></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 col-lg-2 d-flex align-items-center justify-content-end">
                        <div class="dropdown dropdown-custom">
                            <button class="btn btn-white tx-montserrat tx-semibold d-none d-lg-block" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical" class="wd-10 mg-r-5"></i>Pilihan
                            </button>
                            <button class="btn btn-white btn-icon d-lg-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('schedule.edit',$schedule->id)}}"><i data-feather="edit"></i>Edit</a>
                                <a class="dropdown-item" href="#modalDelete" data-toggle="modal" data-animation="effect-scale"><i data-feather="trash"></i>Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body card-list">
                <p class="tx-medium tx-15">Tentang Vaksinasi Ini</p>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinator</span>
                    <p class="mg-b-0">{{$schedule->vaccinator->name}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Vaksin</span>
                    <p class="mg-b-0">{{$schedule->vaccineType->name}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendaftaran</span>
                    <p class="mg-b-0">{{date('d M Y',strtotime($schedule->registration_date_start))}} - {{date('d M Y',strtotime($schedule->registration_date_end))}}</p>
                </div>
                <hr class="mg-t-20 mg-b-20">
                <p class="tx-medium tx-15">Pelaksanaan</p>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Vaksinasi</span>
                    <p class="mg-b-0">{{date('d M Y',strtotime($schedule->implementation_date))}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Sesi Vaksinasi</span>
                    <p class="mg-b-0">{{date('H.i',strtotime($schedule->implementation_time_start))}} - {{date('H.i',strtotime($schedule->implementation_time_end))}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Lokasi</span>
                    <p class="mg-b-0">{{$schedule->location}}</p>
                </div>
                <div class="card-list-text">
                    <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Kuota</span>
                    <p class="mg-b-0">{{$schedule->quota}} orang</p>
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
                                <h5 class="tx-medium tx-montserrat mg-b-0">Peserta Vaksinasi</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-sm-2 col-lg-2 d-flex align-items-center justify-content-end">
                        @if($status != 'Pendaftaran ditutup')
                        <a href="{{route('vaccination.edit',$schedule->id)}}" class="btn btn-white tx-montserrat tx-semibold float-right d-none d-lg-block"><i data-feather="edit" class="wd-10 mg-r-5"></i> Edit Peserta</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <span class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Peserta yang sudah dipilih</span>
                <p class="mg-b-0">{{$countParticipant}} orang</p>
            </div>
        </div>
    </div>

    <div class="modal fade effect-scale" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="hapusvaksinasi" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-14 bg-white">
                <div class="modal-body">
                    <h5 class="tx-montserrat tx-medium">Apakah Anda yakin ingin menghapus jadwal vaksinasi ini?</h5>
                    <span>Tindakan ini tidak dapat dibatalkan.</span>
                </div>
                <div class="modal-footer bd-t-0">
                    <form>
                        <a href="#" data-toggle="modal" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batalkan</a>
                        <button data-id="{{$schedule->id}}" id="deleteBtn" type="button" class="btn btn-its tx-montserrat tx-semibold mg-l-5">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div><!-- row -->

@include('schedule.script')

@endsection