@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{route('schedule.index')}}">Vaksinasi Tersedia</a></li>
                <li class="breadcrumb-item"><a href="{{route('schedule.show',$schedule_id)}}">Detail Vaksinasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Peserta Vaksinasi</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Edit Peserta Vaksinasi
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        <a href="{{route('schedule.show',$schedule_id)}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
    </div>
</div>

<div class="row row-xs">
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="card">
            <div class="card-body">
                <h5 class="tx-montserrat tx-medium">Calon Peserta</h5>
                <p class="tx-color-03 tx-13">Pilih siapa saja yang dapat mengikuti vaksinasi ini.</p>
                <button type="button" class="btn btn-its tx-montserrat tx-semibold" data-toggle="modal" data-target="#modalParticipant" data-animation="effect-scale"><i data-feather="plus" class="wd-10 mg-r-5 tx-color-its2"></i> Tambah Daftar Peserta</button>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-12 mg-b-10">
        <div class="row row-sm">
            <div class="col-sm-12 col-lg-12 mg-b-10 mg-sm-b-10 mg-lg-b-10">
                <div class="card">
                    <div class="card-body pd-b-5">
                        <h5 class="tx-montserrat tx-medium">Daftar Peserta Vaksinasi</h5>
                    </div>
                    <div class="card-body pd-0 table-responsive">
                        <table id="dataTable" class="table table-borderless mg-0" width="100%">
                            <thead>
                                <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                    <th class="wd-30p th-its" style="border-bottom: none !important"><span class="mg-r-15">NIP/NPP</span></th>
                                    <th class="wd-50p th-its" style="border-bottom: none !important"><span class="mg-r-15">Nama</span></th>
                                    <th class="wd-20p th-its" style="border-bottom: none !important"><span class="mg-r-15">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- row -->

<div class="modal fade effect-scale" id="modalParticipant" tabindex="-1" role="dialog" aria-labelledby="modalmyfile" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="tx-montserrat tx-medium" id="modalParticipantLabel">Tambah Daftar Peserta Vaksinasi</h5>
            </div>
            <div class="modal-body pd-0 table-responsive">
                <table id="dataTable2" class="table table-borderless mg-0">
                    <thead>
                        <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                            <th class="wd-30p th-its" style="border-bottom: none !important"><span class="mg-r-15">NIP/NPP</span></th>
                            <th class="wd-70p th-its" style="border-bottom: none !important"><span class="mg-r-15">Nama</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employee as $item)
                    <tr>
                        <td class="td-its tx-medium align-middle border-bottom">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input employee_id" id="user1" name="employee_id[]" value="{{$item->id}}">
                            <label class="custom-control-label" for="user1">{{$item->nik}}</label>
                        </div>
                        </td>
                        <td class="td-its tx-medium align-middle border-bottom">{{$item->name}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batalkan</button>
                <button type="button" class="btn btn-its tx-montserrat tx-semibold mg-l-5" id="addParticipant">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade effect-scale" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="hapusjenisvaksin" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14 bg-white">
            <div class="modal-body">
                <h5 class="tx-montserrat tx-medium">Hapus Peserta Vaksinasi?</h5>
                <span>Tindakan ini tidak dapat dibatalkan.</span>
            </div>
            <div class="modal-footer bd-t-0">
                <form>
                    <a href="#" data-toggle="modal" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batalkan</a>
                    <button id="deleteBtn" type="button" class="btn btn-its tx-montserrat tx-semibold mg-l-5">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('vaccination.script')

@endsection