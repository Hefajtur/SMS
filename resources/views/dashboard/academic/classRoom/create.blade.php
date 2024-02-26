@extends('dashboard.master')

@section('title')
    Create ClassRoom
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Create Class Room</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Class Room</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Add New</li>
                    </ol>
                </div>
                <form action="" method="POST" id="classRoom_insert">
                    <fieldset>
                        @csrf

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label>Room No<span class="text-danger">*</span></label>
                                <input type="number" required class="form-control" name="room_no" id="room_no">
                                <span id="room_no_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Capacity<span class="text-danger">*</span></label>
                                <input type="number" required class="form-control" name="capacity" id="capacity">
                                <span id="capacity_error" class="error"></span>
                            </div>                         
                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required class="form-control js-example-basic-single" id="ClassRoom_status">
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
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

   {{-- add timeSchedule --}}

    <script>
        $('#classRoom_insert').validate();

        $(document).ready(function() {

            $('#classRoom_insert').submit(function(e) {
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
                    url: "{{ route('classRoom.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            alert('Add Successfully');
                            $('#classRoom_insert')[0].reset();
                        }
                    },error: function(data, textStatus, errorMessage) {
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
