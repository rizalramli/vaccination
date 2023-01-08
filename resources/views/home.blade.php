@extends('layouts.app')

@section('content')
<div class="col-sm-12 col-lg-12 mg-b-30">
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12 mg-b-20 d-flex justify-content-center">
            <a href="#photoprofil" data-toggle="modal" data-animation="effect-scale" class="animated slideInUp">
            <div class="avatar avatar-xxl">
                <img src="{{ asset('template/img/favicon.png') }}" class="rounded-circle shadow" alt="" data-toggle="tooltip" data-placement="bottom" title="Foto profil">
            </div>
            </a>
        </div>
        <div class="col-sm-12 col-lg-12 mg-b-10 text-center">
            <h3 class="mg-b-4 tx-montserrat tx-medium animated slideInUp">
                <!-- name -->
                {{ Auth::user()->name }}
            </h3>
            <p class="mg-b-4 tx-color-03 tx-15 tx-medium animated slideInUp">
                <!-- role -->
                @role('admin')
                    Admin
                @else 
                    Pegawai
                @endif
            </p>
        </div>
    </div>
</div>
@endsection
