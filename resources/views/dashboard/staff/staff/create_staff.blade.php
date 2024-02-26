@extends('dashboard.master')

@section('title')
Staffs
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Staff</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('staffIndex') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staffIndex') }}">Staff</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Add Staff -->
    <form action="#" method="POST" id="staff_create_form">
        <fieldset>

            @csrf
            <div class="row card">

                <div class="card-body row">
                    <!-- Staff ID -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="staffID" class="form-label label_name">Staff ID <span class="text-danger">*</span></label>
                        <input type="number" class="form-control inputs" name="staffID" id="staffID" placeholder="Enter Staff ID" minlength="2" required>
                        <span id="staffID_error" class="error"></span>
                    </div>

                    <!-- Roles -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="role_id " class="form-label label_name col-md-12">Roles <span class="text-danger">*</span></label>
                        <select class="form-select staff_input inputs col-md-12" name="role_id" id="role_id " required>
                            <option selected>Select Role</option>
                            @foreach($role_data as $role)
                            <option value="{{$role->id}}">{{ $role->role }}</option>
                            @endforeach
                        </select>
                        <span id="role_id_error" class="error"></span>
                    </div>

                    <!-- Designations -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="designation_id  staff_input" class="form-label label_name">Designations <span class="text-danger">*</span></label>
                        <select class="form-select staff_input inputs col-md-12" name="designation_id" id="designation_id" required>
                            <option selected>Select Designation</option>
                            @foreach($desig_data as $desig)
                            <option value="{{ $desig->id }}">{{ $desig->designation }}</option>
                            @endforeach
                        </select>
                        <span id="designation_id_error" class="error"></span>
                    </div>

                    <!-- Departments -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="department_id " class="form-label label_name">Departments <span class="text-danger">*</span></label>
                        <select class="form-select staff_input inputs col-md-12" name="department_id" id="department_id" required>
                            <option selected>Select Department</option>
                            @foreach($dept_data as $dept)
                            <option value="{{$dept->id}}">{{ $dept->department }}</option>
                            @endforeach
                        </select>
                        <span id="department_id_error" class="error"></span>
                    </div>

                    <!-- First Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="first_name" class="form-label label_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="first_name" id="first_name" placeholder="Enter first name" minlength="2" required>
                        <span id="first_name_error" class="error"></span>
                    </div>

                    <!-- Last Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="last_name" class="form-label label_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="last_name" id="last_name" placeholder="Enter last name" minlength="2" required>
                        <span id="last_name_error" class="error"></span>
                    </div>

                    <!-- Father Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="father_name" class="form-label label_name">Father Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="father_name" id="father_name" placeholder="Enter father name" minlength="2" required>
                        <span id="father_name_error" class="error"></span>
                    </div>

                    <!-- Mother Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="mother_name" class="form-label label_name">Mother Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="mother_name" id="mother_name" placeholder="Enter mother name" minlength="2" required>
                        <span id="mother_name_error" class="error"></span>
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="email" class="form-label label_name">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control inputs" name="email" id="email" placeholder="Enter email" minlength="2" required>
                        <span id="email_error" class="error"></span>
                    </div>

                    <!-- Genders -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="gender" class="form-label label_name">Genders <span class="text-danger">*</span></label>
                        <select class="form-select staff_input inputs col-md-12" name="gender" id="gender" required>
                            <option selected>Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span id="gender_error" class="error"></span>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="dob" class="form-label label_name">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control inputs" name="dob" id="dob" minlength="2" required>
                        <span id="dob_error" class="error"></span>
                    </div>

                    <!-- Joining date -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="join_date" class="form-label label_name">Joining date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control inputs" name="join_date" id="join_date" minlength="2" required>
                        <span id="join_date_error" class="error"></span>
                    </div>

                    <!-- Phone -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="phone" class="form-label label_name">Phone <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control inputs" name="phone" id="phone" placeholder="Enter phone" minlength="2" required>
                        <span id="phone_error" class="error"></span>
                    </div>

                    <!-- Emergency contact -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="emergency_contact" class="form-label label_name">Emergency contact </label>
                        <input type="text" class="form-control inputs" name="emergency_contact" id="emergency_contact" placeholder="Enter emargency contact" minlength="2" required>
                        <span id="emergency_contact_error" class="error"></span>
                    </div>

                    <!-- Marital Status -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="marital_status" class="form-label label_name">Marital Status <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="marital_status" id="marital_status" required>
                            <option value="0">Unmarried</option>
                            <option value="1">Married</option>
                        </select>
                        <span id="marital_status_error" class="error"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="status" class="form-label label_name">Status <span class="text-danger">*</span></label>
                        <select class="select2_states inputs col-md-12" name="status" id="statuss" required>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>

                    <!-- Image (95 x 95 px) -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="image" class="form-label label_name">Image (95 x 95 px) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control inputs" name="image" id="image" placeholder="Enter emargency contact" minlength="2" required>
                        <span id="image_error" class="error"></span>
                    </div>


                    <!-- Current address -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="current_add" class="form-label label_name">Current address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="current_add" id="current_add" placeholder="Enter phone" minlength="2" required>
                        <span id="current_add_error" class="error"></span>
                    </div>

                    <!-- Parmanent address -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="permanent_add" class="form-label label_name">Parmanent address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="permanent_add" id="permanent_add" placeholder="Enter phone" minlength="2" required>
                        <span id="permanent_add_error" class="error"></span>
                    </div>

                    <!-- Basic salary -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="basic_salary" class="form-label label_name">Basic salary <span class="text-danger">*</span></label>
                        <input type="number" class="form-control inputs" name="basic_salary" id="basic_salary" placeholder="Enter basic salary" minlength="2" required>
                        <span id="basic_salary_error" class="error"></span>
                    </div>


                    <!-- Uploads Documents -->
                    <div class="col-12 col-md-12">
                        <div class="row card shadow py-4 mb-5" id="duplicate_row">

                            <div class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                <h3 class="text-dark">Upload Documents</h3>
                                <div class="button" id="x">
                                    <button type="button" class="btn btn-primary p-3" id="addmore"> + Add</button>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- End Add Documnets -->


                    <!-- Submit button -->
                    <div class="col-12 col-md-12 mb-5">
                        <button id="create_staff" class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>

                </div>

            </div>

            <!--  -->
        </fieldset>

    </form>
    <!-- End Add Staff -->

