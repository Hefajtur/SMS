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
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-4 mb-0">
            <h2 class="text-dark">Filtering</h2>
        </div>

        <!-- Page content heading -->
        <form action="#" method="POST" class="card-body" id="attendance_form">

            <fieldset>
                @csrf
                <div class="row justify-content-end inputs_data card-body pb-5">

                    <!-- Select Class-->
                    <div class="col-12 col-md-3 mb-3">
                        <select class="select2_states inputs" required id="classes" name="select_class" id="select_class">
                            <option selected>Select class</option>
                            @foreach($classData as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <span id="select_class_error" class="error"></span>
                    </div>

                    <!-- Select Section-->
                    <div class="col-12 col-md-3 mb-3">
                        <select class="select2_states inputs w-100" required id="sections" name="select_section">
                            <option>Select Section</option>
                        </select>
                        <span id="select_section_error" class="error"></span>
                    </div>

                    <!-- Select Date-->
                    <div class="col-12 col-md-3 mb-3">
                        <input type="date" name="date" required class="form-control inputs">
                        <span id="date_error" class="error"></span>
                    </div>

                    <!-- Submit button -->
                    <div class="ml-2 mr-3">
                        <button class="btn btn-primary float-right inputs">Search</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
    <!-- End Filter Area -->


    <!-- Attendance Details -->
    <div class="row justify-content-end inputs_data card pb-5">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-2 mb-0 border-bottom">
            <h2 class="text-dark">Attendace</h2>
        </div>
        <!-- End Header -->

        <!-- Attendance Search Result -->
        <form action="#" method="POST" class="card-body" id="attendance_filter_result">

            <fieldset>
                @csrf
                <div class="card-bodys">

                    <!-- Checkbox -->
                    <div class="checkbox">
                        <div class="form-check">
                            <input class="form-check-input" id="holiday" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label holiday_title" for="holiday">
                                Holiday
                            </label>
                        </div>
                    </div>

                    <!-- Filter Table -->
                    <div class="attendance_table table-responsive mt-5">
                        <table class="table table-stirped table-bordered">
                            <thead class="table-light">
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
                                <tr>
                                    <td>Student name</td>
                                    <td>Roll NO</td>
                                    <td>Admission NO</td>
                                    <td>Class (Section)</td>
                                    <td>
                                        <ul class="attnd_item d-flex justify-content-center align-items-center">

                                            <!-- Attendance Types(present, late, absent, half day) -->
                                            @foreach($attandData as $data)
                                            <li>
                                                <div class="form-check form-check-inline">

                                                    <input class="form-check-input" type="radio" name="attnd_radio" id="{{ $data['value'] }}" value="{{ $data['value'] }}" item="{{ $data['value'] }}">
                                                    <label class="form-check-label" for="{{ $data['value'] }}">{{ $data['label'] }}</label>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </td>
                                    <td>
                                        <input type="text" class="inputs attnd_note" placeholder="Note">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Submit button -->
                        <div class="ml-2 mt-5">
                            <button class="btn btn-primary float-right p-3">Submit</button>
                        </div>

                    </div>

                </div>
            </fieldset>

        </form>
        <!-- End Attendance Search Result -->

    </div>
    <!-- End Attendance Details -->


</div>


<!-- Attendance AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('').validate();

    $(document).ready(function() {

    });
</script>
<!-- End Attendance AJAX -->
@endsection