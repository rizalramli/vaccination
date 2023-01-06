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

        let table= $('#dataTable').DataTable({
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
            ajax: "{{ route('employee.index') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'gender',
                    name: 'gender',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'birth_date',
                    name: 'birth_date',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'nip',
                    name: 'nip',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'blood_type',
                    name: 'blood_type',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    className: 'td-its align-middle border-bottom'
                },
                {
                    data: 'is_active',
                    name: 'is_active',
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

        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        $('#createBtn').click(function() {
            $('#saveBtn').html("Simpan");
            $('#id').val('');
            $('#user_id').val('');
            $('#form').trigger("reset");
            $('#ajaxModelLabel').html("Tambah Pegawai");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            $.get("{{ route('employee.index') }}" + '/' + id + '/edit', function(data) {
                $('#saveBtn').html("Update");
                $('#ajaxModelLabel').html("Edit Pegawai");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#user_id').val(data.user_id);
                $('#nik').val(data.nik);
                $('#name').val(data.name);
                $('#gender').val(data.gender);
                $('#birth_date').val(data.birth_date);
                $('#nip').val(data.nip);
                $('#blood_type').val(data.blood_type);
                $('#phone').val(data.phone);
                $('#is_active').val(data.is_active);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Mengirim..');

            $.ajax({
                data: $('#form').serialize(),
                url: "{{ route('employee.store') }}",
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
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Simpan');
                }
            });
        });

        $('body').on('click', '.delete', function() {

            var id = $(this).data("id");
            $('#modalDelete').modal('show');

            $('#deleteBtn').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('employee.destroy', ':id') }}".replace(':id', id),
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

    });
</script>
@endsection