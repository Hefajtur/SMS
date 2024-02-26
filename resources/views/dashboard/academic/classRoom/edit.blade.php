@extends('dashboard.master')

@section('title')
    Edit TimeSchedule
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Class Room</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit Class Room</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="classRoom_update" classRoom_id="{{ $classRoom->id }}">
                    <fieldset>
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label>Room No<span class="text-danger">*</span></label>
                                <input type="number" required class="form-control" value="{{$classRoom->room_no}}"
                                 name="room_no" id="room_no">
                                <span id="room_no_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Capacity<span class="text-danger">*</span></label>
                                <input type="number" required class="form-control" value="{{$classRoom->capacity}}"
                                 name="capacity" id="capacity">
                                <span id="capacity_error" class="error"></span>
                            </div>                         
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required class="form-control js-example-basic-single" id="ClassRoom_status">
                                    <option value="0" {{$classRoom->status == 0 ? 'selected':''}}>Active</option>
                                    <option value="1" {{$classRoom->status == 1 ? 'selected':''}}>Inactive</option>
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
{{-- //ClassRoom update --}}

    <script>
        $('#classRoom_update').validate();

        $(document).ready(function() {

            $('#classRoom_update').submit(function(e) {
                e.preventDefault();
                let id = $(this).attr("classRoom_id");
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
                    url: url + "/classRoom/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/classRoom';
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
