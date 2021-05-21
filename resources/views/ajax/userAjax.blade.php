<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('user.index') }}",
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false
                },
                {
                    data: 'firstName',
                    name: 'firstName'
                },
                {
                    data: 'lastName',
                    name: 'lastName'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                }
            ]
        });

        // increment function
        table.on('draw.dt', function() {
            var info = table.page.info();
            table.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });

        // Create function
        $('#createNewUser').click(function() {
            $('#saveBtn').val("create-user");
            $('#user_id').val('');
            $('#userFormCreate').trigger("reset");
            $('#modelHeading').html("Create New User");
            $('#ajaxModalCreate').modal('show');

        });

        // Create Save Function
        $('#saveBtnCreate').click(function(e) {
            $("#userFormCreate").validate({

                submitHandler: function(form) {
                    $.ajax({
                        data: $('#userFormCreate').serialize(),
                        url: "{{ route('user.store') }}",
                        type: "POST",
                        dataType: 'JSON',
                        success: function(data) {

                            $('#userFormCreate').trigger("reset");
                            $('#ajaxModalCreate').modal('hide');
                            console.log('Success:', data);
                            table.ajax.reload();
                            // $('.data-table').DataTable().ajax.reload();

                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtnCreate').html('Save Changes');
                        }
                    });
                }
            });
        });

        // Edit function
        $('body').on('click', '.editUser', function() {
            var user_id = $(this).data('id');
            var editData = '{{ route('user.edit', ':id') }}';
            editUrl = editData.replace(':id', user_id);
            $.get(editUrl, function(data) {
                console.log(data);
                $('.modelHeading').html("Edit User");
                $('.saveBtnEdit').val("edit-user");
                $('.ajaxModalEdit').modal('show');
                $('.user_id').val(data.id);
                $('.firstName').val(data.firstName);
                $('.lastName').val(data.lastName);

            })
        });

        // Edit Save Function
        $('.saveBtnEdit').click(function(e) {
            var user_id = $('.user_id').val();
            var updateData = '{{ route('user.update', ':id') }}';
            updateUrl = updateData.replace(':id', user_id);

            $(".userFormEdit").validate({
                submitHandler: function(form) {
                    $.ajax({
                        data: $('.userFormEdit').serialize(),
                        url: updateUrl,
                        type: "PUT",
                        dataType: 'JSON',
                        success: function(data) {
                            $(this).data(data.id);
                            $('.userFormEdit').trigger("reset");
                            $('.ajaxModalEdit').modal('hide');
                            console.log('Success:', data);
                            table.ajax.reload();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('.saveBtnEdit').html('Save Changes');
                        }
                    });
                }
            });
        });

        // Delete function
        $('body').on('click', '.deleteUser', function() {
            var user_id = $(this).data('id');
            var deleteData = '{{ route('user.destroy', ':id') }}';
            deleteUrl = deleteData.replace(':id', user_id);
            console.log(user_id);

            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "DELETE",
                    url: deleteUrl,
                    error: function() {
                        console.log('Error:', data);
                    },
                    success: function(data) {
                        console.log('Success:', data);
                        table.ajax.reload();

                    }

                });
            }
        });
    });

</script>
