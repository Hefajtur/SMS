@extends('dashboard.master')

@section('title')
Question Group
@endsection

<!-- Create Question Group area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Question Group</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('question-group.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('question-group.index') }}">Online examination</a></li>
                        <li class="breadcrumb-item">Question Groups</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Filtering -->
    <div class="qst_filtering row card">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="filter_heading">
                <h2>Filtering</h2>
            </div>

            <div class="keyword_search d-flex justify-content-center align-items-center">
                <input type="text" name="search_name" class="keyword form-control inputs mr-2" placeholder="Search name" id="searchName">
                <button class="btn btn-primary py-3 px-3" id="search_btn">Search</button>
            </div>
        </div>
    </div>
    <!-- End Filtering -->

    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Question Group</h3>
            <div class="button">
                <a href="{{ route('question-group.create') }}" class="btn btn-primary text-capitalize"><i class="fa-solid fa-plus p-2"></i>Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body table-responsive">
            <table id="qstGroup_table" class="table table-bordered table-striped">
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
        // var table = $('#qstGroup_table').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ordering: false,
        //     ajax: "{{ route('question-group.index') }}",
        //     columns: [{
        //             data: 'DT_RowIndex',
        //             name: 'DT_RowIndex',
        //             searchable: true
        //         },
        //         {
        //             data: 'name',
        //             name: 'name',
        //             searchable: true
        //         },
        //         {
        //             data: 'status',
        //             name: 'status',
        //             searchable: true
        //         },
        //         {
        //             data: 'action',
        //             name: 'action',
        //         },
        //     ]
        // });


        var table = $('#qstGroup_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('question-group.index') }}",
                data: function(d) {
                    d.search_name = $('#searchName').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
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
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).on('click', '#search_btn', function() {
            table.draw();
        });




        // Edit Data
        $("#qstGroup_table").on('click', '#qstGroup_edit', function() {

            var id = $(this).attr('qstGroup_id');

            var url = '{{ route("question-group.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#qstGroup_table").on('click', '#qstGroup_del', function() {

            let id = $(this).attr('qstGroup_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("question-group.destroy", ":id") }}';
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
                        alert('Question Group deleted successfully');
                        var oTable = $('#qstGroup_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });



    });
</script>
<!-- End Department AJAX -->
@endsection