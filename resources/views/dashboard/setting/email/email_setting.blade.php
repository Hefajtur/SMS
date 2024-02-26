@extends('dashboard.master')

@section('title')
Email Settings
@endsection

<!-- Email Settings area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Email Settings</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('emailSetting.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('emailSetting.index') }}">Email Settings</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <!-- Page Content -->

    <form action="#" method="POST" class="card" id="emailSetting_form">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-4 mb-0">
            <h3 class="text-dark">Email settings</h3>
        </div>
        <fieldset>
            @csrf
            <div class="inputs_data row card-body pb-5">

      
               <!-- Mail Host-->
               <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="mail_host" class="form-label label_name">Mail host <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="mail_host" value="{{ ($emailData['mail_host'])? $emailData['mail_host'] : '' }}" id="mail_host" placeholder="mail host" required>

                        <span id="mail_host_error" class="error"></span>

                    </div>
                </div>

                <!-- Mail Address -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="mail_address" class="form-label label_name">Mail Address <span class="text-danger fillable">*</span></label>

                        <input type="email" class="form-control inputs" minlength="3" name="mail_address" value="{{ $emailData['mail_address'] }}" id="mail_address" placeholder="Mail host" required>

                        <span id="mail_address_error" class="error"></span>
                    </div>
                </div>

                <!-- From Name -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="form_name" class="form-label label_name">From Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="form_name" value="{{ $emailData['form_name'] }}" id="form_name" placeholder="Recaptcha Secret" required>

                        <span id="form_name_error" class="error"></span>
                    </div>
                </div>

                <!-- Mail User Name -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="mail_username" class="form-label label_name">Mail User Name <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="mail_username" value="{{ $emailData['mail_username'] }}" id="mail_username" placeholder="Mail Address" required>

                        <span id="mail_username_error" class="error"></span>
                    </div>
                </div>
                
                <!-- Mail Password -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="mail_password" class="form-label label_name">Mail Password <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="mail_password" value="{{ $emailData['mail_password'] }}" id="mail_password" placeholder="Enter your mail password" required>

                        <span id="mail_password_error" class="error"></span>
                    </div>
                </div>
                
                <!-- Mail Port -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="mail_port" class="form-label label_name">Mail port <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="mail_port" value="{{ $emailData['mail_port'] }}" id="mail_port" placeholder="Enter Your Mail Port" required>

                        <span id="mail_port_error" class="error"></span>
                    </div>
                </div>


                <!-- Encryption -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="email_encryption" class="form-label label_name">Encryption <span class="text-danger fillable">*</span></label>
                        <select class="select2_states" name="email_encryption" id="email_encryption" required>
                            <option value="null" {{ ($emailData['email_encryption'] == 'null') ? 'selected' : '' }}>Null</option>
                            <option value="tls" {{ ($emailData['email_encryption'] == 'tls') ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ ($emailData['email_encryption'] == 'ssl') ? 'selected' : '' }}>SSL</option>
                        </select>
                        <span id="email_encryption_error" class="error"></span>
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
    $('#emailSetting_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#emailSetting_form').submit(function(e) {
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
                    url: "{{ url('/email-settings/update') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            πalert("Email Setting updated successfully");
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
<!-- End Gender AJAX -->
@endsection