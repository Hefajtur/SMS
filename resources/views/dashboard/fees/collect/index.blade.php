@extends('dashboard.master')

@section('title')
    Collect
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto py-3">
                <form action="#" method="POST" id="fees-collect">
                    <div class="row bg-white  p-3">
                        @csrf

                        <h2>Filtering</h2>


                        <div class="col-md-3 mt-3">
                            <select required class="form-control inputs" name="class_id" id="class_id">
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option class="form-control" value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mt-3">
                            <select required class="form-control inputs" name="section_id" id="section_id">
                                <option value="">Select Section</option>
                            </select>
                        </div>

                        <div class="col-md-3 mt-3">
                            <select required class="form-control inputs" name="student_id" id="student_id">
                                <option value="">Select Student</option>
                                
                            </select>
                        </div>

                        <div class="col-md-2 mt-3">
                            <input type="search" name="student_name" class="form-control inputs" placeholder="Name">
                        </div>
                        <div class="col-md-1 mt-3">
                            <button type="button" class="btn btn-primary btn-lg" id="button-search">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12 bg-white">
                <h2 class="text-center badge_status_act">Collect Student fees </h2>
                <table class="table border p-3 mt-3">
                    <thead>
                        <tr>
                            <th>SR No. <span class="text-danger">*</span></th>
                            <th>student name <span class="text-danger">*</span></th>
                            <th>Admission-No <span class="text-danger">*</span></th>
                            <th>Class(Section) <span class="text-danger">*</span></th>
                            <th>Gurdian Name <span class="text-danger">*</span></th>
                            <th>Mobile <span class="text-danger">*</span></th>
                            <th>Action <span class="text-danger">*</span></th>
                        </tr>
                    </thead>
                    <tbody id="collectResults">
                    </tbody>
                </table>
            </div>
        </div>
    </div>


{{-- // Get Section by Select Class --}}       

<script>
    $(document).ready(function () {
        $("#class_id").change(function () {
            var classId = $(this).val();
            if (classId != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getSections') }}", 
                    data: { class_id: classId },
                    dataType: "json",
                    success: function (data) {
                        $("#section_id").html('<option value="">Select Section</option>');
                        $.each(data, function (key, value) {
                            $("#section_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                // Clear the "Section" and "Student" dropdowns if no class is selected
                $("#section_id").html('<option value="">Select Section</option>');
                $("#student_id").html('<option value="">Select Student</option>');
            }
        });

        $("#section_id").change(function () {
            var sectionId = $(this).val();
            if (sectionId != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getStudents') }}",
                    data: { class_id: $("#class_id").val(), section_id: sectionId },
                    dataType: "json",
                    success: function (data) {
                        $("#student_id").html('<option value="">Select Student</option>');
                        $.each(data, function (key, value) {
                            $("#student_id").append('<option value="' + value.id + '">' + value.first_name + " " + value.last_name + '</option>');
                        });
                    }
                });
            } else {
                // Clear the "Student" dropdown if no section is selected
                $("#student_id").html('<option value="">Select Student</option>');
            }
        });
    });
</script>



{{-- show data --}}
<script>
    $(document).ready(function() {

        function students(classValue, sectionValue, studentValue) {
            $.ajax({
                type: 'GET',
                url: url + '/fees-data',
                data: {
                    class: classValue,
                    section: sectionValue,
                    student: studentValue,
                },
                success: function(data) {

                    console.log(data);


                    $('#collectResults').empty('');

                    for (var i = 0; i < data.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (i + 1) + "</td><td>" + data[i].first_name + " " + data[i].last_name +
                            "</td><td>" + data[i].admission_no + "</td><td>" + data[i].class_name + " (" + data[i].section_name +  ")</td><td>" + data[i].guardian_name + "</td><td>" + data[i].mobile + "</td><td class='btn bg-danger text-white p-2' id='individual_student' stu_id = '" + data[i].id + " '> Collect </td>"
                        );
                        tr.append(td);
                        $('#collectResults').append(tr);
                    }

                },
            });
        }

        $('#button-search').click(function(e) {
            e.preventDefault();
            var selectedClass = $('#class_id').val();
            var selectedSection = $('#section_id').val();
            var selectedStudent = $('#student_id').val();
            // alert(selectedStudent);
            students(selectedClass, selectedSection, selectedStudent);
        });

    });
</script>


 
{{-- show students details --}}
    <script>
        $('#collectResults').on('click', '#individual_student', function(e) {
            e.preventDefault();
            let id = $(this).attr("stu_id");
            window.location.href = url + "/fees-collect/collect/" + id ;
        });
    </script>

@endsection
