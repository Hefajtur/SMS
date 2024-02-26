@extends('dashboard.master')

@section('title')
Roles
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Roles</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('staff-role.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Roles</h3>
            <div class="button">
                <a href="{{ route('staff-role.create') }}" class="btn btn-primary text-capitalize"><i class="fa-solid fa-plus"></i> Add Role</a>
            </div>
        </div>
        <hr>
        <div class="card-body">
            
            <table class="table table-bordered table-striped" id="staffRole_table">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">SR No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="role_tbody"></tbody>
            </table>


        </div>
    </div>
    <!-- End Page Content -->


</div>


<!-- AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var table = $('#staffRole_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('staff-role.index') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'permissions',
                    name: 'permissions'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Show Data form DB (Role)
        function showData() {
            $.ajax({
                url: "{{ route('staff-role.index') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {

                    let x = data.success;

                    let html = '';

                    for (i = 0; i < x.length; i++) {

                        let myArray = x[i].permission;
                        let sum = 0;
                        for (j = 0; j < myArray.length; j++) {
                            let someArray = myArray[j].permissions.split(',');
                            for (var k = 0; k < someArray.length; k++) {
                                sum += someArray[k] << 0;
                            }
                        }
                        console.log(x[i]['role']);
                        html += '<tr><td>' + [i + 1] + '</td><td>' + x[i]['role'] + '</td><td>' + sum + '</td><td>' + x[i].status + '</td><td><button class="btn btn-primary" id="edit_btn" edit_id=' + x[i].id + '><i class="fa-solid fa-pen-to-square"></i></button> <button class="btn btn-danger" id="del_btn"  del_id=' + x[i].id + '><i class="fa-solid fa-trash"></i></button> </td></tr>';

                    }
                    $('#role_tbody').html(html);

                    // Action Dropdown Button
                    $('.action_td').on('click', function() {
                        $('.action_button').toggle();
                    })


                }
            })
        }

        showData();




        // Edit Role
        $("#role_tbody").on('click', '#edit_btn', function() {

            var id = $(this).attr('edit_id');

            var url = '{{ route("staff-role.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })


        // Delete Role
        $("#role_tbody").on('click', '#del_btn', function() {

            let id = $(this).attr('del_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("staff-role.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    id: id,
                    _token: token
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Question Bank deleted successfully');
                        var oTable = $('#staffRole_table').dataTable();
                        oTable.fnDraw(false);

                    }
                }
            })

        });


    });
</script>
<!-- End AJAX -->
@endsection