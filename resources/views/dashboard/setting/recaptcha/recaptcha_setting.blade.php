@extends('dashboard.master')

@section('title')
Recaptcha Settings
@endsection

<!-- Recaptcha Settings area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Recaptcha Settings</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('recaptcha.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('recaptcha.index') }}">Recaptcha  Settings</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->

    <form action="#" method="POST" class="card" id="create_recaptcha_form" enctype="multipart/form-data">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-4 mb-0">
            <h3 class="text-dark">Recaptcha settings</h3>
        </div>
        <fieldset>
            @csrf
            <div class="inputs_data row card-body pb-5">

               <!-- Recaptcha Sitekey -->
               <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="recaptcha_siteKey" class="form-label label_name">Recaptcha Sitekey <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="recaptcha_siteKey" value="{{ ($recaptchaData['recaptcha_siteKey']) ? $recaptchaData['recaptcha_siteKey'] : ''}}" id="recaptcha_siteKey" placeholder="Recaptcha Sitekey" required>

                        <span id="recaptcha_siteKey_error" class="error"></span>

                    </div>
                </div>

                <!-- Recaptcha Secret -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="recaptcha_secret" class="form-label label_name">Recaptcha Secret <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="recaptcha_secret" value="{{$recaptchaData['recaptcha_secret'] }}" id="recaptcha_secret" placeholder="Recaptcha Secret" required>

                        <span id="recaptcha_secret_error" class="error"></span>
                    </div>
                </div>


                <!-- Recaptcha status -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="recaptcha_status" class="form-label label_name">Recaptcha status <span class="text-danger fillable">*</span></label>
                        <select required class="select2_states" name="recaptcha_status" id="recaptcha_status">
                            <option value="1" {{ ($recaptchaData['recaptcha_status'] == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($recaptchaData['recaptcha_status'] == 0) ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <span id="recaptcha_status_error" class="error"></span>
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
    $(document).ready(function() {

        // Add Data to DB
        $('#create_recaptcha_form').submit(function(e) {
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
            // var formData = new FormData(document.getElementById('create_recaptcha_form'));

            $.ajax({
                url: "{{ route('updateRecaptcha') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success == true) {
                        alert("Recaptcha Setting added successfully");
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