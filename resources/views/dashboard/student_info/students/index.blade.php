@extends('dashboard.master')

@section('title')
    Index Student
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container p-3 mb-5">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Student list</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Student list</li>
                    </ol>
                </div>

                <div class="row  bg-white">
                    <form action="" method="POST" id="filter">
                        @csrf
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-2 mt-3">
                                <h1>Filtering</h1>
                            </div>

                            <div class="col-md-3 mt-3">
                                <select id="class_id" class="col-md-12 form-control inputs" name="class_id">
                                    <option class="form-control">--Select Class--</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-3">
                                <select class="col-md-12 form-control inputs" name="section_id" id="section_id">
                                    <option class="form-control">--Select Section--</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-3">
                                <input type="text" class="form-control inputs" name="student_field" id="student_field"
                                    value="" placeholder="Enter Keyword">
                            </div>

                            <div class="col-md-1 mt-3">
                                <button type="button" class="btn btn-primary btn-lg" id="search_btn">Search</button>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-md-12 mb-3 d-flex justify-content-between">
                        <label class="" style="font-size: 25px">Student list</label>

                        <a href="{{ route('students.create') }}" class="btn btn-primary p-3 text-white"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>
                </div>

                <div class="col-md-12 table table-responsive">
                    <table class="table" id="studentData">
                        <thead>
                            <tr>
                                <th scope="col">SR No.</th>
                                <th scope="col">Admission No</th>
                                <th scope="col">Roll No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Class(Section)</th>
                                <th scope="col">Gaurdian Name</th>
                                <th scope="col">Date of birth</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Mobile Number</th>
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

    <script>
        $(document).ready(function() {

            var table = $('#studentData').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('students.index') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'admission_no',
                        name: 'admission_no'
                    },
                    {
                        data: 'roll_no',
                        name: 'roll_no'
                    },
                    {
                        data: 'studentName',
                        name: 'studentName'
                    },
                    {
                        data: 'Class(Section)',
                        name: 'Class(Section)'
                    },
                    {
                        data: 'parent',
                        name: 'parent'
                    },
                    {
                        data: 'b_date',
                        name: 'b_date'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],

            });


            // Class filter change
            $('#class_id').on('change', function() {
                var classId = $(this).val();
                $('#section_id').html('<option value="">All</option>');

                if (classId) {
                    $.ajax({
                        url: url + "/getSection/" + classId,
                        type: 'GET',
                        success: function(data) {
                            $('#section_id').html('<option value="">All</option>');
                            $.each(data, function(key, value) {
                                $('#section_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });

                    table.ajax.url(url + '/students?class_id=' + classId).load();
                } else {

                    table.ajax.url(url + '/students').load();
                }
            });

            //  Section filter change
            $('#section_id').on('change', function() {
                var sectionId = $(this).val();

                if (sectionId) {

                    table.ajax.url(url + '/students?section_id=' + sectionId).load();
                } else {

                    table.ajax.url(url + '/students').load();
                }
            });

            //filter by keyword

            $('#search_btn').click(function() {

                var classId = $('#class_id').val();
                var sectionId = $('#section_id').val();
                var studentKeyword = $('#student_field').val();

                table.ajax.url(url+'/students?class_id=' + classId + '&section_id=' + sectionId + '&student_field=' + studentKeyword).load();
            });
        });
    </script>

    {{-- //edit & delete --}}
    <script>
        $(document).ready(function() {

            //show student

            $('#studentData').on('click', '#student_show', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("student_id");
                window.location.href = url + "/showStudent/" + id;
            });

            //edit student
            $('#studentData').on('click', '#student_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("student_id");
                window.location.href = url + "/editStudent/" + id;
            });


            //// Delete student

            $('#studentData').on('click', '#student_delete', function() {
                let id = $(this).attr("student_id");
                // alert(id);
                let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/students/" + id,
                        method: "DELETE",
                        data: {
                            _token: token
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#studentData').dataTable();
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
