@extends('dashboard.master')

@section('title')
Blood Groups
@endsection

<!-- Create Blood Groups area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Blood Groups</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('blood-groups.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Blood-Groups</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Blood Groups</h3>
            <div class="button">
                <a href="{{ route('blood-groups.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body" id="bloodGroup_data">

            <table id="bloodGroup_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
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


<!-- Blood Group AJAX -->
<script type="text/javascript">
    $(function() {

        // Blood Groups Index
        var table = $('#bloodGroup_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('blood-groups.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
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


        // Blood Groups Edit
        $("#bloodGroup_table").on('click', '#blood_edit', function() {

            var id = $(this).attr('blood_id');

            var url = '{{ route("blood-groups.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#bloodGroup_table").on('click', '#blood_del', function() {

            let id = $(this).attr('blood_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("blood-groups.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: { _token: token},
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Blood Group deleted successfully');
                        var oTable = $('#bloodGroup_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

    });
</script>
<!-- End Designation AJAX -->
@endsection