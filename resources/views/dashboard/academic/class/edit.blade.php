@extends('dashboard.master')

@section('title')
Edit Class
@endsection

@section('body')
{{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Class Edit</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Class Edit</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="class_update" class_id="{{ $classes->id }}">
                    <fieldset>
                        @csrf

                        <div class="row mt-2">
                            <div class="col-md-6 mb-3 ">
                                <label class="label_name">Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control inputs" name="name" id="name"
                                    value="{{ $classes->name }}">
                                <span id="name_error" class="error"></span>
                                <p id="Class_name_error" class="text-danger"></p>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Status</label><br>
                                <select name="status" required class="form-control js-example-basic-single inputs"
                                    id="class_status">
                                    <option value="1" {{ $classes->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $classes->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg"><i
                                    class="fa-solid fa-save px-1"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


    <script>


        $(document).ready(function () {

            $('#class_update').submit(function (e) {
                e.preventDefault();
                let id = $(this).attr("class_id");
                // alert('hi');
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
                        url: url + "/class/" + id,
                        method: "PUT",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (response) {

                            if (response.success == true) {
                                alert('Update Successfully');
                                window.location.href = url + '/class';
                            }
                        },
                        error: function (data, textStatus, errorMessage) {
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