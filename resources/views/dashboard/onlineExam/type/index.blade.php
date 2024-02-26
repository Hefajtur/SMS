@extends('dashboard.master')

@section('title')
Exam Type
@endsection

<!-- Create Exam Type area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Exam Type</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('online-exam-type.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('online-exam-type.index') }}">Exam Type</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Exam Type</h3>
            <div class="button">
                <a href="{{ route('online-exam-type.create') }}" class="btn btn-primary text-capitalize"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <table id="onlineExamType_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No.</th>
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


<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#onlineExamType_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('online-exam-type.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: true
                },
                {
                    data: 'name',
                    name: 'name',
                    searchable: true
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                },
            ]
        });


        // Edit Data
        $("#onlineExamType_table").on('click', '#examType_edit', function() {

            var id = $(this).attr('examType_id');

            var url = '{{ route("online-exam-type.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#onlineExamType_table").on('click', '#examType_del', function() {

            let id = $(this).attr('examType_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("online-exam-type.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: token
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Online exam type deleted successfully');
                        var oTable = $('#onlineExamType_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

        // End DataTable

    });
</script>
<!-- End Department AJAX -->
@endsection