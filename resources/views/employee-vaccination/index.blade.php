@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jadwal Vaksinasi</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Jadwal Vaksinasi
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
    </div>
</div>

<div class="row row-xs">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body card-list">

                @if(count($schedule) == 0)
                <h5 class="text-center">Belum ada jadwal</h5>
                @else
                @foreach($schedule as $item)
                @php 
                    $registration_date_start = date('Y-m-d',strtotime($item->registration_date_start));
                    $registration_date_end = date('Y-m-d',strtotime($item->registration_date_end));
                    $now = date('Y-m-d');
                    $status = 'Pendaftaran dibuka';
                    if($now < $registration_date_start){
                        $status = 'Pendaftaran belum dibuka';
                    }else if($now > $registration_date_end){
                        $status = 'Pendaftaran ditutup';
                    }
                @endphp
                <div class="card-list-item">
                    <a href="{{route('employee-vaccination.show',$item->id)}}">
                        <div class="d-flex justify-content-between align-items-center sc-link">
                            <div class="media">
                                <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><i data-feather="calendar"></i></div>
                                <div class="media-body align-self-center">
                                    <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">{{\Helper::getDayNameIndonesian(date('D',strtotime($item->implementation_date)))}}, {{date('d M Y',strtotime($item->implementation_date))}}</p>
                                    <p class="tx-color-03 tx-13">{{date('H.i',strtotime($item->implementation_time_start))}} - {{date('H.i',strtotime($item->implementation_time_end))}}</p>
                                    @if($status == 'Pendaftaran dibuka')
                                    <span class="tx-13"><span class="tx-info"><i class="far fa-play-circle mg-r-5"></i>{{$status}}</span></span>
                                    @elseif($status == 'Pendaftaran belum dibuka')
                                    <span class="tx-13"><span class="tx-gray-700"><i class="far fa-circle mg-r-5"></i>{{$status}}</span></span>
                                    @else
                                    <span class="tx-13"><span class="tx-danger"><i class="far fa-times-circle mg-r-5"></i>{{$status}}</span></span>
                                    @endif
                                </div>
                            </div>
                            <div class="btn btn-icon btn-its-icon btn-hover">
                                <i data-feather="chevron-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div><!-- row -->
@endsection