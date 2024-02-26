@extends('dashboard.master')

@section('title')
Online Exam
@endsection

<!-- Online Exam area -->
@section('body')
<div class="container py-5 px-5">

    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Online Exam</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('online-exam.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('online-exam.index') }}">Online examination</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Online Exam</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Filter Area -->
    <div class="card">
        <div class="col-12 col-md-12 px-0">

            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center bg-transparent mt-2 mb-0">
                <h2 class="text-dark">Filtering</h2>
            </div>
            <!-- End Header -->

            <!-- Filter bar -->
            <form action="#" method="" class="card-body" id="onlineExam_filterBar">

                <fieldset>
                    @csrf
                    <div class="row justify-content-end inputs_data pb-5">

                        <!-- Select classes-->
                        <div class="col-12 col-md-4 mb-3">
                            <select class="inputs w-100" id="select_classes" name="select_classes">
                                <option value="0">Select class*</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach

                            </select>
                            <span id="classes_error" class="error"></span>
                        </div>

                        <!-- Select Section-->
                        <div class="col-12 col-md-3 mb-3">
                            <select class="inputs w-100" id="select_section" name="select_section" value="0">
                                <option>Select Section</option>

                            </select>
                            <span id="select_section_error" class="error"></span>
                        </div>

                        <!-- Select Subject-->
                        <div class="col-12 col-md-3 mb-3">
                            <select class="inputs w-100" id="select_subject" name="select_subject" value="0">
                                <option>Select Subject</option>
                            </select>
                            <span id="select_subject_error" class="error"></span>
                        </div>


                        <!-- Search Keyword-->
                        <div class="col-12 col-md-3 mb-3">
                            <input type="text" name="search_keyword" id="search_keyword" class="form-control inputs" placeholder="Search name / start">
                            <span id="roll_error" class="error"></span>
                        </div>

                        <!-- Submit button -->
                        <div class="col-12 col-md-1 ml-2 mr-3">
                            <button type="" class="btn btn-primary float-right inputs" id="online_exam_search">Search</button>
                        </div>
                    </div>

                </fieldset>
            </form>
            <!-- End Filter bar -->
        </div>
    </div>
    <!-- End Filter Area -->

    <!-- Page Content -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-transparent">
            <h3 class="text-dark">Online Exam</h3>
            <div class="button">
                <a href="{{ route('online-exam.create') }}" class="btn btn-primary text-capitalize p-3"><i class="fa-solid fa-plus"></i> Add</a>
            </div>
        </div>


        <div class="card-body" id="onlineExam_index_table">
            <div class="table-responsive" id="onlineExam_index_default">
                <table class="table table-bordered" id="onlineExam_table">
                    <thead>
                        <tr>
                            <th>SR No</th>
                            <th>Class (Section)</th>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Total Mark</th>
                            <th>Exam Start</th>
                            <th>Exam End</th>
                            <th>Duration</th>
                            <th>Exam Published</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($onlineExamData as $key => $data)

                        <!-- {{ $data->online_exam_type }} -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $data->classes->name }} {{ '(' . $data->section->name . ')' }}
                                <input type="hidden" name="id" value="{{ $data->id }}">
                            </td>
                            <td>
                                {{ $data->subject->name }}
                            </td>
                            <td>
                                {{ $data->name }}
                            </td>
                            <td>
                                {{ $data->online_exam_type->name }}

                            </td>
                            <td>
                                {{ $data->total_mark }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->start)->format('d-m-Y h:i a') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->end)->format('d-m-Y h:i a') }}
                            </td>
                            <td>
                                @php
                                $start_time = \Carbon\Carbon::parse($data->start);
                                $end_time = \Carbon\Carbon::parse($data->end);

                                $hours_diff = $start_time->diffInHours($end_time);
                                $min_diff = $start_time->diffInMinutes($end_time);



                                if($hours_diff >= 24){

                                $totalDay = $start_time->diffInDays($end_time);
                                $remaining_hour = $hours_diff - $totalDay * 24;
                                $remaining_min;

                                echo $totalDay . ' Days' . ' ' . $remaining_hour . ' hours' . ' ';


                                }elseif($hours_diff < 24) { $totalHours=$start_time->diffInHours($end_time);

                                    echo 0 . ' Days' . ' ' . $totalHours . ' hours' . ' ';

                                    }

                                    @endphp

                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->published)->format('d-m-Y h:i a') }}
                            </td>
                            <td>
                                @if($data->status == null)
                                <span class="badge_status_act">Active</span>
                                @endif
                            </td>
                            <td>

                                <!-- Download Question -->
                                <a href="{{ url('/pdf') }}/{{ $data->id }}" type="submit" class="edit btn btn-info btn-sm mb-2" ids="onDownload_btn" id=" {{ $data->id }}"><i class="fa-solid fa-download"></i>Question</a>


                                <!-- Edit -->
                                <button class="edit btn btn-success btn-sm mb-2 mr-2" edit_id="{{ $data->id }}" id="onlineExamEdit"><i class="fa-regular fa-pen-to-square"></i></button>


                                <!-- Delete -->
                                <a href="" class="edit btn btn-danger btn-sm mb-2" del_id="{{ $data->id }}" id="onlineExamDel"><i class="fa-solid fa-trash-can"></i></a>


                                <!-- View Question -->
                                <a href="javascript:void(0)" data-url="{{ url('/view-question') }}/{{ $data->id }}" class="edit btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#viewQuestion" ids="onViewQst_btn" id="viewQst"><i class="fa-solid fa-eye"></i>View Questions</a>

                                <!-- View Question Modal -->
                                <div class="modal fade" id="viewQuestion_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLabel">Question List</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" id="cross_btn" style="font-weight: 400;width: 40px;height: 40px;background: #ddd;border-radius: 50%;display: flex;justify-content: center;align-items: center;">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-striped" id="viewQst_table">
                                                    <thead>
                                                        <tr id="" style="background: #f4f4f4;">
                                                            <th style="background: #f4f4f4;border-radius: 12px 0px 2px!important;">SR NO.</th>
                                                            <th>Question</th>
                                                            <th style="background: #f4f4f4; border-radius: 0px 12px 0px 0px!important;">Mark</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="viewQst_tbody">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="modalCancelBtn">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->


                                <!-- View Student -->
                                <a href="javascript:void(0)" data-url="{{ url('/view-students') }}/{{ $data->id }}" data-toggle="modal" data-target="#viewStudent" class="edit btn btn-info btn-sm" ids="onViewStd_btn" id="viewStd"><i class="fa-solid fa-eye"></i>Students</a>


                                <!-- View Student Modal -->
                                <div class="modal fade" id="viewStudent_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content" style="width: auto;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Student List</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" id="cross_btn" style="font-weight: 400;width: 40px;height: 40px;background: #ddd;border-radius: 50%;display: flex;justify-content: center;align-items: center;">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <table class="table table-striped" id="viewStd_table">
                                                    <thead>
                                                        <tr id="" style="background: #f4f4f4;">
                                                            <th style="background: #f4f4f4;border-radius: 12px 0px 2px!important;">SR NO.</th>
                                                            <th>Admission NO</th>
                                                            <th>Student name</th>
                                                            <th>Guardian name</th>
                                                            <th>Mobile number</th>
                                                            <th>Answer</th>
                                                            <th style="background: #f4f4f4; border-radius: 0px 12px 0px 0px!important;">Result</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="viewStd_tbody">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="modalCancelBtn">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Page Content -->



