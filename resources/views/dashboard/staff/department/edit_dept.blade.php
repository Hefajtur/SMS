@extends('dashboard.master')

@section('title')
Edit Department
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


    <!-- Page Content -->
    <form action="#" method="POST" class="" id="update_dept_form" dept_id="{{ $edit_data->id }}">
        <fieldset>
            @csrf
            <div class="inputs_data row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="department" class="form-label label_name">Name</label>

                        <input type="text" class="form-control inputs" name="department" minlength="3" id="department" value="{{ $edit_data->department }}" id="department" placeholder="Enter name" required>

                        <span id="department_error" class="error"></span>

                        <input type="text" hidden>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p>Status</p>
                        <select class="select2_states inputs" name="status" required>
                            <option value="1" {{ ($edit_data->status ==  1) ? 'selected' : ''}}>Active</option>
                            <option value="0" {{  ($edit_data->status ==  0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-end">Update</button>
        </fieldset>

       
    </form>
    <!-- End Page Content -->


</div>
<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" ></script>
<script>

$('#update_dept_form').validate();

    $(document).ready(function() {

        // Update Data
        $('#update_dept_form').submit(function(e) {
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

            let id = $(this).attr('dept_id');
            
            var url = '{{ route("departments.update", ":id") }}';            
            url = url.replace(':id', id);
        //  alert(url);


        if (isValid) {
            $.ajax({

                url: url,
                type: "PUT",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {

                    if (data.success == true) {
                        $('#update_dept_form')['0'].reset();
                        alert('Department updated Successfully');

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
<!-- End Department AJAX -->
@endsection