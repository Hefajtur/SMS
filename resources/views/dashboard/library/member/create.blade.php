@extends('dashboard.master')

@section('title')
Create Member
@endsection

<!-- Create Department area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Create Member</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Create Member</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="create_member_form">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Select Member -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member" class="form-label label_name">Select member <span class="text-danger fillable">*</span></label>

                        <select required class="form-select w-100 inputs" name="user_id" id="member">
             
                        </select>

                        <span id="user_id_error" class="error"></span>

                    </div>
                </div>

                <!-- Member Category -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member_cat" class="form-label label_name">Member category <span class="text-danger fillable">*</span></label>

                        <select required class=" form-select w-100 inputs" name="member_cat" id="member_cat ">
                            <option selected>Select category</option>

                            @foreach($member_cats as $member_cat)
                            <option value="{{ $member_cat->id }}">{{ $member_cat->member_cat_name }}</option>
                            @endforeach

                        </select>

                        <span id="member_cat_error" class="error"></span>

                    </div>
                </div>


                <!-- Status -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member_status" class="form-label label_name">Status <span class="text-danger fillable">*</span></label>

                        <select required class=" form-select w-100 inputs" name="status" id="member_status">

                            <option value="1">Active</option>
                            <option value="0">Inactive</option>

                        </select>

                        <span id="member_cat_error" class="error"></span>

                    </div>
                </div>


                <!-- Submit button -->
                <div class="col-12 col-md-12 mt-4">
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#create_member_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#create_member_form').submit(function(e) {
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
                url: "{{ route('member.store') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        $('#create_member_form')[0].reset();
                        alert('Member added Successfully');
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

        // $('#member').on('change', function() {
        //     console.log($(this).val());
        // });

        $('#member').select2({
            placeholder: 'Select a member',
            ajax: {
                url: "{{ route('getAllMember') }}",
                dataType: 'json',
                delay: 250,
                method: "GET",
                processResults: function(data) {
                    return {
                        results: data
                    }
                },
                cache: false
            },
        });





    });
</script>
<!-- End Department AJAX -->
@endsection