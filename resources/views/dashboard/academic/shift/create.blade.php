@extends('dashboard.master')

@section('title')
    Create Shift
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Create Shift</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Shift</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Add New</li>
                    </ol>
                </div>
                <form action="" method="POST" id="shift_insert">
                    <fieldset>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="name" id="name" required
                                    minlength="3">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label>Status</label><br>
                                <select name="status" required class="form-control" id="shift_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
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

   {{-- add section --}}

    <script>
        $('#shift_insert').validate();

        $(document).ready(function() {

            $('#shift_insert').submit(function(e) {
                e.preventDefault();

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
                    url: "{{ route('shift.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            alert('Add Successfully');
                            $('#shift_insert')[0].reset();
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
