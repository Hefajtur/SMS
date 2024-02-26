@extends('dashboard.master')

@section('title')
Sessions
@endsection

<!-- Create Gender area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Sessions</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('school-sessions.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sessions</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Sessions</h3>
            <div class="button">
                <a href="{{ route('school-sessions.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body" id="session_data">
             <table id="session_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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


<!-- Gender AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        var table = $('#session_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('school-sessions.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
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
        $("#session_table").on('click', '#session_edit', function() {

            var id = $(this).attr('session_id');

            var url = '{{ route("school-sessions.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#session_table").on('click', '#session_del', function() {

            let id = $(this).attr('session_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("school-sessions.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: { _token: token},
                data: id,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Session deleted successfully');
                        var oTable = $('#session_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

    });
</script>
<!-- End Designation AJAX -->
@endsection