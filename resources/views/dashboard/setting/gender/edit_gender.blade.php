@extends('dashboard.master')

@section('title')
Edt Gender
@endsection

<!-- Create Gender area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Gender</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('genders.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('genders.index') }}">Genders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="update_gender_form" gender_id="{{ $edit_data->id }}">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="gender" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="name" value="{{ $edit_data->name }}" id="gender" placeholder="Enter name" required>

                        <span id="name_error" class="error"></span>
                        
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Status <span class="text-danger fillable">*</span></p>
                        <select class="select2_states" name="status" id="select2_states" required>
                            <option value="1" {{ ($edit_data->status == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($edit_data->status == 0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>
            </div>
        </fieldset>

       
    </form>
    <!-- End Page Content -->


</div>
<!-- Gender AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" ></script>
<script>

$('#update_gender_form').validate();

    $(document).ready(function() {


        // Update Data
        $('#update_gender_form').submit(function(e) {
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

            let id = $(this).attr('gender_id');
            var url = '{{ route("genders.update", ":id") }}';
            url = url.replace(':id', id);

            if (isValid) {

                $.ajax({

                    url: url,
                    type: "PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {

                        if (data.success == true) {
                            $('#update_gender_form')['0'].reset();
                            alert('Gender updated Successfully');

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