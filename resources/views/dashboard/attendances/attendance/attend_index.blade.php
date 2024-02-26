@extends('dashboard.master')

@section('title')
Attendance
@endsection

<!-- Attendance area -->
@section('body')
<div class="container py-5 px-5">

    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Attendance</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Filter Area -->
    <div class="row card">
        <div class="col-12 col-md-12 px-0">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-2 mb-4">
                <h2 class="text-dark">Filtering</h2>
                <div class="alert alert-danger" id="not_found" role="alert"></div>
            </div>
            <!-- End Header -->

            <!-- Filter Area -->
            <form action="#" method="" class="card-body" id="attendance_filter">

                <fieldset>
                    @csrf
                    <div class="row justify-content-end inputs_data pb-5">

                        <!-- Select Class-->
                        <div class="col-12 col-md-3 mb-3">
                            <select class="inputs w-100" id="classes" name="select_class" id="select_class">
                                <option selected>Select class</option>
                                @foreach($classData as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <span id="select_class_error" class="error"></span>
                        </div>

                        <!-- Select Section-->
                        <div class="col-12 col-md-3 mb-3">
                            <select class="select2_states inputs w-100" id="sections" name="select_section">
                                <option>Select Section</option>
                            </select>
                            <span id="select_section_error" class="error"></span>
                        </div>

                        <!-- Select Date-->
                        <div class="col-12 col-md-3 mb-3">
                            <input type="date" name="attendanceDate" value="{{ date('Y-m-d') }}" class="form-control inputs">
                            <span id="attendanceDate_error" class="error"></span>
                        </div>

                        <!-- Submit button -->
                        <div class="ml-2 mr-3">
                            <button class="btn btn-primary float-right inputs">Search</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- End Filter Area -->


    <!-- Attendance Details -->
    <div class="row justify-content-end inputs_data card pb-5" id="attendance_deatils" style="display: none;">
        <div class="col-12 col-md-12">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-2 mb-0 border-bottom">
                <h2 class="text-dark">Attendace</h2>
            </div>
            <!-- End Header -->

            <!-- Attendance Search Result -->
            <form action="#" method="POST" class="card-body" id="attendance_filter_result">

                <fieldset>
                    @csrf
                    <div class="table-responsive">

                        <!-- Checkbox -->
                        <div class="checkbox mb-4">
                            <div class="form-check">
                                <input class="form-check-input" id="holiday" type="checkbox" value="" id="defaultCheck1">

                                <input type="hidden" name="attendanceDate" id="attendanceDate">

                                <label class="form-check-label holiday_title" for="holiday">
                                    Holiday
                                </label>
                            </div>
                        </div>

                        <!-- Filter Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Student name</th>
                                        <th scope="col">Roll NO</th>
                                        <th scope="col">Admission NO</th>
                                        <th scope="col">Class (Section)</th>
                                        <th scope="col">Attendance</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="filter_result">

                                </tbody>
                            </table>
                        </div>


                        <!-- Submit button -->
                        <div class="ml-2 mt-5">
                            <button class="btn btn-primary float-right p-3">Submit</button>
                        </div>

                    </div>

                </fieldset>
            </form>
        </div>

        <!-- End Attendance Search Result -->
    </div>



    <!-- End Attendance Details -->

</div>



<!-- Attendance AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#attendance_form').validate();

    $(document).ready(function() {

        // Add Data to DB
        $('#attendance_form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('attendance.index') }}",
                type: "GET",
                data: $(this).serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success == true) {
                        alert('Success');
                    } else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                }
            })
        });



        // Select Class
        $(document).on('change', '#classes', function() {
            var classId = $(this).val();
            // console.log(classId);
            $.ajax({
                url: "{{ url('/attendance-section') }}/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    var option = '';
                    option += '<option selected disabled>Select Section</option>';

                    for (const key in data) {
                        option += "<option value=" + data[key]['id'] + ">" + data[key][
                            'name'
                        ] + '</option>';
                    };

                    // console.log(option);
                    $('#sections').empty().append(option);

                },
            })
        })



        // Select Section For get Student
        // $(document).on('change', '#sections', function() {
        //     var classId = $(this).val();
        //     // console.log(classId);
        //     $.ajax({
        //         url: "{{url('/attendance-student')}}/" + classId,
        //         method: "GET",
        //         dataType: "JSON",
        //         success: function(data) {
        //             console.log(data);
        //             var option = '';
        //             option += '<option selected disabled>Select Student</option>';

        //             for (const key in data) {
        //                 option += "<option value=" + data[key]['id'] + ">" + data[key]['first_name'] + ' ' + data[key]['last_name'] + '</option>';

        //                 $('#students').empty().append(option);
        //             };

        //         },
        //     })
        // })

        // Filter Data Not found alert
        $("#not_found").css('display', 'none');

        
        // Attendance Filter Result
        $('#attendance_filter').submit(function(e) {
            e.preventDefault();
            
            $('input[type="radio"]').prop('checked', true);  

            $(document).on('click', '#holiday', function() {

                let holidayCheck = $('#holiday');
                

                if(holidayCheck.prop('checked') == true) {

                    $('#holiday').attr('checked', 'checked');
                    $('input[type="radio"]').prop('checked', false);

                }else {
                    $('#holiday').removeAttr('checked', 'checked');
                    $('input[type="radio"]').prop('checked', true);
                }

            });

            $("#studentFilter").html('');
            $.ajax({
                url: "{{ route('attendance.studentFilter') }}",
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    var x = response.success;
                    var y = response.attendance;

                    var status = '';

                    for (j = 0; j < y.length; j++) {
                        status += '<ul class="attnd_item d-flex justify-content-start align-items-start"><li><div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="attendType" value="' + y[j].value + '" item="' + y[j].value + '"><label class="form-check-label" for="">' + y[j].label + '</label></div></li></ul>';
                    }


                    if (x != undefined && x != '') {
                        $("#attendance_deatils").css('display', 'block');

                    } else if (x == '') {
                        var warn = 'Oops! Data not found';
                        $("#not_found").html(warn);
                        $("#not_found").css('display', 'block');

                        setTimeout(() => {
                            $("#not_found").fadeOut(2000);
                        }, 3000);

                    }

                    for (i = 0; i < x.length; i++) {

                        var tr = $("<tr></tr>");
                        var attendData = status;
                        var attendStatus = attendData.replaceAll('attendType', 'attendType[' + i + ']');

                        console.log(attendStatus);

                        var td = $("<td><input type='hidden' name='std_id[]' value='" + x[i].id+"'><input type='hidden' name='std_name[]' value='" + x[i].first_name + ' ' + x[i].last_name + "'>" + x[i].first_name + ' ' + x[i].last_name + "</td><td><input type='hidden' name='std_roll[]' value='" + x[i].roll_no + "' >" + x[i].roll_no + "</td><td><input type='hidden' name='addmission_no[]' value='" + x[i].admission_no + "' >" + x[i].admission_no + "</td><td><input type='hidden' name='classes[]' value='" + x[i].class.id + "'><input type='hidden' name='section[]' value='" + x[i].section.id + "'>" + x[i].class.name + " (" + x[i].section.name + ")" + "</td><td>" + attendStatus + "</td><td><input type='text' class='inputs note' placeholder='Note' name='note[" + i + "]'></td></td>");

                        tr.append(td);
                        $("#filter_result").append(tr);
                    }
                },
            });
        });


        // Store Attendance Filter Result
        $('#attendance_filter_result').submit(function(e) {
            e.preventDefault();

            var attendanceDate = $("[name='attendanceDate']").val();
            var date = $('#attendanceDate').val(attendanceDate);

            $.ajax({
                url: "{{ route('attendanceSubmit') }}",
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log('response');
                    $('#attendance_filter_result')[0].reset();
                    alert('Attendance record saved successfully');

                },
            });
        });

    });
</script>
<!-- End Attendance AJAX -->
@endsection