@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(function() {
        'use strict'

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if(isset($schedule_id))
        let table = $('#dataTable').DataTable({
            language: {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_ data/halaman',
                emptyTable:         'Tidak ada data yang tersedia pada tabel ini',
                zeroRecords:        'Tidak ditemukan data yang sesuai',
                info:               'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                infoEmpty:          'Menampilkan 0 sampai 0 dari 0 entri',
                infoFiltered:       '(disaring dari _MAX_ entri keseluruhan)',
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>"
                },
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('vaccination.edit',$schedule_id) }}",
            columns: [{
                    data: 'employee.nip',
                    name: 'employee.nip',
                    className: 'td-its align-middle border-bottom'
                },{
                    data: 'employee.name',
                    name: 'employee.name',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'td-its align-middle border-bottom',
                    orderable: false,
                    searchable: false
                },
            ],
            drawCallback: function() {
                feather.replace()
            }
        });

        $('body').on('click', '.delete', function() {

            var id = $(this).data("id");
            $('#modalDelete').modal('show');

            $('#deleteBtn').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('vaccination.destroy', ':id') }}".replace(':id', id),
                    data : {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#modalDelete').modal('hide');
                        table.draw();
                        swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });

        $(document).on('click', '#addParticipant', function() {
            var data = $('.employee_id:checked').map((_, el) => el.value).get();
            if(data.length == 0){
                swal.fire({
                    title: 'Gagal!',
                    text: 'Tidak ada data yang dipilih',
                    icon: 'error',
                });
            }else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('vaccination.store') }}",
                    data : {
                        '_token': '{{ csrf_token() }}',
                        'employee_id': data,
                        'schedule_id': {{ $schedule_id }}
                    },
                    success: function(data) {
                        $('#modalParticipant').modal('hide');
                        $('.employee_id').prop('checked', false);
                        table.draw();
                        swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil ditambahkan',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        $('#modalParticipant').modal('hide');
                        $('.employee_id').prop('checked', false);
                        table.draw();
                        swal.fire({
                            title: 'Gagal!',
                            text: 'Kuota sudah penuh',
                            icon: 'error',
                        });
                    }
                });
            }
        });
        @endif

        let table2 = $('#dataTable2').DataTable({
            language: {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_ data/halaman',
                emptyTable:         'Tidak ada data yang tersedia pada tabel ini',
                zeroRecords:        'Tidak ditemukan data yang sesuai',
                info:               'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                infoEmpty:          'Menampilkan 0 sampai 0 dari 0 entri',
                infoFiltered:       '(disaring dari _MAX_ entri keseluruhan)',
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>"
                },
            }
        });

        let table3 = $('#dataTable3').DataTable({
            language: {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_ data/halaman',
                emptyTable:         'Tidak ada data yang tersedia pada tabel ini',
                zeroRecords:        'Tidak ditemukan data yang sesuai',
                info:               'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                infoEmpty:          'Menampilkan 0 sampai 0 dari 0 entri',
                infoFiltered:       '(disaring dari _MAX_ entri keseluruhan)',
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>"
                },
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('vaccination.index') }}",
                data: function (d) {
                    d.employee_id = $('#employee_id').val()
                }
            },
            columns: [{
                    data: 'action',
                    name: 'action',
                    className: 'td-its align-middle border-bottom',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'employee_id',
                    name: 'employee_id',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'is_vaccinated',
                    name: 'is_vaccinated',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'vaccination_number',
                    name: 'vaccination_number',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'schedule_id',
                    name: 'schedule_id',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'next_vaccination_date',
                    name: 'next_vaccination_date',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'schedule.vaccinator.name',
                    name: 'schedule.vaccinator.name',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'schedule.organizer',
                    name: 'schedule.organizer',
                    className: 'td-its align-middle border-bottom'
                }
            ],
            drawCallback: function() {
                feather.replace()
            }
        });

        $(document).on('click', '.btnPresenceTrue', function() {
            var id = $(this).data("id");
            Swal.fire({
                title: 'Pilih tanggal vaksinasi selanjutnya',
                html: `<label>Tanggal</label><input type="date" id="date" class="form-control" placeholder="tanggal vaksinasi selanjutnya">`,
                confirmButtonText: 'Simpan',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                focusConfirm: false,
                preConfirm: () => {
                    const date = Swal.getPopup().querySelector('#date').value
                    if (!date) {
                        Swal.showValidationMessage(`Silahkan isi tanggal`)
                    }
                    return { date: date}
                }
            }).then((result) => {
                $.ajax({
                    type: "POST",
                    url: "{{ route('vaccination.presence') }}",
                    data : {
                        '_token': '{{ csrf_token() }}',
                        'id': id,
                        'is_vaccinated': 1,
                        'next_vaccination_date': result.value.date
                    },
                    success: function(data) {
                        table3.draw();
                        swal.fire({
                            title: 'Berhasil!',
                            text: 'Status kehadiran berhasil diubah',
                            icon: 'success',
                        });
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            })
        });

        $(document).on('click', '.btnPresenceFalse', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: "{{ route('vaccination.presence') }}",
                data : {
                    '_token': '{{ csrf_token() }}',
                    'id': id,
                    'is_vaccinated': 0
                },
                success: function(data) {
                    table3.draw();
                    swal.fire({
                        title: 'Berhasil!',
                        text: 'Status kehadiran berhasil diubah',
                        icon: 'success',
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });

        $('#employee_id').change(function(){
            table3.draw();
        });

        // Detail KIPI
        @if(isset($vaccination_id))
        let table4 = $('#dataTable4').DataTable({
            language: {
                searchPlaceholder: 'Cari',
                sSearch: '',
                lengthMenu: '_MENU_ data/halaman',
                emptyTable:         'Tidak ada data yang tersedia pada tabel ini',
                zeroRecords:        'Tidak ditemukan data yang sesuai',
                info:               'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                infoEmpty:          'Menampilkan 0 sampai 0 dari 0 entri',
                infoFiltered:       '(disaring dari _MAX_ entri keseluruhan)',
                paginate: {
                    first: "<i class='fas fa-angle-double-left'></i>",
                    last: "<i class='fas fa-angle-double-right'></i>",
                    previous: "<i class='fas fa-angle-left'></i>",
                    next: "<i class='fas fa-angle-right'></i>"
                },
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('vaccination.show',$vaccination_id) }}",
            columns: [{
                    data: 'incident_date',
                    name: 'incident_date',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'indication',
                    name: 'indication',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'is_contact_doctor',
                    name: 'is_contact_doctor',
                    className: 'td-its align-middle border-bottom'
                }
            ],
            drawCallback: function() {
                feather.replace()
            }
        });
        @endif

        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });
</script>
@endsection