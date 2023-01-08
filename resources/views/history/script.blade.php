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

        // Detail KIPI
        @if(isset($vaccination_id))
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
            ajax: "{{ route('history.show',$vaccination_id) }}",
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
                },
                {
                    data: 'actionn',
                    name: 'actionn',
                    className: 'td-its align-middle border-bottom',
                    orderable: false,
                    searchable: false
                }
            ],
            drawCallback: function() {
                feather.replace()
            }
        });

        $('#createBtn').click(function() {
            $('#saveBtn').html("Simpan");
            $('#form').trigger("reset");
            $('#ajaxModel').modal('show');
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Mengirim..');

            $.ajax({
                data: $('#form').serialize(),
                url: "{{ route('kipi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#form').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                    swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan',
                        icon: 'success',
                    });
                },
                error: function(request, msg, error) {
                    $('#saveBtn').html('Simpan');
                    var data = request.responseJSON;
                    $.each(data.errors, function(key, value) {
                        swal.fire({
                            title: 'Gagal!',
                            text: value,
                            icon: 'error',
                        });
                    });
                }
            });
        });

        $('body').on('click', '.delete', function() {

            var id = $(this).data("id");
            $('#modalDelete').modal('show');

            $('#deleteBtn').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('kipi.destroy', ':id') }}".replace(':id', id),
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
        @endif

        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });
</script>
@endsection