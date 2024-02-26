@extends('dashboard.master')

@section('title')
    Promote Students
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3 bg-white">
                <div class="">
                    <h3 class="bradecrumb-title mb-1">Promote list</h3>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Promote list</li>
                    </ol>
                </div>


                <h4 class="p-3">Promote students</h4>


                <div class="row  bg-white">
                    <form action="" method="POST" id="promotesearch">
                    <fieldset>
                        @csrf
                        <div class="row p-3">
                            <div class="col-md-6">
                                <label for="" class="label_name">Class <span class="text-danger">*</span></label>
                                <select required name="class_id" id="class_id" class="form-control inputs">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="class_id_error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="label_name">Section<span class="text-danger">*</span></label>
                                <select required name="section_id" id="section_id" class="form-control inputs">
                                    <option value="">Select Section</option>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>
                        </div>
                        <h3 class="mt-0 p-3">Promote students in next session</h3>

                        <div class="row mt-1 p-3">
                            <div class="col-md-4">
                                <label for="" class="label_name">Promote session<span
                                        class="text-danger">*</span></label>
                                <select required name="session_id" id="session_id" class="form-control inputs">
                                    <option value="">Select Session</option>
                                    @foreach ($schoolSessions as $schoolSession)
                                        <option class="form-control" value="{{ $schoolSession->id }}">
                                            {{ $schoolSession->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="session_id_error" class="error"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="label_name">Promote class<span
                                        class="text-danger">*</span></label>
                                <select required name="promoteclass" id="promoteclass" class="form-control inputs">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="promote_class_error" class="error"></span>
                            </div>

                            <div class="col-md-4">
                                <label for="" class="label_name">Promote section<span
                                        class="text-danger">*</span></label>
                                <select required name="promotesection" id="promotesection" class="form-control inputs">
                                    <option value="">Select Section</option>
                                </select>
                                <span id="promote_section_error" class="error"></span>
                            </div>
                        </div>

                        <div class="mt-2 p-3">
                            <button type="submit" class="btn btn-lg btn-primary float-end" id="search"><i
                                    class="fa-solid fa-search px-1"></i>Search</button>
                        </div>

                        <div class="col-md-12 mt-5 border" id="student_show" style="display: none">
                            <h2>Student List</h2>
                            <div class="row">
                                <table class="table checkbox-group">
                                    <thead>
                                        <tr>
                                            <th scope="col">
                                                <input class="check-all" type="checkbox">
                                            </th>
                                            <th scope="col">Admission NO</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Guardian Name</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Result</th>
                                            <th scope="col">Roll</th>

                                        </tr>
                                    </thead>
                                    <tbody id="studentDataForPromote" class="">
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2 p-3">
                                <button type="submit" id="promote-button" class="btn btn-lg btn-primary float-end"><i
                                        class="fa-solid fa-save px-1"></i>Promote</button>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#class_id', function() {
                var Id = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSection-from-class/" + Id,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {

                        var option = '';
                        option += '<option selected disabled>Select Section</option>';

                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key][
                                'name'
                            ] + '</option>';
                        };
                        $('#section_id').empty().append(option);

                    },
                })
            })

        });
    </script>

    {{-- Promote class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#promoteclass', function() {
                var Id = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSection-from-class/" + Id,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {

                        var option = '';
                        option += '<option selected disabled>Select Section</option>';

                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key][
                                'name'
                            ] + '</option>';
                        };
                        $('#promotesection').empty().append(option);

                    },
                })
            })

        });
    </script>


    <script>
        $(document).ready(function() {

            $('#search').click(function(e) {
                e.preventDefault();

                var selectedClass = $('#class_id').val();
                var selectedSection = $('#section_id').val();

                // alert(selectedClass);

                showStudent(selectedClass, selectedSection);

            });

            function showStudent(classValue, sectionValue) {
                $.ajax({
                    type: 'GET',
                    url: url + '/get-prostudents',
                    data: {
                        class: classValue,
                        section: sectionValue
                    },
                    success: function(data) {

                        $('#studentDataForPromote').empty('');
                        $('#student_show').css('display', 'block');

                        for (i = 0; i <= data.length; i++) {
                            var tr = $("<tr></tr>");
                            var td = $(
                                "<td><input class='' type='checkbox' name='students_id[]' value='" +
                                data[i].id + "'></td><td>" + data[i].admission_no +
                                "</td><td>" + data[i].first_name + " " + data[i].last_name +
                                " </td><td>" +
                                data[i].guardians.guard_name + "</td><td>" + data[i].mobile +
                                "</td><td><span class='badge_status_inact'> Pending </span></td><td><input class='inputs' type='number' value=''></td>"
                            );

                            tr.append(td);
                            $('#studentDataForPromote').append(tr);
                        }

                    },

                });
            }

            //student id selection
            $(".check-all").click(function() {
                var parentDiv = $(this).closest(".checkbox-group");
                parentDiv.find("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });
            $("input[type=checkbox]").not(".check-all").click(function() {
                var parentDiv = $(this).closest(".checkbox-group");

                if (!parentDiv.find("input[type=checkbox]").not(".check-all").prop("checked")) {
                    parentDiv.find(".check-all").prop("checked", false);
                }
            });
        });
    </script>


    {{-- promote students to another session class and section --}}
    <script>
        $(document).ready(function() {

            $('#promotesearch').submit(function(e) {
                e.preventDefault();

                var isValid = true;
        $(".validate-input").each(function () {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass("error");
            } else {
                $(this).removeClass("error");
            }
        });
        if (isValid) {

                $.ajax({
                    url: url + "/promote-students",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",

                    success: function(response) {
                        if (response.success == true) {

                            alert('Promote Successfully');
                            window.location.href = '/index/promoteStudent';

                        }
                    },
                });
        }
            });
        });
    </script>


@endsection

{{-- //php artisan migrate:refresh --path=/database/migrations/2023_07_27_131521_create_promote_students_table.php --}}
