@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Pegawai
        </h4>
    </div>
    <div class="d-lg-none mg-t-10">
    </div>
    <div>
        <a id="createBtn" href="javascript:void(0)" data-toggle="modal" data-animation="effect-scale" class="btn btn-its tx-montserrat tx-semibold"><i data-feather="plus" class="wd-10 mg-r-5 tx-color-its2"></i> Tambah</a>
    </div>
</div>

<div class="row row-xs">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body pd-0 table-responsive">
                <table id="dataTable" class="table table-borderless mg-0" width="100%">
                    <thead>
                        <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                            <th class="wd-25p th-its" style="border-bottom: none !important"><span>Pegawai</span></th>
                            <th class="wd-5p th-its" style="border-bottom: none !important"><span>Jenis Kelamin</span></th>
                            <th class="wd-5p th-its" style="border-bottom: none !important"><span>Tgl Lahir</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>NIP/NPP</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>Golongan Darah</span></th>
                            <th class="wd-15p th-its" style="border-bottom: none !important"><span>Nomor HP</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>Status</span></th>
                            <th class="wd-20p th-its" style="border-bottom: none !important"><span class="mg-r-15">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!-- row -->

<div class="modal fade effect-scale" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="modalmyfile" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="tx-montserrat tx-medium" id="ajaxModelLabel"></h5>
            </div>
            <form id="form" name="form">
                @csrf
                <div class="modal-body pd-t-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIK</label>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="user_id" id="user_id">
                                <input type="text" id="nik" name="nik" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nama</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Kelamin</label>
                                <select id="gender" name="gender" class="form-control" required>
                                    <option value="0">Laki-laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Lahir</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control" value="1998-11-12" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">NIP/NPP</label>
                                <input type="text" id="nip" name="nip" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Golongan Darah</label>
                                <input type="text" id="blood_type" name="blood_type" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Nomor HP</label>
                                <input type="text" id="phone" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Status</label>
                                <select id="is_active" name="is_active" class="form-control" required>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batalkan</button>
                    <button type="button" class="btn btn-its tx-montserrat tx-semibold mg-l-5" id="saveBtn" value="Simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade effect-scale" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="hapusjenisvaksin" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-14 bg-white">
            <div class="modal-body">
                <h5 class="tx-montserrat tx-medium">Apakah Anda yakin ingin menghapus pegawai ini?</h5>
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

@include('employee.script')

@endsection