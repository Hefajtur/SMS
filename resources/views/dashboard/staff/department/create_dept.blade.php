@extends('dashboard.master')

@section('title')
Create Department
@endsection

<!-- Create Department area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Department</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('departments.index') }}">Department</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add data</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->
    <form action="#" method="POST" class="card" id="create_dept_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">
                
                <!-- Department -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="department" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="department" value="{{ old('department') }}" id="department" placeholder="Enter name" required>

                        <span id="department_error" class="error"></span>

                    </div>
                </div>

                <!-- Status -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Status <span class="text-danger fillable">*</span></p>
                        <select class="select2_states" name="status" id="select2_states" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>

</div>


</fieldset>
</form>

<!-- End Page Content -->


</div>


<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#create_dept_form').validate();

    $(document).ready(function() {
        // Add Data to DB
        $('#create_dept_form').submit(function(e) {
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
                    url: "{{ route('departments.store') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#create_dept_form').serialize(),
                    success: function(data) {
                        if (data.success == true) {
                            alert("Department added successfully");
                            $('#create_dept_form')['0'].reset();
                        } 
                    },
                    error: function(data, textStatus, errorMessage) {
                        // console.log(data);
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
<!-- End Department AJAX -->
@endsection