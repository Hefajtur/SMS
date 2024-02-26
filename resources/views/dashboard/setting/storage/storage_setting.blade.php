@extends('dashboard.master')

@section('title')
Storage Settings
@endsection

<!-- Storage Settings area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Storage Settings</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('storage.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('storage.index') }}">Storage Settings</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->

    <form action="#" method="POST" class="card" id="storage_form" enctype="multipart/form-data">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-4 mb-0">
            <h3 class="text-dark">AWS S3 Info</h3>
        </div>
        <fieldset>
            @csrf
            <div class="inputs_data row card-body pb-5">

                <!-- File system -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label label_name">File system <span class="text-danger fillable">*</span></label>
                        <select required class="select2_states" name="fileSystem" id="filestystem" required>
                            <option>Select</option>
                            <option value="local" {{ ($storageData['fileSystem'] == 'local') ? 'selected' : '' }}>Local</option>
                            <option value="s3" id="parentS3" {{ ($storageData['fileSystem'] == 's3') ? 'selected' : '' }}>S3</option>
                        </select>
                        <span id="fileSystem_error" class="error"></span>
                    </div>
                </div>

                <!-- AWS ACCESS KEY ID -->
                <div class="col-12 col-md-6" s3="s3_item">
                    <div class="mb-3">
                        <label for="aws_accessKey" class="form-label label_name">AWS ACCESS KEY ID <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="aws_accessKey" value="{{ $storageData['aws_accessKey'] }}" id="aws_accessKey" placeholder="AWS ACCESS KEY ID" required>

                        <span id="aws_accessKey_error" class="error"></span>

                    </div>
                </div>

                <!-- AWS Secret KEY ID -->
                <div class="col-12 col-md-6" s3="s3_item">
                    <div class="mb-3">
                        <label for="aws_secretKey" class="form-label label_name">AWS Secret KEY ID <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="aws_secretKey" value="{{ $storageData['aws_secretKey'] }}" id="aws_secretKey" placeholder="AWS Secret KEY ID" required>

                        <span id="aws_secretKey_error" class="error"></span>

                    </div>
                </div>

                <!-- AWS DEFAULT REGION -->
                <div class="col-12 col-md-6" s3="s3_item">
                    <div class="mb-3">
                        <label for="aws_defaultRegion" class="form-label label_name">AWS DEFAULT REGION <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="aws_defaultRegion" value="{{ $storageData['aws_defaultRegion'] }}" id="aws_defaultRegion" placeholder="AWS DEFAULT REGION" required>              

                        <span id="aws_defaultRegion_error" class="error"></span>

                    </div>
                </div>

                <!-- AWS BUCKET -->
                <div class="col-12 col-md-6" s3="s3_item" s3="s3_item">
                    <div class="mb-3">
                        <label for="aws_bucket" class="form-label label_name">AWS BUCKET <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="aws_bucket" value="{{ $storageData['aws_bucket'] }}" id="aws_bucket" placeholder="AWS BUCKET " required>

                        <span id="aws_bucket_error" class="error"></span>

                    </div>
                </div>

                <!-- AWS ENDPOINT -->
                <div class="col-12 col-md-6" s3="s3_item">
                    <div class="mb-3">
                        <label for="aws_endpoint" class="form-label label_name">AWS ENDPOINT <span class="text-danger fillable">*</span></label>

                        <input type="text" class="form-control inputs" minlength="3" name="aws_endpoint" value="{{ $storageData['aws_endpoint'] }}" id="aws_endpoint" placeholder="AWS ENDPOINT" required>

                        <span id="aws_endpoint_error" class="error"></span>

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
    $('#storage_form').validate();

    $(document).ready(function() {

        $('#filestystem').on('clicked', '#parentS3', function() {
            // $("[s3='s3_item']").show();
            // alert('clicked');
        });

        // Add Data to DB
        $('#storage_form').submit(function(e) {
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
                    url: "{{ route('updateStorage') }}",
                    type: "POST",
                    data: $(this).serialize(),

                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {                        
                            alert("Storage Setting updated successfully");
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