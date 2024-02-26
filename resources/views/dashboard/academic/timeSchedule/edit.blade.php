@extends('dashboard.master')

@section('title')
    Edit TimeSchedule
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <h3>Edit Time Schedule</h3>
                <h5>Home / Edit Time Schedule / Edit</h5>
                <form action="" method="POST" id="timeSchedule_update" timeSchedule_id="{{ $timeSchedule->id }}">
                    <fieldset>
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label>Type <span class="text-danger">*</span></label>
                                <select name="type" required class="form-control js-example-basic-single" id="type">
                                    <option value="Class" {{ $timeSchedule->type == "Class" ? 'selected' : '' }}>Class</option>
                                    <option value="Exam" {{ $timeSchedule->type == "Exam" ? 'selected' : '' }}>Exam</option>
                                </select>
                            </div>

                            <div class="col-md-6 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required class="form-control js-example-basic-single" id="timeSchedule_status">
                                    <option value="1" {{ $timeSchedule->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $timeSchedule->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                          
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Start Time<span class="text-danger">*</span></label>
                                <input type="time" required class="form-control" value="{{$timeSchedule->start_time}}"
                                 name="start_time" id="start_time">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>End Time<span class="text-danger">*</span></label>
                                <input type="time" required class="form-control" value="{{$timeSchedule->end_time}}"
                                 name="end_time" id="end_time">
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
{{-- //timeSchedule update --}}

    <script>

        $(document).ready(function() {

            $('#timeSchedule_update').submit(function(e) {
                e.preventDefault();
                let id = $(this).attr("timeSchedule_id");
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
                    url: url + "/timeSchedule/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/timeSchedule';
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
