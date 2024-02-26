@extends('dashboard.master')

@section('title')
Create Languages
@endsection

<!-- Create Department area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Languages</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('lang.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Language</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="create_lang_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Language Name -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lang_name" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input type="text" required class="form-control inputs" minlength="3" name="name" value="{{ old('lang_name') }}" id="lang_name" placeholder="Enter language name" required>

                        <span id="name_error" class="error"></span>

                    </div>
                </div>

                <!-- Language Code -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lang_code"  class="form-label label_name">Code <span class="text-danger">*</span></label>

                        <input type="text" required class="form-control inputs" minlength="2" name="code" value="{{ old('lang_code') }}" id="lang_code" placeholder="Enter name" required>

                        <span id="code_error" class="error"></span>

                    </div>
                </div>

                <!-- Flag Icons -->
                <div class="col-12 col-md-6">
                    <div class="mb-3 d-flex flex-column">
                        <label for="lang_code" class="form-label label_name">Flag Icon <span class="text-danger">*</span></label>

                        <select required class="select2_states" name="flag_icon" id="lang_code">
                            <option value="">Select Flag Icon</option>
                            @foreach($flags as $flag)
                            <option value="{{ $flag->code }}">{{ $flag->code }}</option>
                            @endforeach
                        </select>

                        <span id="flag_icon_error" class="error"></span>

                    </div>
                </div>

                <!-- Direction -->
                <div class="col-12 col-md-6">
                    <div class="mb-3 d-flex flex-column">
                        <label for="lang_code" class="form-label label_name">Direction <span class="text-danger">*</span></label>

                        <div class="dir_item d-flex justify-content-left mt-2">

                            <div class="form-check mr-5">
                                <input required class="form-check-input" type="radio" name="lang_dir" id="rtl" value="rtl">
                                <label class="form-check-label label_name" for="rtl">
                                    RTL
                                </label>
                            </div>
                            <div class="form-check">
                                <input required class="form-check-input" type="radio" name="lang_dir" id="ltr" value="ltr">
                                <label class="form-check-label label_name" for="ltr">
                                    LTR
                                </label>
                            </div>

                        </div>

                        <span id="lang_dir_error" class="error"></span>

                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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
    $('#create_lang_form').validate();

    $(document).ready(function() {
        // Add Data to DB
        $('#create_lang_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
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
                url: "{{ route('createLang') }}",
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(data) {
                    if (data.success == true) {
                        $('#create_lang_form')['0'].reset();
                        alert("Language added successfully");
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
<!-- End Department AJAX -->
@endsection