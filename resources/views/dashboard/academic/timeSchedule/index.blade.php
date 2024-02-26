@extends('dashboard.master')

@section('title')
    Index TimeSchedule
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Time Schedule</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">Time Schedule</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Time Schedule</label>
                        <a href="{{ route('timeSchedule.create') }}" class="btn btn-primary p-3 text-white"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>
                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="timeScheduleData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Time</th>
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

    {{-- // show timeSchedule Data --}}

    <script type="text/javascript">
        $(function() {
            var table = $('#timeScheduleData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('timeSchedule.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'start_time',
                        name: 'start_time'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
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

            //edit timeSchedule

            $('#timeScheduleData').on('click', '#timeSchedule_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("timeSchedule_id");
                window.location.href = url + "/timeSchedule/" + id + "/edit";
            });

            //// Delete timeSchedule

            $('#timeScheduleData').on('click', '#timeSchedule_delete', function() {
                let id = $(this).attr("timeSchedule_id");
                let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/timeSchedule/" + id,
                        method: "DELETE",
                        data: {
                            _token: token
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#timeScheduleData').dataTable();
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
