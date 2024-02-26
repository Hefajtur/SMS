@extends('dashboard.master')

@section('title')
    Index Gaurdian
@endsection

@section('body')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-11 mx-auto">

                <div class="row mt-5 bg-white">
                    <div class="col-12 my-3 d-flex justify-content-between">
                        <label class="" style="font-size: 30px">Gaurdian list</label>
                        <a href="{{ route('gaurdians.create') }}" class="text-white btn btn-sm btn-primary p-3"><i
                                class="fa fa-plus"></i>Add</a>
                    </div>
                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="Gaurdian_Table" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- // show gardian Data --}}

    <script type="text/javascript">
        $(function() {
            var table = $('#Gaurdian_Table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('gaurdians.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'guard_name',
                        name: 'guard_name'
                    },
                    {
                        data: 'guard_mobile',
                        name: 'guard_mobile'
                    },
                    {
                        data: 'guard_email',
                        name: 'guard_email'
                    },
                    {
                        data: 'guard_address',
                        name: 'guard_address'
                    },
                    {
                        data: 'guard_status',
                        name: 'guard_status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            //edit Gaurdian

            $('#Gaurdian_Table').on('click', '#gurd_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("gaurd-id");
                window.location.href = url + "/gaurdians/" + id + "/edit";
            });

            //// Delete Gaurdian

            $('#Gaurdian_Table').on('click', '#gurd_delete', function() {
                let id = $(this).attr("gaurd-id");

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/gaurdiandelete/" + id,
                        method: "GET",
                        data: {
                            'id': id
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#Gaurdian_Table').dataTable();
                                oTable.fnDraw(false);

                            } else {
                                alert("Invalid ID.");
                            }
                        },

                    })
                }

            });



        });
    </script>
@endsection