</div>



<!-- AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#onlineExam_filterBar').validate();

    $(document).ready(function() {

        // Filter
        $('#onlineExam_filterBar').submit(function(e) {
            e.preventDefault();

            // Display block for Report

            var sectionId = $('#select_section').val();
            var selectedClass = $('#select_classes').val();
            var selectedSection = $('#select_section').val();

            $('#onlineExam_index_default').css('fade', 'block');
            $('#onlineExam_index_table').css('display', 'none');

            $.ajax({
                url: "{{ route('onlineExam.filterIndex') }}",
                method: "POST",
                data: $(this).serialize(),
                dataType: "html",
                success: function(res) {
                    console.log(res);

                    $('#onlineExam_index_default').fadeOut(1000);
                    $('#onlineExam_index_table').fadeIn(1000);
                    $('#onlineExam_index_table').html(res);


                }
            })

        })


        // Get Section by Select Class
        $(document).on('change', '#select_classes', function() {
            var classId = $(this).val();

            $.ajax({
                url: "{{ url('/get-section-by-class') }}/" + classId,
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


        // Get Subject by Select Section
        $(document).on('change', '#select_section', function() {
            var sectionId = $(this).val();

            if (sectionId != undefined || sectionId != '') {

                $.ajax({
                    url: "{{ url('/get-subject-by-section') }}",
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);

                        var option = '';
                        option += '<option selected disabled>Select Subject</option>';

                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key]['name'] + '</option>';
                        };
                        $('#select_subject').empty().append(option);

                    },
                })
            }


        })


        // 'Create Online Exam' Filter
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


        // MODAL PART ---------------->


        // Close View Question Modal
        $('body').on('click', '#modalCancelBtn', function(e) {
            $('#viewQuestion_modal').modal('hide');
        })


        // View Question
        $('body').on('click', '#viewQst', function(e) {
            e.preventDefault();
            // alert(54);

            var qstURL = $(this).data('url');

            $.get(qstURL, function(data) {
                console.log(data);
                let x = data.questions;


                $('#viewQuestion_modal').modal('show');
                $('#viewQst_tbody').empty();


                for (i = 0; i < x.length; i++) {

                    console.log(x[i].question_type == 3);

                    let y = x[i].ans;
                    let options = '';

                    // For Answer -->
                    for (j = 0; j < y.length; j++) {

                        if (x[i].id == y[j].question_bank_id) {
                            console.log(y[j].single_option);
                            options += ('<span class="mb-3" style="font-size: 14px; font-weight: 300;">' + [j + 1] + '. '  + y[j].single_option + '</span><br>');
                        }
                    }

                    let tr = $('<tr></tr>');
                    let td = '';
                    let trueFalse = '';

                    if (x[i].question_type == 3) {
                        trueFalse = '<span> 1. True </span><br><span> 2. False </span>';

                        td = $('<td>' + [i + 1] + '</td><td><span class="viewQst_qst">' +
                            x[i].question + '</span><br><span class="optionContainer">' + trueFalse + '</span><br><span>Answer: ' + options + '</span></td><td>' +
                            x[i].mark + '</td>');

                        tr.append(td);
                        $('#viewQst_tbody').append(tr);

                    } else {

                        // Check If correct ans is an array/normal/null or '';
                        let correctAns = '';
                        if (x[i].c_ans == null) {

                            correctAns = '';
                        } else if (x[i].c_ans != undefined) {
                            
                            correctAns = x[i].c_ans;
                        }
                        
                        console.log(x[i].c_ans);

                        td = $('<td>' + [i + 1] + '</td><td><span class="viewQst_qst">' +
                            x[i].question + '</span><br><span class="optionContainer">' + (options) + '</span><span class="viewQst_qst">Answer: ' + correctAns + '</span></td><td>' +
                            x[i].mark + '</td>');

                        tr.append(td);
                        $('#viewQst_tbody').append(tr);

                    }




                }

            })
        })






        // Close Student List Modal
        $('body').on('click', '#modalCancelBtn', function(e) {
            $('#viewStudent_modal').modal('hide');
        })

        // View Students List
        $('body').on('click', '#viewStd', function(e) {
            e.preventDefault();
            // alert(54);

            var qstURL = $(this).data('url');

            $.get(qstURL, function(data) {
                // console.log(data);
                let x = data.listedStd;

                $('#viewStudent_modal').modal('show');
                $('#viewStd_tbody').empty();

                for (i = 0; i < x.length; i++) {

                    console.log(x[i].online_exam_id);
                    let tr = $('<tr> </tr>');
                    let td = $('<td>' + [i + 1] + '</td><td>' +
                        x[i].students.admission_no + '</td><td>' + [x[i].students.first_name + ' ' + x[i].students.last_name] + '</td><td>' +
                        x[i].students.parent + '</td><td>' +
                        x[i].students.mobile + '</td><td><a target="_blank" href="{{ url("/view-students/answer") }}/' + x[i].online_exam_id + '/' + x[i].student_id + '" class="btn btn-info px-4" id="viewStdAns"><i class="fa-solid fa-eye"></i></a</td><td>' +
                        x[i].students.mobile + '</td>');

                    tr.append(td);
                    $('#viewStd_tbody').append(tr);

                }






            })
        })


        $(document).on('mouseover', '#cross_btn', function(e) {
            e.preventDefault();
            $(this).css({
                'transform': 'rotate(180deg)',
                'transition': 'all .3s ease',
                'background': '#ddd',
            })

        })


        $(document).on('mouseout', '#cross_btn', function(e) {
            e.preventDefault();
            // alert('Hi');
            // $('#viewQuestion_modal').modal('hide');
            $(this).css('transform', 'rotate(0deg)')

        })


        $(document).on('click', '#cross_btn', function(e) {
            $('#viewQuestion_modal').modal('hide');
            $('#viewStudent_modal').modal('hide');
        })



        // View Students Answer




        // Edit Data
        $("#onlineExam_table").on('click', '#onlineExamEdit', function() {

            var id = $(this).attr('edit_id');

            var url = '{{ route("online-exam.edit", ":id") }}';
            url = url.replace(':id', id);

            window.location.href = url;

        })



        // Delete Data
        $("#onlineExam_table").on('click', '#onlineExamDel', function(e) {
            e.preventDefault();
            let id = $(this).attr('del_id');
            let token = $("[name='_token']").val();

            var url = '{{ route("online-exam.destroy", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: token
                },
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert('Deleted successfully');
                        var oTable = $('#onlineExam_table').dataTable();
                        oTable.fnDraw(false);
                    }
                }
            })

        });




















    });
</script>
<!-- End AJAX -->
@endsection