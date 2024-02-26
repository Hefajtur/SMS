@extends('dashboard.master')

@section('title')
    Create Student
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Student Create</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Student list</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Add New</li>
                    </ol>
                </div>
                <form action="" method="POST" id="student_insert">
                   <fieldset>
                    @csrf

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Admission NO <span class="text-danger">*</span></label>
                            <input type="number" required class="form-control inputs" name="admission_no" id="admission_no" placeholder="Enter Admission N0" >
                            {{-- hidden id pass --}}
                            <input type="hidden" value="" name="id">
                            <span id="admission_no_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Roll NO <span class="text-danger">*</span></label>
                            <input type="number" required class="form-control inputs" name="roll_no" id="roll_no"
                                placeholder="Enter Roll NO" >
                            <span id="roll_no_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">First name <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control inputs" name="first_name" id="first_name"
                                placeholder="Enter First name" >
                            <span id="first_name_error" class="error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Last name <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control inputs" name="last_name" id="last_name"
                                placeholder="Enter Last name" >
                            <span id="last_name_error" class="error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Mobile</label>
                            <input type="number" required class="form-control inputs" name="mobile" id="mobile"
                                placeholder="Enter Mobile" >
                            <span id="mobile_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Email</label>
                            <input type="email" required class="form-control inputs" name="email" id="email"
                                placeholder="Enter Email" >
                            <span id="email_error" class="error"></span>
                        </div>

                        {{-- class --}}
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Class<span class="text-danger">*</span></label>
                            <select name="class_id" required class="form-control inputs" id="class_id" >
                                <option value="">--Select Class--</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="class_id_error" class="error"></span>
                        </div>

                        {{-- Section --}}
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Section<span class="text-danger">*</span></label>
                            <select name="section_id" required class="form-control inputs" id="section_id" >
                                <option value="">--Select a section--</option>
                            </select>
                            <span id="section_id_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Shift</label>
                            <select name="shift_id" required class="form-control inputs" id="shift_id" >
                                <option value="">--Select--</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">
                                        {{ $shift->name }}
                                    </option>
                                @endforeach
                                
                            </select>
                            <span id="shift_id_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" required class="form-control inputs" name="b_date" id="b_date" >
                            <span id="b_date_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Religion</label>
                            <select name="religion" required class="form-control inputs" id="religion" >
                                <option value="">Select religion</option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">
                                        {{ $religion->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="religion_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Gender</label>
                            <select name="gender" required class="form-control inputs" id="gender" >
                                <option value="">Select gender</option>
                                @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}">
                                        {{ $gender->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="gender_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Category</label>
                            <select name="category_id" required class="form-control inputs" id="category_id" >
                                <option value="">Select category</option>
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="category_id_error" class="error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Blood</label>
                            <select name="blood" required class="form-control inputs" id="blood" >
                                <option value="">--Select blood group--</option>
                                @foreach ($bloods as $blood)
                                    <option value="{{ $blood->id }}">
                                        {{ $blood->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="blood_error" class="error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Admission date <span class="text-danger">*</span></label>
                            <input type="date" required class="form-control inputs" name="admission_date" id="admission_date">
                            <span id="admission_date_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Image( 100x100 px)<span class="text-danger">*</span></label>
                            <input type="file" required class="inputs form-control" name="image" id="image" >
                            <span id="image_error" class="error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label_name">Select Parent<span class="text-danger">*</span></label>
                            <select name="parent" required class="form-control inputs" id="parent" >
                                <option value="">--Select--</option>
                                @foreach ($guardians as $guardian)
                                    <option value="{{ $guardian->id }}">
                                        {{ $guardian->guard_name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="parent_error" class="error"></span>
                        </div>

                        <div class="col-md-3 ">
                            <label class="label_name">Status<span class="text-danger">*</span></label> <br>
                            <select name="status" required checked class="form-control inputs" id="stu_status" >
                                <option value="">--Choose One--</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                            <span id="status_error" class="error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label_name">Select Session<span class="text-danger">*</span></label>
                            <select name="session_id" required class="form-control inputs" id="session_id" >
                                <option value="">--Select--</option>
                                @foreach ($userSessions as $userSession)
                                    <option value="{{ $userSession->id }}">
                                        {{ $userSession->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="session_id_error" class="error"></span>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-12 col-md-12 mb-5">
                            <div class="row shadow py-4 mb-5">
                                <div
                                    class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                    <h3 class="text-dark">Upload Documents</h3>
                                    <div class="button" id="x">
                                        <button type="button" class="btn btn-primary btn-lg" id="addmore"> +
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

                                        <tbody id="duplicate_row" class="col-12">

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
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- Jquery field duplicator and remove --}}
    <script>
        $(document).ready(function() {

            var count = 1;
            $('#addmore').click(function() {
                count = count + 1;
                var html_code = "<tr id='row" + count + "'>";

                html_code +=
                    "<td class='col-12 col-md-5'><input type='text' name='doc_name[]' class='form-control inputs' id='doc_name' placeholder='Enter name' required></td><span id='doc_name_error' class='error'></span>";
                html_code +=
                    "<td class='col-12 col-md-5'><input type='file' name='document[]' class='inputs form-control' id='document' required></td><span id='document_error' class='error'></span>";

                html_code +=
                    "<td class='col-12 col-md-1'><button type='button' data-row='row" +
                    count +
                    "' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark'></i></button></td>";
                html_code += "</tr>";

                $('#duplicate_row').append(html_code);
            });

            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });


        });
    </script>

    {{-- //create student  --}}
    <script>
        $(document).ready(function() {
                    $('#student_insert').submit(function(e) {
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

                        x = new FormData(document.getElementById("student_insert"));
                        $.ajax({
                            url: "{{ route('store') }}",
                            method: "POST",
                            data: x,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {

                                    alert('Add Successfully');
                                    $('#student_insert')[0].reset();
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

    {{-- class and section --}}
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
