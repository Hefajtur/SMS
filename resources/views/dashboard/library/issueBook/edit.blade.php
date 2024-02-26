@extends('dashboard.master')

@section('title')
Edit issue book
@endsection

<!-- Create Book  area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Issue Book</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('issue-book.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('issue-book.index') }}">Edit Issue Book </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="update_issueBook_form" issueBook_id="{{ $edit_data->id }}">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Select Book -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="issue_book" class="form-label label_name">Select book <span class="text-danger fillable">*</span></label>

                    <select required class="form-select w-100 inputs" name="issue_book" id="issue_book">
                        <option selected>Select Book</option>
                        @foreach($books as $book)
                        <option value="{{ $book->id }}" {{ ($book->id == $edit_data->issue_book) ? 'selected' : '' }}>{{ $book->name }}</option>
                        @endforeach

                    </select>
                    <span id="issue_book_error" class="error"></span>

                </div>


                <!-- Select member -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="issue_book_member" class="form-label label_name">Select member <span class="text-danger fillable">*</span></label>

                    <select required class="form-select w-100 inputs" name="issue_book_member" id="issue_book_member">
                        <option selected>Select Book</option>
                        @foreach($members as $member)
                        <option value="{{ $member->user_id }}" {{ ($member->user_id == $edit_data->issue_book_member) ? 'selected' : '' }}>{{ $member->user->name }}</option>
                        @endforeach
                    </select>

                    <span id="issue_book_member_error" class="error"></span>

                </div>


                <!-- Issue date -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="issue_date" class="form-label label_name">Issue date <span class="text-danger fillable">*</span></label>

                    <input required type="date" class="form-control inputs" minlength="3" name="issue_date" value="{{ $edit_data->issue_date }}" id="issue_date" required>

                    <span id="issue_date_error" class="error"></span>


                </div>


                <!-- Return date -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="return_date" class="form-label label_name">Return date <span class="text-danger fillable">*</span></label>

                    <input required type="date" class="form-control inputs" minlength="1" name="return_date" value="{{ $edit_data->return_date }}" id="return_date" required>

                    <span id="return_date_error" class="error"></span>

                </div>


                <!-- Phone -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="phone" class="form-label label_name">Phone <span class="text-danger fillable">*</span></label>

                    <input required type="tel" class="form-control inputs" minlength="1" name="phone" value="{{ $edit_data->phone }}" id="phone" placeholder="Enter phone number" required>

                    <span id="phone_error" class="error"></span>

                </div> 


                <!-- Status -->
                <div class="col-12 col-md-6 mb-3">

                    <label for="statuss" class="form-label label_name">Status <span class="text-danger fillable">*</span></label>

                    <select required class="form-select w-100 inputs" name="status" id="statuss">
                        <option value="1" {{ ($edit_data->status == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ ($edit_data->status == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <span id="status_error" class="error"></span>

                </div>


                <!-- Description -->
                <div class="col-12 col-md-12 mb-3">

                    <label for="description" class="form-label label_name">Description</label>

                    <div class="form-group">
                        <textarea required name="description" rows="4" class="form-control inputs" id="description">{{ $edit_data->description }}</textarea>
                    </div>

                    <!-- <span id="description_error" class="error"></span> -->

                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12">
                    <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                </div>
            </div>
        </fieldset>


    </form>
    <!-- End Page Content -->


</div>
<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#update_issueBook_form').validate();

    $(document).ready(function() {


        // Update Data
        $('#update_issueBook_form').submit(function(e) {
            e.preventDefault();
            let id = $(this).attr('issueBook_id');
            var url = '{{ route("issue-book.update", ":id") }}';
            url = url.replace(':id', id);

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

                url: url,
                type: "PUT",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {

                    if (data.success == true) {
                        alert('Issue book updated Successfully');
                        window.location.href = "{{route('issue-book.index')}}";

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