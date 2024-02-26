@extends('dashboard.master')

@section('title')
Religions
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Religions</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('religions.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Religions</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Religions</h3>
            <div class="button">
                <a href="{{ route('religions.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body" id="staff_data">
            <table id="religion_table" class="table table-bordered">
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


<!-- Role AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        var table = $('#religion_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('religions.index') }}",
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


        // Edit Data
        $("#religion_table").on('click', '#religion_edit', function() {

            var id = $(this).attr('religion_id');

            var url = '{{ route("religions.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#religion_table").on('click', '#religion_del', function() {

            let id = $(this).attr('religion_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("religions.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: { _token: token},
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Religion deleted successfully');
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