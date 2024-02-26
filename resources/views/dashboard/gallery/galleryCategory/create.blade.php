@extends('dashboard.master')

@section('title')
    Create GalleryCategory
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Create Gallery Category</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Create Gallery Category
                        </li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Add New</a></li>
                    </ol>
                </div>
                <form action="" method="POST" id="galleryCategory_insert">
                    <fieldset>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="label_name">Name <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control inputs" name="name" id="name">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Status <span class="text-danger">*</span></label><br>
                                <select name="status" required class="form-control inputs" id="class_status"
                                    name="state">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>

                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save px-1"></i>
                                Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- add galleryCategory_insert --}}

    <script>
       
                $(document).ready(function() {

                    $('#galleryCategory_insert').submit(function(e) {
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
                            url: "{{ route('galleryCategory.store') }}",
                            method: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {
                                    alert('Add Successfully');
                                    $('#galleryCategory_insert')[0].reset();
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
