@extends('dashboard.master')

@section('title')
    Edit Section
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Section</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit Section</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="section_update" section_id="{{ $section->id }}">
                    <fieldset>
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="name" id="name"
                                    value="{{ $section->name }}">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Class</label>
                                <select name="class_id" required class="form-control" id="class_id">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ $section->class_id == $class->id ? 'selected' : ''}}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 ">
                                <label>Status</label><br>
                                <select name="status" required class="form-control" id="section_status">
                                    <option value="1" {{ $section->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $section->status == 0 ? 'selected' : '' }}>Inactive</option>
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

    {{-- update section --}}

    <script>
        $(document).ready(function() {
            $('#section_update').submit(function(e) {
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
        
        let id = $(this).attr("section_id");
                $.ajax({
                    url: url + "/section/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/section';
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
