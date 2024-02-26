 @extends('dashboard.master')

@section('title')
Edit Role
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
    <form action="#" method="POST" class="row py-5" id="update_role_form" staff_id="{{ $permit['id'] }}">

        @csrf

        <div class="col-12 col-md-6">
            <!-- Name -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="role" class="form-label label_name">Name <span class="text-danger">*</span></label>
                    <input type="text" value="{{ $permit['role'] }}" class="form-control inputs" name="role" id="role" placeholder="Enter name" required>
                    <span id="role_error" class="error"></span>
                </div>
            </div>


            <!-- Status -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label for="role" class="form-label label_name">Status <span class="text-danger">*</span></label>
                    <select class="select2_states inputs" name="status" required>
                        <option value="1" {{ ($permit['status'] == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ ($permit['status'] == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <span id="status_error" class="error"></span>
                </div>
            </div>

        </div>


        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-primary float-end">Submit</button>

                    <table class="table table-striped table-bor">
                        <thead>
                            <tr>
                                <th scope="col" class="role_th text-dark">Module/Module Links</th>
                                <th scope="col" class="role_th text-dark">Permissions</th>
                            </tr>
                        </thead>
                        <tbody>


                        @foreach($permit as $hkey => $hval)
 
                                  
                                        
                        @endforeach

                            <!-- Module & Permissions -->
                            @foreach ($data as $module => $permissions)
                            <tr>
                                <td class="role_title">{{ $module }}</td>
                                <td>
                                    @foreach ($permissions as $key => $permission)

                                        

                                    <div class="form-check role_p">
                                        <input class="form-check-input" name="{{ $module}}[]" type="checkbox" value="{{ $permission }}" id="{{ $module}}{{ $permission }}"

                                        
                                        
                                        @foreach($permit as $keys => $p_value)
                                            @php                                         
                                
                                                if($keys == 'rolepermission') {
                                                    
                                                    foreach($p_value as $pkey => $pvalue) {
                                                        
                                                        if($pvalue['module_name'] == $module) {                                     $pData = explode(',', $pvalue['permissions']);                                                           
                                                            foreach($pData as $pDataKey => $pDataValue) {
                                                 
                                                               echo ($permission == $pData[$pDataKey]) ? 'checked' : '';
                                                                                      
                                                            }   
                                                        }
                                                    }   
                                                }                                            

                                            @endphp                                 
                                        @endforeach
                                        
                                        >                                        
                                        
                                        <label class="label form-check-label" for="{{ $module}}{{ $permission }}">
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

        // Update Data to DB
        $('#update_role_form').submit(function(e) {
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

            var id = $(this).attr('staff_id');
            var url = '{{ route("staff-role.update", ":id") }}';
            url = url.replace(":id", id);

            if (isValid) {
                $.ajax({
                    url: url,
                    type: "PUT",
                    dataType: "json",
                    data: $(this).serialize(),
                    success: function(data) {

                        if (data.success == true) {
                            alert('Role update successfully');
                            // $('#update_role_form')['0'].reset();
                        } else {
                            for (const key in data.errors) {
                                errorContainer = $('#' + key + '_error');
                                errorContainer.text(data.errors[key][0]);
                            }
                        }
                    }

                })
            }
        });

    })
</script>
<!-- End Role AJAX -->
@endsection