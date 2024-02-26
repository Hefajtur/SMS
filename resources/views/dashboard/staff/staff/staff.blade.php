@extends('dashboard.master')

@section('title')
Staffs
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Staff</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('staffIndex') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staffIndex') }}">Staff</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Staff</h3>
            <div class="button">
                <a href="{{ route('createStaffForm') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body table-responsive" id="staff_data">
            <table id="staff_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Staff Id</th>
                        <th>Name</th>
                        <th>Roles</th>
                        <th>Departments</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Page Content -->


</div>


<!-- Role AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // Data Table
        var table = $('#staff_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('staffIndex') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'staffID',
                    name: 'staffID'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'roles.role',
                    name: 'roles.role'
                },
                {
                    data: 'departments.department',
                    name: 'departments.department'
                },
                {
                    data: 'designations.designation',
                    name: 'designations.designation'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });


        // Edit Data
        $("#staff_table").on('click', '#staff_edit', function() {

            var id = $(this).attr('staff_id');

            var url = '{{ route("editStaff", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#staff_table").on('click', '#staff_del', function() {

            let id = $(this).attr('staff_id');

            var url = '{{ route("deleteStaff", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                data: id,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Staff deleted successfully');
                        var oTable = $('#staff_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });
        // End Data Table



        // Edit Data
        $("#staff_tbody").on('click', '#edit_btn', function() {

            var id = $(this).attr('edit_id');

            var url = '{{ route("editStaff", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#staff_tbody").on('click', '#del_btn', function() {

            let id = $(this).attr('del_id');

            $.ajax({
                url: "{{ url('/staff/delete/') }}/" + id,
                type: "GET",
                data: id,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        // window.location.href = "{{ route('staffIndex') }}";
                        alert('Staff delete successfully');
                        var oTable = $('#religion_table').dataTable();
                        oTable.fnDraw(false);

                    }
                }
            })

        });


    });
</script>
<!-- End Designation AJAX -->
@endsection