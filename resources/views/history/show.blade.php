@extends('layouts.app')

@section('content')

@php 
$now = date('Y-m-d H:i:s');
$implementation_date_start = date('Y-m-d H:i:s',strtotime($vaccination->schedule->implementation_date.' '.$vaccination->schedule->implementation_time_start));
$implementation_date_end = date('Y-m-d H:i:s',strtotime($vaccination->schedule->implementation_date.' '.$vaccination->schedule->implementation_time_end));

if($now < $implementation_date_start && $vaccination->is_vaccinated == 0){
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
                <li class="breadcrumb-item"><a href="{{route('history.index')}}">Riwayat</a></li>
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
        <a href="{{route('history.index')}}" class="btn btn-white tx-montserrat tx-semibold"><i data-feather="arrow-left" class="wd-10 mg-r-5"></i> Kembali</a>
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
    @if($vaccination->is_vaccinated == 1 || $status == 'Selesai')
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
                        <a id="createBtn" href="javascript:void(0)" data-toggle="modal" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold float-right d-none d-lg-block"><i data-feather="plus" class="wd-10 mg-r-5"></i> Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body pd-0">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-borderless table-hover" width="100%">
                        <thead>
                            <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                <th class="wd-15p th-its">Tanggal Kejadian</th>
                                <th class="wd-40p th-its">Gejala</th>
                                <th class="wd-25p th-its">Tindakan</th>
                                <th class="wd-15p th-its">Hubungi Dokter</th>
                                <th class="wd-5p th-its tx-color-03"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

</div><!-- row -->

<!-- Modal -->

<div class="modal fade effect-scale" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="modalmyfile" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="tx-montserrat tx-medium" id="ajaxModelLabel">Tambah KIPI</h5>
          </div>
          <form id="form" name="form">
            @csrf
            <div class="modal-body pd-t-0">
              <div class="form-group">
                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold" for="tgl">Tanggal kejadian</label> 
                <input type="hidden" name="vaccination_id" value="{{$vaccination->id}}">
                <input type="date" id="tgl" name="incident_date" class="form-control " placeholder="" value="" required>
              </div>
              <div class="form-group">
                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold" for="tgl">Gejala</label> 
                <textarea name="indication" class="form-control" rows="2" placeholder="" required></textarea>
              </div>
              <div class="form-group">
                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold" for="tgl">Tindakan</label> 
                <textarea name="action" class="form-control" rows="2" placeholder="" required></textarea>
              </div>
              <div class="form-group">
                <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold" for="tgl">Sudah menghubungi dokter?</label> 
                <div class="row">
                  <div class="col-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="vaksin_sudah" value="1" name="is_contact_doctor" class="custom-control-input" required>
                      <label class="custom-control-label" for="vaksin_sudah">Sudah</label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="vaksin_belum" value="0" name="is_contact_doctor" class="custom-control-input">
                      <label class="custom-control-label" for="vaksin_belum">Belum</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batalkan</button>
              <button id="saveBtn" type="button" class="btn btn-its tx-montserrat tx-semibold">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade effect-scale" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="hapuskipi" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-14 bg-white">
          <div class="modal-body">
            <h5 class="tx-montserrat tx-medium">Hapus KIPI?</h5>
            <span>Tindakan ini tidak dapat dibatalkan.</span>
          </div>
          <div class="modal-footer bd-t-0">
            <a href="#" data-toggle="modal" data-animation="effect-scale" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batal</a>
            <button id="deleteBtn" type="button" class="btn btn-its tx-montserrat tx-semibold">Hapus</button>
          </div>
        </div>
      </div>
    </div>

@include('history.script')

@endsection