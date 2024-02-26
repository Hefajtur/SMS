@extends('dashboard.master')

@section('title')
Edit Member
@endsection

<!-- Create Book  area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">
            <div class="page_hading_bredcrumb">
                <h2>Book </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Edit Book </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="card" id="update_member_form" member_id="{{ $members->id }}">
        <fieldset>
            @csrf
            <div class="inputs_data row card-body py-5">

                <!-- Select Member -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member" class="form-label label_name">Select member <span class="text-danger fillable">*</span></label>

                        <select required class=" form-select w-100 inputs" name="user_id" id="member ">
                            <option selected>Select Member</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ ($user->id == $members->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach

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
                            <option value="{{ $member_cat->id }}" {{ ($member_cat->id == $members->member_category_id) ? 'selected' : '' }}>{{ $member_cat->member_cat_name }}</option>
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

                            <option value="1" {{ ($members->status == 1) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ ($members->status == 0) ? 'selected' : '' }}>Inactive</option>

                        </select>

                        <span id="member_cat_error" class="error"></span>

                    </div>
                </div>


                <!-- Phone -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member_phone" class="form-label label_name">Phone <span class="text-danger fillable">*</span></label>

                        <input required type="tel" class="form-control inputs" minlength="3" name="member_phone" value="{{ $members->phone }}" id="member_phone" placeholder="Enter Phone" required>

                        <span id="member_phone_error" class="error"></span>

                    </div>
                </div>


                <!-- Email -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member_email" class="form-label label_name">Email <span class="text-danger fillable">*</span></label>

                        <input required type="text" class="form-control inputs" minlength="3" name="member_email" value="{{ $members->email }}" id="member_email" placeholder="Enter Email" required>

                        <span id="member_email_error" class="error"></span>

                    </div>
                </div>


                <!-- Gender -->
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="member_gender" class="form-label label_name">Gender <span class="text-danger fillable">*</span></label>

                        <select required class=" form-select w-100 inputs" name="member_gender" id="member_gender">

                            @foreach($genders as $gender)
                            <option value="{{ $gender->id }}" {{ ($gender->id == $members->gender) ? 'selected' : '' }}>{{ $gender->name }}</option>
                            @endforeach


                        </select>

                        <span id="member_cat_error" class="error"></span>

                    </div>
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
    $('#update_member_form').validate();

    $(document).ready(function() {


        // Update Data
        $('#update_member_form').submit(function(e) {
            e.preventDefault();

            // alert('clicked');

            let id = $(this).attr('member_id');
            var url = '{{ route("member.update", ":id") }}';
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
                        // $('#update_member_form')['0'].reset();
                        alert('Member updated Successfully');

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