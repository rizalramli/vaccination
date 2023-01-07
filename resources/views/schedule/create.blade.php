@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('schedule.index')}}">Vaksinasi Tersedia</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                @if(isset($schedule))
                    Edit Vaksinasi
                @else
                    Tambah Vaksinasi
                @endif
                </li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            @if(isset($schedule))
                Edit Vaksinasi
            @else
                Tambah Vaksinasi
            @endif
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        @if(isset($schedule))
            <a href="{{route('schedule.show',$schedule->id)}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
        @else
            <a href="{{route('schedule.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
        @endif
    </div>
</div>

<div class="row row-xs">
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card">
            <div class="card-body">
                <form id="form">
                    @csrf
                    @include('schedule.field')
                </form>
            </div>
        </div>
    </div>

</div><!-- row -->

@include('schedule.script')

@endsection