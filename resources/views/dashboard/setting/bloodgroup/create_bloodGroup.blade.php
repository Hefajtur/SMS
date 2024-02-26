@extends('dashboard.master')

@section('title')
Create Blood Group
@endsection

<!-- Create Blood Groups area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Blood Group</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item">
                            <a href="{{ route('blood-groups.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blood-groups.index') }}">Blood Group</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="create_bloodGroup_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="gender" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="2" name="name" value="{{ old('gender') }}" id="gender" placeholder="Enter name" required>

                        <span id="name_error" class="error"></span>

                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Status <span class="text-danger fillable">*</span></p>
                        <select class="select2_states" name="status" id="select2_states" required>
                            <option>Choose</option>
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


<!-- Gender AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#create_bloodGroup_form').validate();

    $(document).ready(function() {
        // Add Data to DB
        $('#create_bloodGroup_form').submit(function(e) {
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
                    url: "{{ route('blood-groups.store') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),
                    success: function(data) {
                        console.log(data)
                        if (data.success == true) {
                            $('#create_bloodGroup_form')['0'].reset();
                            alert("Blood Group added successfully");
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
<!-- End Gender AJAX -->
@endsection