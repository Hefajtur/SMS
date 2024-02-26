@extends('dashboard.master')

@section('title')
General Settings
@endsection

<!-- General Settings area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>General Settings</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('genSetting.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('genSetting.index') }}">General Settings</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
        <h3 class="text-dark">General Settings</h3>
    </div>
    <form action="#" method="POST" class="card" id="genSetting_form" enctype="multipart/form-data">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Application Name -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="app_name" class="form-label label_name">Application Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="name" value="{{ ($generalData['app_name']) }}" id="app_name" placeholder="Enter your application name" required>

                        <span id="name_error" class="error"></span>

                    </div>
                </div>

                <!-- Footer Text -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="footer_text" class="form-label label_name">Footer text <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="footer_text" value="{{ ($generalData['footer_text']) }}" id="footer_text" placeholder="Enter footer text" required>

                        <span id="footer_text_error" class="error"></span>

                    </div>
                </div>

                <!-- Light Logo (155 x 40 px) -->
                <div class="col-12 col-md-6 d-flex flex-column mt-5 mb-5">
                    <label for="light_img" class="form-label label_name">Light Logo (155 x 40 px)</label>

                    <!-- Display existing uploaded light_img -->
                    <div class="existing_uploaded_img d-flex justify-content-center mb-2">
                        <img src="{{ asset($generalData['lightLogo']) }}" alt="Existing uploaded Image">
                    </div>

                    <input type="file" class="form-control inputs" name="light_img" id="light_img" placeholder="Enter emargency contact">
                    <!-- <span id="light_img_error" class="error"></span> -->
                </div>

                <!-- Dark Logo (155 x 40 px) -->
                <div class="col-12 col-md-6 mt-5 mb-5">
                    <label for="dark_img" class="form-label label_name">Dark Logo (155 x 40 px)</label>

                    <!-- Display existing uploaded dark_img -->
                    <div class="existing_uploaded_img d-flex justify-content-center mb-2">
                        <img src="{{ asset($generalData['darkLogo']) }}" alt="Existing uploaded Image">
                    </div>

                    <input type="file" class="form-control inputs" name="dark_img" id="dark_img" value="{{ $generalData['darkLogo'] }}" placeholder="Enter emargency contact">
                    <!-- <span id="dark_img_error" class="error"></span> -->
                </div>


                <!-- Favicon (40 x 40 px) -->
                <div class="col-12 col-md-6 mt-5 mb-5">
                    <label for="favicon" class="form-label label_name">Favicon (40 x 40 px)</label>

                    <!-- Display existing uploaded favicon -->
                    <div class="existing_uploaded_img_fav d-flex justify-content-center mb-2">
                        <img src="{{ asset($generalData['favicon']) }}" alt="Existing uploaded Image">
                    </div>

                    <input type="file" class="form-control inputs" name="favicon" id="favicon" placeholder="Enter emargency contact">
                    <!-- <span id="favicon_error" class="error"></span> -->
                </div>


                <!-- Default Language -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="footer_text" class="form-label label_name">Default Language <span class="text-danger fillable">*</span></label>
                        <select class="select2_states" name="default_lang" id="select2_session">
                            <option value="1" {{ ($generalData['default_lang'] == 1) ? 'selected' : '' }}>Bangla</option>
                            <option value="0" {{ ($generalData['default_lang'] == 0) ? 'selected' : '' }}>English</option>
                        </select>
                        <span id="default_lang_error" class="error"></span>
                    </div>
                </div>


                <!-- Currency -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Currency<span class="text-danger fillable">*</span></p>
                        <select class="select2_states" name="currency" id="select2_currency">
                            @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ ($generalData['currency'] == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
                            @endforeach
                        </select>
                        <span id="currency_error" class="error"></span>
                    </div>
                </div>

                <!-- Session -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Session <span class="text-danger fillable">*</span></p>
                        <select class="select2_states" name="session" id="select2_states">
                            @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ ($generalData['session'] == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
                            @endforeach
                        </select>
                        <span id="session_error" class="error"></span>
                    </div>
                </div>

                <!-- Address -->
                <div class="col-12 col-md-12 mt-4">
                    <div class="mb-3">
                        <label for="address" class="form-label label_name">Address <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="address" value="{{ $generalData['address'] }}" id="address" placeholder="Enter your address" required>

                        <span id="address_error" class="error"></span>

                    </div>
                </div>

                <!-- Phone -->
                <div class="col-12 col-md-6 mt-4">
                    <div class="mb-3">
                        <label for="phone" class="form-label label_name">Phone <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="phone" value="{{ $generalData['phone'] }}" id="phone" placeholder="Enter your phone" required>

                        <span id="phone_error" class="error"></span>

                    </div>
                </div>

                <!-- Email -->
                <div class="col-12 col-md-6 mt-4">
                    <div class="mb-3">
                        <label for="email" class="form-label label_name">Email <span class="text-danger fillable">*</span></label>

                        <input type="email" class="form-control inputs" minlength="3" name="email" value="{{ $generalData['email'] }}" id="email" placeholder="Enter email" required>

                        <span id="email_error" class="error"></span>

                    </div>
                </div>


                <!-- School about -->
                <div class="col-12 col-md-12 mt-4">
                    <div class="mb-3">
                        <label for="school" class="form-label label_name">School about <span class="text-danger fillable">*</span></label>

                        <div class="form-floating">
                            <textarea class="form-control text_area inputs" name="school" style="height: 100px">{{ $generalData['school'] }}</textarea>
                        </div>

                        <span id="school_error" class="error"></span>

                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12 mt-3">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>
            </div>

</div>

</fieldset>
</form>
<!-- End Page Content -->


</div>


<!-- General Setting AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#create_genSetting_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#genSetting_form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(document.getElementById('genSetting_form'));

            $.ajax({
                url: "{{ route('updategenSetting') }}",
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
                        alert("General Setting updated successfully");
                    } else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                }
            })
        });
    });
</script>
<!-- End Gender AJAX -->
@endsection