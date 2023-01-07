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

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Mengirim..');

            $.ajax({
                data: $('#form').serialize(),
                url: "{{ route('schedule.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#form').trigger("reset");
                    swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan',
                        icon: 'success',
                        didClose: () => {
                            window.location.href = "{{ route('schedule.index') }}";
                        }
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
            
        $('#deleteBtn').click(function() {
            var id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: "{{ route('schedule.destroy', ':id') }}".replace(':id', id),
                data : {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#modalDelete').modal('hide');
                    swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus',
                        icon: 'success',
                        didClose: () => {
                            window.location.href = "{{ route('schedule.index') }}";
                        }
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection