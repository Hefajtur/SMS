@extends('dashboard.master')

@section('title')
    Index SubjectAssign
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h3 class="bradecrumb-title mb-1 px-2 mt-2">Subject Assign</h3>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                            <li class="breadcrumb-item" style="font-size: 15px">Subject Assign</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Subject Assign</label>
                        <a href="{{ route('subjectAssign.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>
                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="subjectAssignData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No</th>
                                    <th scope="col">Class(Section)</th>
                                    <th scope="col">Subject & Teacher</th>
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

    <!-- Modal -->
    <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Subject & Teacher</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Teacher</th>
                            </tr>
                        </thead>

                        <tbody id="user">

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- show data in modal --}}
    <script type="text/javascript">
        $(document).ready(function() {

            $('#subjectAssignData').on('click', '#show-user', function() {

                let id = $(this).attr("data_url");
                //    alert(id);
                $("#user").html('');

                function showData() {
                    $.ajax({
                        url:url + "/subjectAssign/" + id,
                        dataType: "json",
                        method: "GET",
                        success: function(response) {
                            var x = response;

                            // console.log(x);

                            $('#userShowModal').modal('show');

                            for (var i = 0; i < x.length; i++) {
                                var tr = $("<tr></tr>");
                                var td = $("<td>" + x[i].subject.name +
                                    "</td><td>" + x[i].user.name + "</td><td>");

                                tr.append(td);
                                $("#user").append(tr);
                            }
                        },
                    })
                }
                showData();
            })
        })
    </script>

    {{-- // show subjectAssign with pagination Data --}}
    <script type="text/javascript">
        $(function() {
            var table = $('#subjectAssignData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subjectAssign.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'classAndSection',
                        name: 'classAndSection'
                    },

                    {
                        data: 'subAndteacher',
                        name: 'subAndteacher'
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
    
    {{-- //edit & delete --}}
    <script>
        $(document).ready(function() {

            //edit subjectAssign

            $('#subjectAssignData').on('click', '#subjectAssign_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let classid = $(this).attr("subjectAssignclass_id");
                let sectionid = $(this).attr("subjectAssignsection_id");
                window.location.href = url + "/subjectAssign/" + classid + "/" + sectionid;
            });

            //// Delete subjectAssign

            $('#subjectAssignData').on('click', '#subjectAssign_delete', function() {
                let classid = $(this).attr("subjectAssignclass_id");
                let sectionid = $(this).attr("subjectAssignsection_id");
                // let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/subjectAssignDelete/" + classid + "/" + sectionid,
                        method: "GET",
                        data:{
                            'classid': classid,
                            'sectionid': sectionid,
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#subjectAssignData').dataTable();
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
