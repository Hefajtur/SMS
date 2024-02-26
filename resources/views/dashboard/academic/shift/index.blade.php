@extends('dashboard.master')

@section('title')
    Index shift
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Shift</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">shift</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Shift</label>
                        <a href="{{ route('shift.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>
                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="shiftData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Name</th>
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

    {{-- // show Shift Data --}}

    <script type="text/javascript">
        $(function() {
            var table = $('#shiftData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('shift.index') }}",
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
        });
    </script>

    <script>
        $(document).ready(function() {

            //edit Shift

            $('#shiftData').on('click', '#shift_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("shift_id");
                window.location.href = url + "/shift/" + id + "/edit";
            });

            //// Delete Shift

            $('#shiftData').on('click', '#shift_delete', function() {
                let id = $(this).attr("shift_id");
                let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/shift/" + id,
                        method: "DELETE",
                        data: {
                            _token: token
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#shiftData').dataTable();
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
