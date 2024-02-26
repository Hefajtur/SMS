@extends('dashboard.master')

@section('title')
    Create Gaurdian
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <form action="" method="POST" id="gaurdian_insert" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Father Name</label>
                                <input type="text" class="form-control" name="fath_name" id="fath_name" required>
                                {{-- hidden id pass --}}
                                <input type="hidden" value="" name="id">
                                <span id="fath_name_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father Mobile</label>
                                <input type="number" class="form-control" name="fath_mobile" id="fath_mobile" required>
                                <span id="fath_mobile_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father profession</label>
                                <input type="text" class="form-control" name="fath_prof" id="fath_prof" required>
                                <span id="fath_prof_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Father image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="fath_img" id="fath_img" required>
                                <span id="fath_img_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Mother Name</label>
                                <input type="text" class="form-control" name="mother_name" id="mother_name" required>
                                <span id="mother_name_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Mother Mobile</label>
                                <input type="number" class="form-control" name="mother_mobile" id="mother_mobile" required>
                                <span id="mother_mobile_error" class="error"></span>
                            </div>

                            {{-- class --}}
                            <div class="col-md-3 mb-3">
                                <label>Mother profession</label>
                                <input type="text" class="form-control" name="mother_prof" id="mother_prof" required>
                                <span id="mother_prof_error" class="error"></span>
                            </div>

                            {{-- Section --}}
                            <div class="col-md-3 mb-3">
                                <label>Mother image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="mother_img" id="mother_img" required>
                                <span id="mother_img_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="guard_name" id="guard_name" required>
                                <span id="guard_name_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian mobile <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="guard_mobile" id="guard_mobile" required>
                                <span id="guard_mobile_error" class="error"></span>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Guardian profession</label>
                                <input type="text" class="form-control" name="guard_prof" id="guard_prof" required>
                                <span id="guard_prof_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian Image (95 x 95 px)</label>
                                <input type="file" class="form-control" name="guard_img" id="guard_img" required>
                                <span id="guard_img_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian email</label>
                                <input type="email" class="form-control" name="guard_email" id="guard_email" required>
                                <span id="guard_email_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian address</label>
                                <input type="text" class="form-control" name="guard_address" id="guard_address" required>
                                <span id="guard_address_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Guardian Relation</label>
                                <input type="text" class="form-control" name="guard_rel" id="guard_rel" required>
                                <span id="guard_rel_error" class="error"></span>
                            </div>


                            <div class="col-md-3 ">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control js-example-basic-single" name="guard_status"
                                    id="guard_status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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

    {{-- //add gaurdian  --}}
    <script>
        $(document).ready(function() {

            $('#gaurdian_insert').submit(function(e) {
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

                x = new FormData(document.getElementById("gaurdian_insert"));
                $.ajax({
                    url: "{{ route('gaurdians.store') }}",
                    method: "POST",
                    data: x,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            alert('Add Successfully');
                            $('#gaurdian_insert')[0].reset();
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
