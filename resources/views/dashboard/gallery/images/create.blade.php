@extends('dashboard.master')

@section('title')
    Create Image
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Create Image</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Image
                        </li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Add New</a></li>
                    </ol>
                </div>
                <form action="" method="POST" id="image_insert" enctype="multipart/form-data">
                    <fieldset>
                        @csrf
                        {{-- //hidden id pass --}}
                        <input type="hidden" value="" name="id">
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="label_name">Gallery category<span class="text-danger">*</span></label><br>

                                <select required name="gallary_category_id" class="form-control inputs js-example-basic-single">
                                    <option value="">Select Category</option>
                                    @foreach ($GallaryCategoryies as $GallaryCategoryie)
                                        <option value="{{ $GallaryCategoryie->id }}">
                                            {{ $GallaryCategoryie->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="gallary_category_id_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Image (335 x 405 px)<span class="text-danger">*</span></label>
                                <input required type="file" name="image" class="form-control inputs">
                                <span id="image_error" class="error"></span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="label_name">Status <span class="text-danger">*</span></label>
                                <select required name="status" class="form-control inputs">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>
                        </div>


                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save px-1"></i>
                                Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


    {{-- add income_insert --}}
    <script>
        $(document).ready(function() {


            $('#image_insert').submit(function(e) {
                e.preventDefault();

                x = new FormData(document.getElementById("image_insert"));
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
                    url: "{{ route('image.store') }}",
                    method: "POST",
                    data: x,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {

                            alert('Add Successfully');
                            $('#image_insert')[0].reset();
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
