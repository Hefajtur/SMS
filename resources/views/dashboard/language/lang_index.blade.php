@extends('dashboard.master')

@section('title')
Languages
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Languages</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('lang.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Languages</li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Languages</h3>
            <div class="button">
                <a href="{{ route('LangForm') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body" id="lang_data">
            <table id="lang_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Icon</th>
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


<!-- Role AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#lang_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('lang.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'flag_icon',
                    name: 'flag_icon'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });


        // Edit Data
        $("#lang_table").on('click', '#lang_edit', function() {

            var id = $(this).attr('lang_id');

            var url = '{{ route("editLangForm", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#lang_table").on('click', '#lang_del', function() {

            let id = $(this).attr('lang_id');

            var url = '{{ route("deleteLang", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "GET",
                data: id,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                       
                        alert('Language deleted successfully');
                        var oTable = $('#lang_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

        // End DataTable




        // Edit Data
        $("#lang_tbody").on('click', '#edit_btn', function() {

            var id = $(this).attr('edit_id');

            var url = '{{ route("editLangForm", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#lang_tbody").on('click', '#del_btn', function() {

            let id = $(this).attr('del_id');

            $.ajax({
                url: "{{ url('/language/delete') }}/" + id,
                type: "GET",
                data: id,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        window.location.href = "{{ route('lang.index') }}";
                        alert('Language delete successfully');

                    }
                }
            })

        });


    });
</script>
<!-- End Designation AJAX -->
@endsection