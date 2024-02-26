@extends('dashboard.master')

@section('title')
Designation
@endsection

<!-- Create Designation area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Designation</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('designations.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('designations.index') }}">Designation</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Designation</h3>
            <div class="button">
                <a href="{{ route('designations.create') }}" class="btn btn-primary text-capitalize"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <table id="desig_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>


        </div>
    </div>
    <!-- End Page Content -->


</div>


<!-- Designation AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

 // DataTable
 var table = $('#desig_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('designations.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'designation',
                    name: 'designation'
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
        $("#desig_table").on('click', '#desig_edit', function() {

            var id = $(this).attr('desig_id');

            var url = '{{ route("designations.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#desig_table").on('click', '#desig_del', function() {

            let id = $(this).attr('desig_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("designations.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: { _token: token},
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Designation deleted successfully');
                        var oTable = $('#desig_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

        // End DataTable

    });
</script>
<!-- End Designation AJAX -->
@endsection