</div>


<!-- AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#staff_create_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#staff_create_form').submit(function(e) {
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

            var formData = new FormData(document.getElementById('staff_create_form'));

            if (isValid) {
                $.ajax({
                    url: "{{ route('createStaff') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {

                        if (data.success == true) {
                            alert('Staff added successfully');
                            $('#staff_create_form')['0'].reset();

                            $(document).on('click', '#create_staff', function() {
                                var delete_row = $(this).data("row");
                                $('#' + delete_row).remove();
                            });
                        }
                    },
                    error: function(data, textStatus, errorMessage) {
                        newdata = $.parseJSON(data.responseText)
                        for (const key in newdata.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(newdata.errors[key][0]);
                        }
                    }

                })
            }
        });

    });
</script>

{{-- Jquery field duplicator and remove --}}
<script>
    $(document).ready(function() {

        var count = 1;
        $('#addmore').click(function() {
            count = count + 1;
            var html_code = "<tr class='mb-4' id='row" + count + "'>";

            html_code +=
                "<td class='col-12 col-md-5'><input type='text' class='form-control inputs w-100 px-1' name='staff_doc_name[]' placeholder='Enter name'></td>";
            html_code +=
                "<td class='col-12 col-md-5'><input type='file' class='form-control inputs' name='staff_doc_img[]'></td>";

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
<!-- End AJAX -->
@endsection