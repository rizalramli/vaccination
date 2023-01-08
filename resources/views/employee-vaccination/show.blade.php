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
                <li class="breadcrumb-item"><a href="{{route('employee-vaccination.index')}}">Jadwal Vaksinasi</a></li>
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
        <a href="{{route('employee-vaccination.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
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
    @if($status == 'Pendaftaran dibuka')
    <div class="col-sm-12 col-lg-12 mg-b-10 d-flex justify-content-center">
        <div class="card pos-fixed z-index-10 b-40 shadow wd-90p wd-md-80p wd-lg-70p animated slideInUp">
            @if($is_registered == true)
            <div class="card-body card-alert-success d-flex justify-content-between align-items-center">
                <span class="tx-montserrat tx-medium d-flex align-items-center"><i class="fa-lg fas fa-check-circle mg-l-10 mg-r-15 tx-success"></i>Anda Sudah Mendaftar.</span>
            </div>
            @elseif($quota == 0)
            <div class="card-body card-alert-danger d-flex justify-content-between align-items-center">
                <span class="tx-montserrat tx-medium d-flex align-items-center"><i class="fa-lg fas fa-times-circle mg-l-10 mg-r-15 tx-danger"></i>Kuota penuh.</span>
            </div>
            @else
            <div class="card-body card-alert-success d-flex justify-content-between align-items-center">
                <span class="tx-montserrat tx-medium d-flex align-items-center"><i class="fa-lg fas fa-check-circle mg-l-10 mg-r-15 tx-success"></i>Kuota tersedia.</span>
                <form id="form" class="z-index-10">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{$schedule->id}}">
                    <button id="saveBtn" type="button" class="btn btn-its tx-montserrat tx-semibold">Daftar Vaksinasi</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Menyimpan...');
            $.ajax({
                data: $('#form').serialize(),
                url: "{{ route('employee-vaccination.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#saveBtn').html('Daftar Vaksinasi');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Anda berhasil mendaftar vaksinasi',
                        didClose: () => {
                            window.location.href = "{{ route('employee-vaccination.index') }}";
                        }
                    })
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Daftar Vaksinasi');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Anda gagal mendaftar vaksinasi',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        });
    });
</script>

@endsection

@endsection