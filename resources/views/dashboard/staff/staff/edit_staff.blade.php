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
                <h2>Edit Staff</h2>
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
    <form action="#" method="POST" id="staff_update_form" staff_id="{{ $edit_data->id }}">
        <fieldset>
            @csrf

            <div class="row card">

                <div class="card-body row">

                    <!-- Staff ID -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="staffID" class="form-label label_name">Staff ID <span class="text-danger">*</span></label>
                        <input type="number" class="form-control inputs" value="{{ $edit_data->staffID }}" name="staffID" id="staffID" placeholder="Enter staff ID" required>
                             
                        <span id="staffID_error" class="error"></span>
                    </div>


                    <!-- Roles -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="role_id " class="form-label label_name col-md-12">Roles <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="role_id" id="role_id" required>

                            <option selected>Select Role</option>

                            @foreach($role_data as $roles)
                            <option value="{{ $roles->id }}" {{ ($roles->id == $edit_data->role_id) ? 'selected' : '' }}> {{ $roles->role }} </option>
                            @endforeach
                        </select>
                        <span id="role_error" class="error"></span>

                    </div>

                    <!-- Designations -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="designation_id  staff_input" class="form-label label_name">Designations <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="designation_id" id="designation_id" required>
                            <option selected>Select Designation</option>
                            @foreach($desig_data as $desig)
                            <option value="{{ $desig->id }}" {{ ($desig->id == $edit_data->designation_id) ? 'selected' : '' }}> {{ $desig->designation }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Departments -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="department_id " class="form-label label_name">Departments <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="department_id" id="department_id" required>
                            <option selected>Select Department</option>
                            @foreach($dept_data as $dept)
                            <option value="{{$dept->id}}" {{ ($edit_data->department_id == $dept->id) ? 'selected' : '' }}> {{ $dept->department }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- First Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="first_name" class="form-label label_name">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" value="{{ $edit_data->first_name }}" name="first_name" id="first_name" placeholder="Enter first name" required>
                        <span id="first_name_error" class="error"></span>
                    </div>

                    <!-- Last Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="last_name" class="form-label label_name">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" value="{{ $edit_data->last_name }}" name="last_name" id="last_name" placeholder="Enter last name" required>
                        <span id="last_name_error" class="error"></span>
                    </div>

                    <!-- Father Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="father_name" class="form-label label_name">Father Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="father_name" value="{{ $edit_data->father_name }}" id="father_name" placeholder="Enter father name" required>
                        <span id="father_name_error" class="error"></span>
                    </div>

                    <!-- Mother Name -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="mother_name" class="form-label label_name">Mother Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="mother_name" value="{{ $edit_data->mother_name }}" id="mother_name" placeholder="Enter mother name" required>
                        <span id="mother_name_error" class="error"></span>
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="email" class="form-label label_name">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control inputs" name="email" value="{{ $edit_data->email }}" id="email" placeholder="Enter email" required>
                        <span id="email_error" class="error"></span>
                    </div>

                    <!-- Genders -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="gender" class="form-label label_name">Genders <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="gender" id="gender" required>
                            <option selected>Select Gender</option>
                            <option value="male" {{ ($edit_data->gender == 'male') ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ ($edit_data->gender == 'female') ? 'selected' : '' }}>Female</option>
                        </select>
                        <span id="gender_error" class="error"></span>
                    </div>

                    <!-- Date of Birth -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="dob" class="form-label label_name">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control inputs" name="dob" value="{{ $edit_data->dob }}" id="dob" required>
                        <span id="dob_error" class="error"></span>
                    </div>

                    <!-- Joining date -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="join_date" class="form-label label_name">Joining date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control inputs" name="join_date" value="{{ $edit_data->join_date }}" id="join_date" required>
                        <span id="join_date_error" class="error"></span>
                    </div>

                    <!-- Phone -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="phone" class="form-label label_name">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="phone" value="{{ $edit_data->phone }}" id="phone" placeholder="Enter phone" required>
                        <span id="phone_error" class="error"></span>
                    </div>

                    <!-- Emergency contact -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="emergency_contact" class="form-label label_name">Emergency contact </label>
                        <input type="text" class="form-control inputs" name="emergency_contact" value="{{ $edit_data->emergency_contact }}" id="emergency_contact" placeholder="Enter emargency contact">
                        <span id="emergency_contact_error" class="error"></span>
                    </div>

                    <!-- Marital Status -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="marital_status" class="form-label label_name">Marital Status <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="marital_status" id="marital_status" required>
                            <option value="{{ $edit_data->marital_status }}" {{ ($edit_data->marital_status == 0) ? 'selected' : '' }}>Unmarried</option>
                            <option value="{{ $edit_data->marital_status }}" {{ ($edit_data->marital_status == 1) ? 'selected' : '' }}>Married</option>
                        </select>
                        <span id="marital_status_error" class="error"></span>
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="statuses" class="form-label label_name">Status <span class="text-danger">*</span></label>
                        <select class="form-select inputs staff_input col-md-12" name="status" id="statuses" required>
                            <option value="0" {{ ($edit_data->status == 0) ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ ($edit_data->status == 1) ? 'selected' : '' }}>Active</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>

                    <!-- Image (95 x 95 px) -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="image" class="form-label label_name">Image (95 x 95 px) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control inputs" name="image" id="image" placeholder="Enter emargency contact" required>
                        <span id="image_error" class="error"></span>
                    </div>


                    <!-- Current address -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="current_add" class="form-label label_name">Current address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="current_add" value="{{ $edit_data->current_add }}" id="current_add" placeholder="Enter phone" required>
                        <span id="current_add_error" class="error"></span>
                    </div>


                    <!-- Parmanent address -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="permanent_add" class="form-label label_name">Parmanent address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control inputs" name="permanent_add" value="{{ $edit_data->permanent_add }}" id="permanent_add" placeholder="Enter phone" required>
                        <span id="permanent_add_error" class="error"></span>
                    </div>

                    <!-- Basic salary -->
                    <div class="col-12 col-md-3 mb-5">
                        <label for="basic_salary" class="form-label label_name">Basic salary <span class="text-danger">*</span></label>
                        <input type="number" class="form-control inputs" name="basic_salary" value="{{ $edit_data->basic_salary }}" id="basic_salary" placeholder="Enter basic salary" required>
                        <span id="basic_salary_error" class="error"></span>
                    </div>


                    <!-- Uploads Documents -->
                    <!-- <div class="col-12 col-md-12">
                        <div class="row card shadow py-4 mb-5" id="duplicate_row">

                            <div class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                <h3 class="text-dark">Upload Documents</h3>
                                <div class="button" id="x">
                                    <button type="button" class="btn btn-primary p-3" id="add"> + Add</button>
                                </div>


                            </div>

                        </div>
                    </div> -->
                    <!-- End Add Documnets -->




                </div>

            </div>

            <!-- Documents -->
            <div class="row card">
                <div class="card-body">
                    
                    <div class="col-12 col-md-12 mb-5">
                        <div class="row shadow py-4 mb-5">
                            <div class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
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
    
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="col-12 col-md-12 mb-5">
                        <button id="create_staff" class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>

                </div>
            </div>
            <!-- End Documents -->



            <!--  -->
        </fieldset>

    </form>
    <!-- End Add Staff -->

</div>



<!-- AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


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
                        url: "/doc-delete/" + id,
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

        @foreach($documents as $key => $doc)

        var existingRow = "<tr id='row{{ $key + 1 }}'>";

        existingRow +=
            "<td class='col-12 col-md-5'><input type='hidden' name='row_id[]' value='{{ $documents[$key]->id }}'><input type='text' name='doc_name[]' class='form-control inputs' id='doc_name' value='{{ $documents[$key]->doc_name }}'></td>";

        // existingRow +=
        //     "<td class='col-12 col-md-5'><span name='document[]' class='col-md-8 border-0' id='document' readonly>{{ $documents[$key]->doc_name }}</span> <img class='col-md-4 inputs img-fluid rounded-circle' src='{{ asset("/").$documents[$key]->doc_item }}' alt='' style='height: 60px; width: 85px'></td>"


        existingRow += '<td class="col-12 col-md-5"><div class="form-group row"><label class="col-sm-6 col-form-label staff-label">{{ $documents[$key]->doc_name }}</label><div class="col-sm-6 text-center"><img class="img-fluid rounded-circle" name=document[] src="{{ asset("/").$documents[$key]->doc_item }}" alt="" style="height: 60px; width: 60px"></div></td>'


        existingRow +=
            "<td class='col-12 col-md-1'><button type='button' data-row='row{{ $key + 1 }}' class='btn btn-danger btn-lg remove' doc_id='{{ $documents[$key]->id }}'><i class='fa-solid fa-xmark' ></i></button></td>";

        existingRow += "</tr>";

        $('#edit_duplicate_row').append(existingRow);
        @endforeach

    });
</script>


<script>
    $(document).ready(function() {

        // Add Data to DB
        $('#staff_update_form').submit(function(e) {
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

            var id = $(this).attr('staff_id');
            var url = '{{ route("updateStaff", ":id") }}';
            url = url.replace(':id', id);

            var formData = new FormData(document.getElementById('staff_update_form'));

            if (isValid) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            console.log(data);
                            alert('Staff updated successfully');
                            // $('#staff_update_form')['0'].reset();
                        } else {
                            for (const key in data.errors) {
                                errorContainer = $('#' + key + '_error');
                                errorContainer.text(data.errors[key][0]);

                            }
                        }
                    }

                })
            }
        });


    });
</script>

<!-- End AJAX -->
@endsection