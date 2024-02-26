@extends('dashboard.master')

@section('title')
Create Issue Book
@endsection

<!-- Create Issue Book area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Issue Book</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('issue-book.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('issue-book.index') }}">Create Issue Book</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="issue_book_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Select Book -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="issue_book" class="form-label label_name">Select book <span class="text-danger fillable">*</span></label>

                        <select class="form-select w-100 inputs" required name="issue_book" id="issue_book">
                            <option selected>Select Book</option>
                            @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                            @endforeach
                            
                        </select>
                        <span id="issue_book_error" class="error"></span>

                    </div>
                </div>


                <!-- Select member -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="issue_book_member" class="form-label label_name">Select member <span class="text-danger fillable">*</span></label>

                        <select class="form-select w-100 inputs" required name="issue_book_member" id="issue_book_member">
                            <option selected>Select Book</option>
                            @foreach($members as $member)
                            <option value="{{ $member->user_id }}">{{ $member->user->name }}</option>
                            @endforeach
                        </select>

                        <span id="issue_book_member_error" class="error"></span>

                    </div>
                </div>


                <!-- Issue date -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="issue_date" class="form-label label_name">Issue date <span class="text-danger fillable">*</span></label>

                        <input type="date" required class="form-control inputs" minlength="3" name="issue_date" value="" id="issue_date" placeholder="Enter issue_date" required>

                        <span id="issue_date_error" class="error"></span>

                    </div>
                </div>


                <!-- Return date -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="return_date" class="form-label label_name">Return date <span class="text-danger fillable">*</span></label>

                        <input type="date" required class="form-control inputs" minlength="1" name="return_date" value="" id="return_date" placeholder="Enter publisher name" required>

                        <span id="return_date_error" class="error"></span>

                    </div>
                </div>


                <!-- Phone -->
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label label_name">Phone <span class="text-danger fillable">*</span></label>

                        <input type="tel" required class="form-control inputs" minlength="1" name="phone" value="" id="phone" placeholder="Enter phone" required>

                        <span id="phone_error" class="error"></span>

                    </div>
                </div>               


                <!-- Description -->
                <div class="col-12 col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label label_name">Description</label>

                        <div class="form-group">
                            <textarea name="description" required rows="4" class="form-control inputs" id="description"></textarea>
                        </div>

                        <!-- <span id="description_error" class="error"></span> -->

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
    $('#issue_book_form').validate();

    $(document).ready(function() {
        // Add Data to DB
        $('#issue_book_form').submit(function(e) {
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
                url: "{{ route('issue-book.store') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#issue_book_form')[0].reset();
                        alert('Book issued Successfully');
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