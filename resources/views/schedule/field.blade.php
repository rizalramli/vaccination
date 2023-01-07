<p class="tx-medium tx-15">Tentang Vaksinasi Ini</p>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Penyelenggara</label>
    <input type="hidden" name="id" value="{{isset($schedule) ? $schedule->id : ''}}">
    <input type="text" name="organizer" class="form-control" placeholder="Nama penyelenggara" maxlength="100" value="{{isset($schedule) ? $schedule->organizer : ''}}">
</div>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Vaksinator</label>
    <select name="vaccinator_id" class="form-control select2" required>
        <option label="Pilih"></option>
        @foreach ($vaccinator as $id => $name)
            @if (isset($schedule) && $id == $schedule->vaccinator_id)
            <option value="{{ $id }} " selected>{{ $name }}</option>
            @else
            <option value="{{ $id }} ">{{ $name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Jenis Vaksin</label>
    <select name="vaccine_type_id" class="form-control select2" required>
        @foreach ($vaccineType as $id => $name)                                     
            @if (isset($schedule) && $id == $schedule->vaccine_type_id)
            <option value="{{ $id }} " selected>{{ $name }}</option>
            @else
            <option value="{{ $id }} ">{{ $name }}</option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-6">
            <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendaftaran dimulai</label>
            <input type="date" name="registration_date_start" class="form-control" value="{{isset($schedule) ? $schedule->registration_date_start : ''}}">
        </div>
        <div class="col-6">
            <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Pendaftaran selesai</label>
            <input type="date" name="registration_date_end" class="form-control" value="{{isset($schedule) ? $schedule->registration_date_end : ''}}">
        </div>
    </div>
</div>
<hr class="mg-t-20 mg-b-20">
<p class="tx-medium tx-15">Pelaksanaan</p>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Tanggal Vaksinasi</label>
    <input type="date" name="implementation_date" class="form-control" value="{{isset($schedule) ? $schedule->implementation_date : ''}}">
</div>
<div class="form-group">
    <div class="row">
        <div class="col-6">
            <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Sesi Vaksinasi Dimulai</label>
            <input type="time" name="implementation_time_start" class="form-control" value="{{isset($schedule) ? date('H:i',strtotime($schedule->implementation_time_start)) : ''}}">
        </div>
        <div class="col-6">
            <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Sesi Vaksinasi Selesai</label>
            <input type="time" name="implementation_time_end" class="form-control" value="{{isset($schedule) ? date('H:i',strtotime($schedule->implementation_time_end)) : ''}}">
        </div>
    </div>
</div>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Lokasi</label>
    <input type="text" name="location" class="form-control" placeholder="Tempat vaksinasi" maxlength="100" value="{{isset($schedule) ? $schedule->location : ''}}">
</div>
<div class="form-group">
    <label class="d-block tx-10 tx-spacing-1 tx-color-03 tx-uppercase tx-semibold">Kuota</label>
    <input type="number" name="quota" class="form-control" placeholder="Jumlah peserta" value="{{isset($schedule) ? $schedule->quota : ''}}">
</div>

<button class="btn btn-its tx-montserrat tx-semibold float-right" type="button" id="saveBtn">@if(isset($schedule)) Update @else Simpan @endif</button>