@extends('dashboard.master')

@section('title')
Issue Book
@endsection

<!-- Create Issue Book area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Issue Book</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('issue-book.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Issue Book</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Issue Book Filter -->
    <div class="row card py-4 px-1 rounded">
        <div class="col-12 col-md-12">
            <div class="issue-book-filter-content d-flex justify-content-between align-items-center">
                <div class="col-12 col-md-6 filter-left">
                    <h2>Filtering</h2>
                </div>
                <div class="col-12 col-md-6 filter-right">
                    <ul class="d-flex justify-content-end align-items-center">
                        <li class="mr-3">
                            <input type="text" class="issue_book_keyword inputs form-control" name="issueBook_keyword" placeholder="Enter keyword">
                        </li>
                        <li>
                            <button class="btn btn-primary float-right p-3">Search</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Issue Book Filter -->


    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Issue Book</h3>
            <div class="button">
                <a href="{{ route('issue-book.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body table-responsive" id="staff_data">
            <table id="issueBook_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Book</th>
                        <th>Member</th>
                        <th>Phone</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
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
        var table = $('#issueBook_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('issue-book.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'books.name',
                    name: 'books.name'
                },
                {
                    data: 'users.name',
                    name: 'users.name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'issue_date',
                    name: 'issue_date'
                },
                {
                    data: 'return_date',
                    name: 'return_date'
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
        $("#issueBook_table").on('click', '#issueBook_edit', function() {

            var id = $(this).attr('issueBook_id');

            var url = '{{ route("issue-book.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#issueBook_table").on('click', '#issueBook_del', function() {

            let id = $(this).attr('issueBook_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("issue-book.destroy", ":id") }}';
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
                        alert('Issue-Book deleted successfully');
                        var oTable = $('#issueBook_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

    });
</script>
<!-- End Designation AJAX -->
@endsection