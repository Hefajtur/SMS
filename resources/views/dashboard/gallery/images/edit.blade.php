@extends('dashboard.master')

@section('title')
    Edit Image
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Image</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Image
                        </a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="image_update" Image_id="{{ $gallary->id }}">
                    <fieldset>
                        @csrf

                          {{-- hidden id  --}}
                          <input type="hidden" value="{{ $gallary->id }}" name="id"> 

                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="label_name">Gallery category<span class="text-danger">*</span></label><br>
                                <select required name="gallary_category_id" class="form-control inputs js-example-basic-single">
                                    <option value="{{ $gallary->gallaryCategory->id }}">{{ $gallary->gallaryCategory->name }}
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
                                <input  type="file" name="image" class="form-control inputs" value="{{$gallary->image}}">
                                <span id="image_error" class="error"></span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="label_name">Status <span class="text-danger">*</span></label>
                                <select required name="status" class="form-control inputs">
                                    <option value="1" {{ $gallary->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $gallary->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>
                        </div>


                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save px-1"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- update class --}}

    <script>
        $(document).ready(function() {

            $('#image_update').submit(function(e) {
                e.preventDefault();
                x = new FormData(document.getElementById("image_update"));
                let id = $(this).attr("Image_id");
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
                    url: url + "/imageUpdate/" + id,
                    method: "POST",
                    data: x,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/image';
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
