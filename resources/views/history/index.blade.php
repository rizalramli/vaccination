@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Riwayat
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
                @if(count($vaccination) == 0)
                <h5 class="text-center">Belum ada riwayat</h5>
                @else
                @foreach($vaccination as $key => $item)
                @php 
                    $now = date('Y-m-d H:i:s');
                    $implementation_date_start = date('Y-m-d H:i:s',strtotime($item->schedule->implementation_date.' '.$item->schedule->implementation_time_start));
                    $implementation_date_end = date('Y-m-d H:i:s',strtotime($item->schedule->implementation_date.' '.$item->schedule->implementation_time_end));
                    if($now < $implementation_date_start && $item->is_vaccinated == 0){
                        $status = 'Menunggu vaksinasi';
                    } else {
                        $status = 'Selesai';
                    }
                @endphp
                <div class="card-list-item">
                    <a href="{{ route('history.show',$item->id) }}">
                        <div class="d-flex justify-content-between align-items-center sc-link">
                            <div class="media">
                                <div class="wd-40 ht-40 bg-its-icon tx-color-its mg-r-15 mg-md-r-15 d-flex align-items-center justify-content-center rounded-its"><span class="tx-medium tx-color-its tx-24">{{$loop->iteration}}</span></div>
                                <div class="media-body align-self-center">
                                    <p class="tx-montserrat tx-semibold mg-b-0 tx-color-02">{{\Helper::getDayNameIndonesian(date('D',strtotime($item->schedule->implementation_date)))}}, {{date('d M Y',strtotime($item->schedule->implementation_date))}}</p>
                                    <p class="tx-color-03 tx-13">{{date('H.i',strtotime($item->schedule->implementation_time_start))}} - {{date('H.i',strtotime($item->schedule->implementation_time_end))}}</p>
                                    @if($item->is_vaccinated == 1)
                                    <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                    @elseif($status == 'Selesai')
                                    <span class="tx-13"><span class="tx-success"><i class="far fa-check-circle mg-r-5"></i>Selesai</span></span>
                                    @else 
                                    <span class="tx-13"><span class="tx-info"><i class="far fa-arrow-alt-circle-right mg-r-5"></i>Menunggu vaksinasi</span></span>
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