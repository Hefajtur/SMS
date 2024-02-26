@extends('dashboard.master')

@section('title')
Create Book
@endsection

<!-- Create Department area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Book</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Create Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="create_book_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Book Category -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="book_category_id" class="form-label label_name">Book Category <span class="text-danger fillable">*</span></label>

                        <select required class="form-select w-100 inputs" name="book_category_id" id="book_category_id ">
                            <option selected>Select Catetory</option>
                            @foreach($bookCats as $bookCat)
                            <option value="{{ $bookCat->id }}">{{ $bookCat->book_cat_name }}</option>
                            @endforeach
                        </select>

                        <span id="book_cat_error" class="error"></span>

                    </div>
                </div>


                <!-- Name -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="name" value="{{ old('name') }}" id="name" placeholder="Enter name" required>

                        <span id="name_error" class="error"></span>

                    </div>
                </div>


                <!-- Code -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="code" class="form-label label_name">Code <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="code" value="{{ old('code') }}" id="code" placeholder="Enter code" required>

                        <span id="code_error" class="error"></span>

                    </div>
                </div>


                <!-- Publisher name -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="publisher_name" class="form-label label_name">Publisher name <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="1" name="publisher_name" value="{{ old('publisher_name') }}" id="publisher_name" placeholder="Enter publisher name" required>

                        <span id="publisher_name_error" class="error"></span>

                    </div>
                </div>


                <!-- Author name -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="author_name" class="form-label label_name">Author name <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="1" name="author_name" value="{{ old('author_name') }}" id="author_name" placeholder="Enter author name" required>

                        <span id="author_name_error" class="error"></span>

                    </div>
                </div>


                <!-- Rack Number -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="rack_number" class="form-label label_name">Rack Number <span class="text-danger fillable">*</span></label>

                        <input required type="number" class="form-control inputs" minlength="1" name="rack_no" value="{{ old('rack_no') }}" id="rack_no" placeholder="Enter rack number" required>

                        <span id="rack_no_error" class="error"></span>

                    </div>
                </div>


                <!-- Price -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="price" class="form-label label_name">Price <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="1" name="price" value="{{ old('price') }}" id="price" placeholder="Enter price" required>

                        <span id="price_error" class="error"></span>

                    </div>
                </div>


                <!-- Quantity -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="quantity" class="form-label label_name">Quantity <span class="text-danger fillable">*</span></label>

                        <input required type="number" class="form-control inputs" minlength="1" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="Enter quantity" required>

                        <span id="quantity_error" class="error"></span>

                    </div>
                </div>


                <!-- Status -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="select2_states" class="form-label label_name">Status <span class="text-danger fillable">*</span></label>

                        <select required class="select2_states inputs" name="status" id="select2_states">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                        <span id="status_error" class="error"></span>

                    </div>
                </div>


                <!-- Description -->
                <div class="col-12 col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label label_name">Description</label>

                        <div class="form-group">
                            <textarea name="description" rows="4" required class="form-control inputs" id="description"></textarea>
                        </div>

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
    $('#create_book_form').validate();

    $(document).ready(function() {
        // Add Data to DB
        $('#create_book_form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('book.store') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#create_book_form')[0].reset();
                        alert('Book added Successfully');
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
        });

    });
</script>
<!-- End Department AJAX -->
@endsection