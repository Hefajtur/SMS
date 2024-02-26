@extends('dashboard.master')

@section('title')
    Create Gaurdian
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <form action="" method="POST" id="gaurdian_update" enctype="multipart/form-data"
                    gardian_id="{{ $guardians->id }}">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Father Name</label>
                                <input type="text" class="form-control" name="fath_name" id="fath_name"
                                    value="{{ $guardians->fath_name }}" required>
                                     {{-- hidden id pass --}}
                            <input type="hidden" value="{{ $guardians->id }}" name="id"> 
                                <span id="fath_name_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father Mobile</label>
                                <input type="number" class="form-control" name="fath_mobile" id="fath_mobile"
                                    value="{{ $guardians->fath_mobile }}" required>
                                <span id="fath_mobile_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father profession</label>
                                <input type="text" class="form-control" name="fath_prof" id="fath_prof"
                                    value="{{ $guardians->fath_prof }}" required>

                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="fath_img" id="fath_img"
                                    value="{{ $guardians->fath_img }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name"
                                    value="{{ $guardians->mother_name }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Mother Mobile</label>
                                <input type="number" class="form-control" name="mother_mobile" id="mother_mobile"
                                    value="{{ $guardians->mother_mobile }}" required>
                            </div>

                            {{-- class --}}
                            <div class="col-md-3 mb-3">
                                <label>Mother profession</label>
                                <input type="text" class="form-control" name="mother_prof" id="mother_prof"
                                    value="{{ $guardians->mother_prof }}" required>
                            </div>

                            {{-- Section --}}
                            <div class="col-md-3 mb-3">
                                <label>Mother image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="mother_img" id="mother_img"
                                    value="{{ $guardians->mother_img }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="guard_name" id="guard_name"
                                    value="{{ $guardians->guard_name }}" required>
                                <span id="guard_name_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian mobile<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="guard_mobile" id="guard_mobile"
                                    value="{{ $guardians->guard_mobile }}" required>
                                <span id="guard_mobile_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Guardian profession</label>
                                <input type="text" class="form-control" name="guard_prof" id="guard_prof"
                                    value="{{ $guardians->guard_prof }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian Image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="guard_img" id="guard_img"
                                    value="{{ $guardians->guard_img }}">
                                <span id="guard_img_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian email</label>
                                <input type="email" class="form-control" name="guard_email" id="guard_email"
                                    value="{{ $guardians->guard_email }}" required>

                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian address</label>
                                <input type="text" class="form-control" name="guard_address" id="guard_address"
                                    value="{{ $guardians->guard_address }}" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian Relation</label>
                                <input type="text" class="form-control" name="guard_rel" id="guard_rel"
                                    value="{{ $guardians->guard_rel }}" required>
                            </div>


                            <div class="col-md-3 ">
                                <label>Status</label> <br>
                                <select class="form-control js-example-basic-single" name="guard_status"
                                    id="guard_status" required>
                                    <option value="1" {{ $guardians->guard_status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $guardians->guard_status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary ">Submit</button>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    {{-- //gardian UPDATE --}}
    <script>
        $(document).ready(function() {
            $('#gaurdian_update').submit(function(e) {
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

                x = new FormData(document.getElementById("gaurdian_update"));
                let id = $(this).attr("gardian_id");
                $.ajax({
                    url: url + "/gaurdiansUpdate/" + id,
                    method: "POST",
                    // data: $(this).serialize(),
                    data: x,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/gaurdians/';
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
@endsection
