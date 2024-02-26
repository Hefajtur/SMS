@extends('dashboard.master')

@section('title')
    Index Subject
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Subject</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">Subject</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Subject</label>
                        <a href="{{ route('subject.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>
                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="SubjectData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Type</th>
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

    {{-- // show subject Data --}}
    <script type="text/javascript">
        $(function() {
            var table = $('#SubjectData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subject.index') }}",
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
                        data: 'type',
                        name: 'type'
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

            //edit subject

            $('#SubjectData').on('click', '#subject_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("subject_id");
                window.location.href = url + "/subject/" + id + "/edit";
            });

            //// Delete subject

            $('#SubjectData').on('click', '#subject_delete', function() {
                let id = $(this).attr("subject_id");
                let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/subject/" + id,
                        method: "DELETE",
                        data: {
                            _token: token
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#SubjectData').dataTable();
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
