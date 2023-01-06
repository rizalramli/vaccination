@extends('layouts.app')

@section('content')
<div class="col-sm-12 col-lg-12 mg-b-30">
    <div class="row row-xs">
        <div class="col-sm-12 col-lg-12 mg-b-20 d-flex justify-content-center">
            <a href="#photoprofil" data-toggle="modal" data-animation="effect-scale" class="animated slideInUp">
            <div class="avatar avatar-xxl">
                <img src="https://i-invdn-com.akamaized.net/content/pic583d7c53b21af8b691aac70a6994c4c9.jpg" class="rounded-circle shadow" alt="" data-toggle="tooltip" data-placement="bottom" title="Foto profil">
            </div>
            </a>
        </div>
        <div class="col-sm-12 col-lg-12 mg-b-10 text-center">
            <h3 class="mg-b-4 tx-montserrat tx-medium animated slideInUp">Gunawan</h3>
            <p class="mg-b-4 tx-color-03 tx-15 tx-medium animated slideInUp">Admin</p>
        </div>
    </div>
</div>
@endsection
