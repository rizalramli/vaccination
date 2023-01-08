@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb breadcrumb-style2 mg-b-10">
                <li class="breadcrumb-item"><a href="../dashboard">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-montserrat tx-medium text-truncate">
            Laporan
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
            <div class="card-body pd-0 table-responsive">
                <table id="dataTable3" class="table table-borderless mg-0">
                    <thead>
                        <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                            <th class="wd-25p th-its" style="border-bottom: none !important"><span>Pegawai</span></th>
                            <th class="wd-20p th-its" style="border-bottom: none !important"><span>Kehadiran</span></th>
                            <th class="wd-5p th-its" style="border-bottom: none !important"><span>Vaksinasi Ke</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>Vaksinasi Pada</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>Vaksinasi Selanjutnya</span></th>
                            <th class="wd-20p th-its" style="border-bottom: none !important"><span>Vaksinator</span></th>
                            <th class="wd-10p th-its" style="border-bottom: none !important"><span>Penyelenggara</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!-- row -->

@include('vaccination.script')

@endsection