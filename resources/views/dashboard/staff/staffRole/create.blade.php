@extends('dashboard.master')

@section('title')
Create Role
@endsection

<!-- Create Role area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Role</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('staff-role.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff-role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add data</li>

                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->

    <!-- Page Content -->
    <form action="#" method="POST" class="row py-5" id="create_role_form">

        @csrf

        <div class="col-12 col-md-6">
            <!-- Name -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="staffID" class="form-label label_name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control inputs" name="role" id="role" placeholder="Enter name" required>
                    <span id="role_error" class="error"></span>
                </div>
            </div>


            <!-- Status -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="staffID" class="form-label label_name">Status <span class="text-danger">*</span></label>
                    <select class="select2_states" name="status" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span id="status_error" class="error"></span>
                </div>
            </div>

        </div>


        <!-- Module & Permissions -->
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-primary float-end">Submit</button>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="role_th text-dark">Module/Module Links</th>
                                <th scope="col" class="role_th text-dark">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>



                            <!-- Module & Permissions Content -->
                            @foreach ($rolePermissions as $module => $permissions)
                            <tr class="staff_role_tr">
                                <td class="module_title">{{ $module }}</td>

                                <td class="permission_title">
                                    @foreach ($permissions as $key => $permission)

                                    <div class="form-check role_p d-flex justify-content-between align-items-center">
                                        <input class="form-check-input inputs" name="{{ $module}}[]" type="checkbox" value="{{ $permission }}" id="{{ $module . '_' . $key }}">

                                        <label class="label form-check-label" for="{{ $module . '_' . $key }}">
                                            {{ $key }}
                                        </label>

                                    </div>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <button class="btn btn-primary float-end">Submit</button>

    </form>
    <!-- End Page Content -->


</div>


<!-- Role AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // Add Data to DB
        $('#create_role_form').submit(function(e) {
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
                    url: "{{ route('staff-role.store') }}",
                    type: "POST",
                    dataType: "json",
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success == true) {
                            alert('Role added successfully');
                            $('#create_role_form')['0'].reset();
                        } 
                    
                    },
                    error: function(data, textStatus, errorMessage) {
                        // console.log(data);
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
<!-- End Role AJAX -->
@endsection