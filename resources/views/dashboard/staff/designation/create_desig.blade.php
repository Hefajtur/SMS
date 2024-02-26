@extends('dashboard.master')

@section('title')
Create Designation
@endsection

<!-- Create Designation area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Designation</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('designations.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('designations.index') }}">Designation</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add data</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="" id="create_desig_form">
        <fieldset>

            @csrf
                        
            <div class="inputs_data row">
    
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="designation" class="form-label">Name</label>

                        <input type="text" class="form-control inputs" name="designation" minlength="3" id="designation" placeholder="Enter name" required>

                        <span id="designation_error" class="error"></span>
                    </div>
                </div>
    
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p>Status</p>
                        <select class="select2_states" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span id="designation_error" class="error"></span>
                    </div>
                </div>
            </div>
    
            <button class="btn btn-primary float-end">Submit</button>
        </fieldset>
    </form>
    <!-- End Page Content -->


</div>


<!-- Designation AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#create_desig_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#create_desig_form').submit(function(e) {
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
                    url: "{{ route('designations.store') }}",
                    type: "POST",
                    dataType: "json",

                    data: $(this).serialize(),
                    success: function(data) {

                        if (data.success == true) {

                            alert('Designation added Successfully');
                            $('#create_desig_form')['0'].reset();

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
<!-- End Designation AJAX -->
@endsection