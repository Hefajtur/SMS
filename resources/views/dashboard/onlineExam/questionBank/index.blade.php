@extends('dashboard.master')

@section('title')
Question Bank
@endsection

<!-- Create Question Bank area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Question Bank</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Online examination</a></li>
                        <li class="breadcrumb-item">Question Bank</li>
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
                <input type="text" name="search_keyword" class="keyword form-control inputs mr-2" placeholder="Search question type" id="searchQuestion">
                <button class="btn btn-primary py-3 px-3" id="search_btn">Search</button>
            </div>
        </div>
    </div>
    <!-- End Filtering -->


    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Question Bank</h3>
            <div class="button">
                <a href="{{ route('question-bank.create') }}" class="btn btn-primary text-capitalize"><i class="fa-solid fa-plus p-2"></i>Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body table-responsive">
            <table id="qstBank_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SR No.</th>
                        <th>Question Group</th>
                        <th>Question Type</th>
                        <th>Question</th>
                        <th>Mark</th>
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


<!-- Question Bank AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#qstBank_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('question-bank.index') }}",
                data: function(d) {
                    d.search_keyword = $('#searchQuestion').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'question_group.name',
                    name: 'question_group.name'
                },
                {
                    data: 'question_type',
                    name: 'question_type'
                },
                {
                    data: 'question',
                    name: 'question'
                },
                {
                    data: 'mark',
                    name: 'mark'
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
        // End DataTable


        // Edit Data
        $("#qstBank_table").on('click', '#qstBank_edit', function() {

            var id = $(this).attr('qstBank_id');

            var url = '{{ route("question-bank.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#qstBank_table").on('click', '#qstBank_del', function() {

            let id = $(this).attr('qstBank_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("question-bank.destroy", ":id") }}';
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
                        alert('Question Bank deleted successfully');
                        var oTable = $('#qstBank_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

        

    });
</script>
<!-- End Question Bank AJAX -->
@endsection