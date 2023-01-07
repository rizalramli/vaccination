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
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('vaccination.loadEmployee') }}",
            columns: [{
                    data: 'nip',
                    name: 'nip',
                    className: 'td-its align-middle border-bottom'
                },{
                    data: 'name',
                    name: 'name',
                    className: 'td-its align-middle border-bottom'
                }
            ],
        });

        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

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

    });
</script>
@endsection