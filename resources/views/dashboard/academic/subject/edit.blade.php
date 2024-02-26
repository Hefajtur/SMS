@extends('dashboard.master')

@section('title')
    Edit Subject
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Subject</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit Subject</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="subject_update" subject_id="{{ $subject->id }}">
                    <fieldset>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="name" id="name"
                                    value="{{ $subject->name }}">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label>Code <span class="text-danger">*</span></label><br>
                                <input type="number" required class="form-control" name="code" id="code"
                                value="{{ $subject->code }}">
                                <span id="code_error" class="error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Type <span class="text-danger">*</span></label>
                                <select name="type" required class="form-control" id="type">
                                    <option value="0" {{ $subject->type == 0 ? 'selected' : '' }}>Theory</option>
                                    <option value="1" {{ $subject->type == 1 ? 'selected' : '' }}>Practical</option>
                                </select>
                            </div>

                            <div class="col-md-6 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required class="form-control" id="type_status">
                                        <option value="1" {{ $subject->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $subject->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save px-1"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#subject_update').submit(function(e) {
                e.preventDefault();
                let id = $(this).attr("subject_id");
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
                    url: url + "/subject/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/subject';
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
