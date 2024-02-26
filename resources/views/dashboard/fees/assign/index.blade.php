@extends('dashboard.master')

@section('title')
    index Assign
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/assigns') }}">Fess Assign</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 bg-white mx-auto ">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Fees Group</h3>
                    <h3 class="mt-5 badge_status_act">All Assign Data</h3>
                    <a href="{{ url('/assigns/create') }}"><button class="p-3 btn-primary "><strong>+Add
                                Assign</strong></button></a>
                </div>


            </div>
            <div class="col-md-12 bg-white">
                <table class="table table-border" id="assignData">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Group</th>
                            <th>Class(Section)</th>
                            <th>Category</th>
                            <th>Gender</th>
                            <th>Student-List</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Studnts</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> Admission NO</th>
                                <th scope="col">Student name</th>
                                <th scope="col">Class(Section)</th>
                                <th scope="col">Fees type</th>
                                <th scope="col">Guardian name</th>
                                <th scope="col">Mobile number</th>
                            </tr>
                        </thead>

                        <tbody id="students">

                        </tbody>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    {{-- <button type="button" class="btn btn-success" data-bs-dismiss="modal">Confirm</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- show data in modal --}}
    <script type="text/javascript">
        $(document).ready(function() {

            $('#assignData').on('click', '#show-students', function() {

                let id = $(this).attr("data_url");
                //    alert(id);
                $("#students").html('');

                $.ajax({
                    url: url + "/assigns/" + id,
                    dataType: "json",
                    method: "GET",
                    success: function(response) {
                        var x = response;
 
                        // console.log(x);

                        $('#userShowModal').modal('show');

                        for (var i = 0; i < x.length; i++) {

                            var tr = $("<tr></tr>");
                            var td = $("<td>" + x[i].admission_no + "</td><td>" + x[i].first_name + " " + x[i].last_name + "</td><td>" + x[i].class_name + " ("+ x[i].section_name + ")</td><td>" + x[i].type_name + "</td><td>" + x[i].guard_name + "</td><td>" + x[i].mobile +"</td>");

                            tr.append(td);
                            $("#students").append(tr);
                        }
                    },
                })
            })
        })
    </script>


    {{-- Index --}}
    <script type="text/javascript">
        $(function() {
            var table = $('#assignData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('assigns') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'group.name',
                        name: 'group.name',

                    },
                    {
                        data: 'class(section)',
                        name: 'class(section)',

                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                    },
                    {
                        data: 'students',
                        name: 'students'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        });
    </script>
    

@endsection
