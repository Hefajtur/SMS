@extends('dashboard.master')

@section('title')
Create Book Category
@endsection

<!-- Create Department area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Book Category</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('book-category.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('book-category.index') }}">Create Book Category</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="create_bookCategory_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Book Category Name -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="book_cat_name" value="{{ old('name') }}" id="name" placeholder="Enter name" required>

                        <span id="book_cat_name_error" class="error"></span>

                    </div>
                </div>


                <!-- Book Category Status -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <p class="label_name">Status <span class="text-danger fillable">*</span></p>
                        <select required class="select2_states" name="status" id="select2_states">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>


<!-- End Page Content -->


<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        // Add Data to DB
        $('#create_bookCategory_form').submit(function(e) {
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
                url: "{{ route('book-category.store') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#create_bookCategory_form')[0].reset();
                        alert('Book category added Successfully');
                    }
                },
                error: function(data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            })
            }
        });

    });
</script>
<!-- End Department AJAX -->
@endsection