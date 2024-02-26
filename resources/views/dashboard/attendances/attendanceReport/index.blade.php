@extends('dashboard.master')

@section('title')
Attendace Report
@endsection

<!-- Attendace Report area -->
@section('body')
<div class="container py-5 px-5">

    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Attendace Report</h2>
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
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-2 mb-0">
                <h2 class="text-dark">Filtering</h2>
            </div>
            <!-- End Header -->


            <!-- Filter bar -->
            <form action="#" method="" class="card-body" id="attendance_report_filterBar">

                <fieldset>
                    @csrf
                    <div class="row justify-content-end inputs_data pb-5">

                        <!-- Select Views-->
                        <div class="col-12 col-md-4 mb-3">
                            <select class="inputs w-100" name="select_views" id="select_views">
                                <option value="0">Short View</option>
                                <option value="1">Details View</option>
                            </select>
                            <span id="select_views_error" class="error"></span>
                        </div>

                        <!-- Select classes-->
                        <div class="col-12 col-md-4 mb-3">
                            <select class="inputs w-100" id="select_classes" name="select_classes">
                                <option value="0">Select class*</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <span id="select_classes_error" class="error"></span>
                        </div>

                        <!-- Select Section-->
                        <div class="col-12 col-md-3 mb-3">
                            <select class="select2_states inputs w-100" id="select_section" name="select_section" value="0">
                                <option>Select Section</option>
                            </select>
                            <span id="select_section_error" class="error"></span>
                        </div>


                        <!-- Select Month-->
                        <div class="col-12 col-md-3 mb-3">
                            <input type="month" name="month" id="select_month" min="2023-01" max="2023-12" class="form-control inputs">

                            <span id="date_error" class="error"></span>
                        </div>

                        <!-- Select Date-->
                        <div class="col-12 col-md-2 mb-3">
                            <input type="date" name="date" value="" class="form-control inputs">
                            <span id="date_error" class="error"></span>
                        </div>

                        <!-- Student Roll-->
                        <div class="col-12 col-md-3 mb-3">
                            <input type="number" name="roll" min="1" id="roll" class="form-control inputs" placeholder="Roll number">
                            <span id="roll_error" class="error"></span>
                        </div>

                        <!-- Submit button -->
                        <div class="ml-2 mr-3">
                            <button type="" class="btn btn-primary float-right inputs" id="attend_report_search">Search</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <!-- End Filter bar -->
        </div>
    </div>
    <!-- End Filter Area -->


    <!-- Attendance Details -->
    <div class="row card py-4" id="attendance_details">



    </div>
    <!-- End Attendance Report Details -->


</div>



<!-- Attendance Report AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#attendance_form').validate();

    $(document).ready(function() {


        // Select Class
        $(document).on('change', '#select_classes', function() {
            var classId = $(this).val();

            $.ajax({
                url: "{{ url('/attendance-report-section') }}/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    var option = '';
                    option += '<option selected disabled>Select Section</option>';

                    for (const key in data) {
                        option += "<option value=" + data[key]['id'] + ">" + data[key]['name'] + '</option>';
                    };
                    $('#select_section').empty().append(option);

                },
            })
        })


        
        // Display block for Report
        $('#attendance_details').css('display', 'none');


        // Filter
        $('#attendance_report_filterBar').submit(function(e) {
            e.preventDefault();

            // Display block for Report

            var sectionId = $('#select_section').val();
            var roll = $('#roll').val();
            var selectedClass = $('#select_classes').val();
            var selectedSection = $('#select_section').val();

            $.ajax({
                url: "{{ route('attendanceReport.filterView') }}",
                method: "GET",
                data: $(this).serialize(),
                dataType: "html",
                success: function(res) {
                    console.log(res);
                    
                    $('#attendance_details').css('display', 'block');
                    $('#attendance_details').html(res);


                }
            })

        })




        // For ajax pagination
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                // alert('Hi');
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });
        });

        function getData(page) {
            $.ajax(

                {
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html"
                }).done(function(data) {
                $("#attendance_details").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

    });
</script>
<!-- End Attendance Report AJAX -->
@endsection