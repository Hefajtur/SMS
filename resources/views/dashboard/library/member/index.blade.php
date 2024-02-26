@extends('dashboard.master')

@section('title')
Member
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Member</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Member</a></li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Page Content -->
    <div class="row card shadow py-4 mb-5">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Member</h3>
            <div class="button">
                <a href="{{ route('member.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>
        <hr>
        <div class="card-body table-responsive" id="staff_data">
            <table id="member_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>SR No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Gender</th>
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
        var table = $('#member_table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ route('member.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'member_cat_name',
                    name: 'member_cat_name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'member_gender.name',
                    name: 'member_gender.name'
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
        $("#member_table").on('click', '#member_edit', function() {

            var id = $(this).attr('member_id');

            var url = '{{ route("member.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;


        })



        // Delete Staff
        $("#member_table").on('click', '#member_del', function() {

            let id = $(this).attr('member_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("member.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: { _token: token},
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Member deleted successfully');
                        var oTable = $('#member_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });

    });
</script>
<!-- End Designation AJAX -->
@endsection