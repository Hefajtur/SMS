@extends('dashboard.master')

@section('title')
    Edit GalleryCategory
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Gallery Category</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Edit Gallery Category
                        </a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                <form action="" method="POST" id="galleryCategory_update" galleryCategory_id="{{ $gallaryCategory->id }}">
                    <fieldset>
                        @csrf

                        <div class="row mt-2">
                            <div class="col-md-6 mb-3 ">
                                <label class="label_name">Name <span class="text-danger">*</span></label>
                                <input required type="text" class="form-control inputs" name="name" 
                                    value="{{ $gallaryCategory->name }}">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Status</label><br>
                                <select required name="status" class="form-control inputs" id="incomeexpense_status">
                                    <option value="1" {{ $gallaryCategory->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $gallaryCategory->status == 0 ? 'selected' : '' }}>Inactive</option>
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

    {{-- update class --}}

    <script>
        $(document).ready(function() {

            $('#galleryCategory_update').submit(function(e) {
                e.preventDefault();
                let id = $(this).attr("galleryCategory_id");
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
                    url: url + "/galleryCategory/" + id,
                    method: "PUT",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Update Successfully');
                            window.location.href = url + '/galleryCategory';
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
