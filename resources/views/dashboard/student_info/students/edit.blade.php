@extends('dashboard.master')

@section('title')
    Edit Student
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">

                <form action="" method="POST" id="student_update" student_id="{{ $student->id }}">

                    @csrf

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Admission NO</label>
                            <input type="number" class="form-control inputs" name="admission_no" id="admission_no"
                                value="{{ $student->admission_no }}" required>
                                {{-- hidden id pass --}}
                            <input type="hidden" value="{{ $student->id }}" name="id"> 
                            <span id="admission_no_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Roll NO</label>
                            <input type="number" class="form-control inputs" name="roll_no" id="roll_no"
                                value="{{ $student->roll_no }}" required>
                            <span id="roll_no_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">First name</label>
                            <input type="text" class="form-control inputs" name="first_name" id="first_name"
                                value="{{ $student->first_name }}" required>
                            <span id="first_name_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Last name</label>
                            <input type="text" class="form-control inputs" name="last_name" id="last_name"
                                value="{{ $student->last_name }}" required>
                            <span id="last_name_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Mobile</label>
                            <input type="number" class="form-control inputs" name="mobile" id="mobile"
                                value="{{ $student->mobile }}" required>
                            <span id="mobile_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Email</label>
                            <input type="email" class="form-control inputs" name="email" id="email"
                                value="{{ $student->email }}" required>
                        
                            <span id="email_error" class="error"></span>
                        </div>

                        {{-- class --}}
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Class</label>
                            <select name="class_id" class="form-control inputs" id="class_id" required>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : ''}}>{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <span id="class_id_error" class="error"></span>
                        </div>

                        {{-- Section --}}
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Section</label>
                            <select name="section_id" class="form-control inputs" id="section_id" required>
                                <option value="{{ $student->section->id }}" selected>{{ $student->section->name }}</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Shift</label>
                            <select name="shift_id" class="form-control inputs" id="shift_id" required>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ $student->shift_id == $shift->id ? 'selected' : ''}} >{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Date of Birth</label>
                            <input type="date" class="form-control inputs" name="b_date" id="b_date"
                                value="{{ $student->b_date }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Religion</label>
                            <select name="religion" class="form-control inputs" id="religion" required>      
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}" {{ $student->religion == $religion->id ? 'selected' : ''}} >{{ $religion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Gender</label>
                            <select name="gender" class="form-control inputs" id="gender" required>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ $student->gender == $gender->id ? 'selected' : ''}}>{{ $gender->name }}</option>
                                @endforeach
                            </select>
                            <span id="gender_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Category</label>
                            <select name="category_id" class="form-control inputs" id="category_id" required>
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}" {{ $student->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Blood</label>
                            <select name="blood" class="form-control inputs" id="blood" required>
                                @foreach ($bloods as $blood)
                                    <option value="{{ $blood->id }}" {{ $student->blood == $blood->id ? 'selected' : ''}}>{{ $blood->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Admission date</label>
                            <input type="date" class="form-control inputs" name="admission_date" id="admission_date"
                                value="{{ $student->admission_date }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Image( 100x100 px)</label>
                            <input type="file" class="form-control inputs" name="image" id="image"
                                value="{{ $student->image }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Select Parent</label>
                            <select name="parent" class="form-control inputs" id="parent" required>
                                @foreach ($guardians as $guardian)
                                <option value="{{ $guardian->id }}" {{ $student->parent == $guardian->id ? 'selected' : ''}}>{{ $guardian->guard_name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 ">
                            <label class="label_name">Status<span class="text-danger">*</span></label> <br>
                            <select name="status" checked class="form-control inputs" id="stu_status" required>
                                <option value="1" {{ $student->status == '1' ? 'selected' : '' }}
                                    name="status">Active</option>
                                <option value="0" {{ $student->status == '0' ? 'selected' : '' }}
                                    name="status">InActive</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Select Session<span class="text-danger">*</span></label>
                            <select name="session_id" class="form-control inputs" id="session_id" required>
                                @foreach ($userSessions as $userSession)
                                    <option value="{{ $userSession->id }}" {{ $student->session_id == $userSession->id ? 'selected' : ''}}>{{ $userSession->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 mb-5">
                                <div class="row shadow py-4 mb-5">
                                    <div
                                        class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                        <h3 class="text-dark">Upload Documents</h3>
                                        <div class="button" id="x">
                                            <button type="button" class="btn btn-primary btn-lg" id="add"> +
                                                Add</button>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Document</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="edit_duplicate_row" class="col-12">

                                            </tbody>
                                        </table>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-lg btn-primary "><i
                                                    class="fa-solid fa-save"></i>
                                                Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Add Documnets -->
                        </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Jquery field duplicator and remove --}}
    <script>
        $(document).ready(function() {
            var count = {{ count($documents) }};

            $('#add').click(function() {
                count = count + 1;
                var html_code = "<tr id='row" + count + "'>";

                html_code +=
                    "<td class='col-12 col-md-5'><input type='text' name='doc_name[]' class='form-control inputs' id='doc_name' placeholder='Enter name'></td>";
                html_code +=
                    "<td class='col-12 col-md-5'><input type='file' name='document[]' class='inputs form-control' id='document'></td>";

                html_code +=
                    "<td class='col-12 col-md-1'><button type='button' data-row='row" +
                    count +
                    "' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark'></i></button></td>";
                html_code += "</tr>";

                $('#edit_duplicate_row').append(html_code);
            });

            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                var id = $(this).attr("doc_id");

                if (id != null) {
                    var confirmDelete = confirm('Are you sure you want to remove this?');
                    if (confirmDelete == true) {
                        $.ajax({
                            url: url + "/document-delete/" + id,
                            method: "GET",
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {
                                    $('#' + delete_row).remove();
                                } else {
                                    alert("Invalid ID.");
                                }
                            },
                        })
                    }
                } else {
                    $('#' + delete_row).remove();
                }

            });

            @foreach ($documents as $key => $doc)

                var existingRow = "<tr id='row{{ $key + 1 }}'>";

                existingRow +=
                    "<td class='col-12 col-md-5'><input type='text' name='doc_name[]' class='form-control inputs' id='doc_name' value='{{ $documents[$key]->doc_name }}'></td>";

                existingRow +=
                    "<td class='col-12 col-md-5'><input type='file' name='document[]' value='{{ $documents[$key]->document }}' id='document'> <img class='col-2 inputs img-fluid rounded-circle' src='{{ asset($documents[$key]->document) }}' style='height: 60px; width:60px'></td>"


                existingRow +=
                    "<td class='col-12 col-md-1'><button type='button' data-row='row{{ $key + 1 }}' class='btn btn-danger btn-lg remove' doc_id='{{ $documents[$key]->id }}'><i class='fa-solid fa-xmark' ></i></button></td>";

                existingRow += "</tr>";

                $('#edit_duplicate_row').append(existingRow);
            @endforeach

        });
    </script>

    {{-- //student update --}}
    <script>
        $(document).ready(function() {
            $('#student_update').submit(function(e) {
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
                x = new FormData(document.getElementById("student_update"));
                let id = $(this).attr("student_id");
                // alert(id);
                $.ajax({
                    url: url + "/updateStudent/" + id,
                    method: "POST",
                    data: x,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/students';
                        }
                    },
                    error: function(data, textStatus, errorMessage) {
                        newdata = $.parseJSON(data.responseText)
                        for (const key in newdata.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(newdata.errors[key][0]);
                        }
                    }
                });
        }
            });
        });
    </script>

{{-- //class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#class_id', function() {
                var classId = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSection/" + classId,
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
@endsection
