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
                <h2>Create Online Exam</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('online-exam.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('online-exam.index') }}">Online examination</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('online-exam.create') }}">Online Exam</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif


    <!-- Filter Area -->
    <div class="row card">
        <div class="col-12 col-md-12 px-0">

            <!-- Filter bar -->
            <form action="#" method="POST" class="card-body" id="onlineExam_filterBar">

                <fieldset>
                    @csrf
                    <!-- Filter bar part -->
                    <div class="row justify-content-end inputs_data pb-5">

                        <!-- Name -->
                        <div class="col-12 col-md-4 mb-4">
                            <label for="issue_date" class="form-label label_name">Name <span class="text-danger fillable">*</span></label>

                            <input type="text" name="name" min="1" id="name" class="form-control inputs" placeholder="Enter name" required>
                            <span id="name_error" class="error"></span>

                        </div>

                        <!-- Start -->
                        <div class="col-12 col-md-4 mb-4">

                            <label for="start" class="form-label label_name">Start <span class="text-danger fillable">*</span></label>

                            <input type="datetime-local" min="2023-09-27T10:29" name="start" id="start" class="form-control inputs" required>
                            <span id="start_error" class="error"></span>

                        </div>

                        <!-- End -->
                        <div class="col-12 col-md-2 mb-4">

                            <label for="end" class="form-label label_name">End <span class="text-danger fillable">*</span></label>

                            <input type="datetime-local" name="end" min="2023-09-27T10:42" id="end" class="form-control inputs" required>
                            <span id="end_error" class="error"></span>

                        </div>


                        <!-- Published -->
                        <div class="col-12 col-md-2 mb-4">

                            <label for="published" class="form-label label_name">Published <span class="text-danger fillable">*</span></label>

                            <input type="datetime-local" name="published" min="2023-09-27T11:24" id="published" class="form-control inputs" required>
                            <span id="published_error" class="error"></span>

                        </div>
                        <!--  -->


                        <!-- Question Group -->
                        <div class="col-12 col-md-4 mb-4 d-flex flex-column">
                            <label for="qstGroup" class="form-label label_name">Question Group <span class="text-danger fillable">*</span></label>

                            <select name="qstGroup" id="qstGroup" class="inputs" required>
                                <option value="">Select Question Group</option>
                                @foreach($qstGroup as $qstGroup)
                                <option value="{{ $qstGroup->id }}">{{ $qstGroup->name }}</option>
                                @endforeach
                            </select>
                            <span id="qstGroup_error" class="error"></span>

                        </div>


                        <!-- Class -->
                        <div class="col-12 col-md-4 mb-4 d-flex flex-column">
                            <label for="classes" class="form-label label_name">Class <span class="text-danger fillable">*</span></label>

                            <select name="classes" id="classes" class="inputs" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <span id="classes_error" class="error"></span>

                        </div>


                        <!-- Section -->
                        <div class="col-12 col-md-2 mb-4">
                            <label for="section" class="form-label label_name">Section <span class="text-danger fillable">*</span></label>

                            <select name="section" id="section" class="inputs w-100" required>
                                <option value="">Select Section</option>
                            </select>
                            <span id="section_error" class="error"></span>

                        </div>


                        <!-- Subject -->
                        <div class="col-12 col-md-2 mb-4">
                            <label for="subject" class="form-label label_name">Subject <span class="text-danger fillable">*</span></label>

                            <select name="subject" id="subject" class="inputs w-100" required>
                                <option value="">Select Subject</option>
                            </select>
                            <span id="subject_error" class="error"></span>

                        </div>


                        <!-- Total Mark -->
                        <div class="col-12 col-md-4 mb-4">

                            <label for="total_mark" class="form-label label_name">Total Mark <span class="text-danger fillable">*</span></label>

                            <input type="number" name="total_mark" id="total_mark" class="form-control inputs" placeholder="Enter total mark" required>
                            <span id="total_mark_error" class="error"></span>

                        </div>


                        <!-- Type -->
                        <div class="col-12 col-md-4 mb-4 d-flex flex-column">
                            <label for="type" class="form-label label_name">Type</label>

                            <select name="type" id="type" class="inputs" required>
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <span id="type_error" class="error"></span>

                        </div>



                        <!-- Student Category -->
                        <div class="col-12 col-md-2 mb-4">
                            <label for="stdCat" class="form-label label_name">Student Category</label>

                            <select name="stdCat" id="studentCat" class="inputs w-100" required>
                                <option value="">Student Category</option>
                                @foreach($std_cats as $std_cat)
                                <option value="{{ $std_cat->id }}">{{ $std_cat->name }}</option>
                                @endforeach
                            </select>
                            <span id="stdCat_error" class="error"></span>

                        </div>


                        <!-- Gender -->
                        <div class="col-12 col-md-2 mb-3">
                            <label for="gender" class="form-label label_name">Gender
                            </label>

                            <select name="gender" class="inputs w-100" id="studentGender" required>
                                <option value="">Select Gender</option>
                                @foreach($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach
                            </select>
                            <span id="gender_error" class="error"></span>

                        </div>

                    </div>


                    <!-- Table part -->
                    <div class="row mb-5">

                        <div class="col-12 col-md-4">
                            <table id="qstlist_table" class="qstBox_group table-bordered w-100">
                                <thead class="text-center">
                                    <tr>

                                        <th>All
                                            <span class="chkBox_all">
                                                <input type="checkbox" name="qstList_all" class="check_all_qst" id="qstList_all" value="" style="cursor: pointer;" required>
                                            </span>
                                        </th>

                                        <th>Question</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody id="qstList_tbody">

                                </tbody>
                            </table>
                        </div>

                        <!-- Student List -->
                        <div class="col-12 col-md-8">
                            <table id="stdlist_table" class="table-bordered checkbox-group w-100">
                                <thead class="text-center">
                                    <tr>

                                        <th>All
                                            <span class="chkBox_all">
                                                <input type="checkbox" class="check-all" name="stdList_all" id="stdList_all" value="" style="cursor: pointer;" required>
                                            </span>
                                        </th>

                                        <th>Admission NO</th>
                                        <th>Student name</th>
                                        <th>Class (Section)</th>
                                        <th>Guardian name</th>
                                        <th>Mobile number</th>
                                    </tr>
                                </thead>
                                <tbody id="stdlist_tbody">

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12 col-md-12 ml-2 mr-3">
                            <button type="" class="btn btn-primary text-white float-right inputs px-3" id="attend_report_search">Submit</button>
                        </div>
                    </div>


                </fieldset>
            </form>
        </div>
        <!-- End Filter bar -->
    </div>
</div>
<!-- End Filter Area -->



</div>



<!-- Attendance Report AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#attendance_form').validate();

    $(document).ready(function() {

        // Get Section by Select Class
        $(document).on('change', '#classes', function() {
            var classId = $(this).val();

            $.ajax({
                url: "{{ url('/get-section-by-class') }}/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    // console.log(data);

                    var option = '';
                    option += '<option selected disabled>Select Section</option>';

                    for (const key in data) {
                        option += "<option value=" + data[key]['id'] + ">" + data[key]['name'] + '</option>';
                    };
                    $('#section').empty().append(option);

                },
            })
        })


        // Get Subject by Select Section
        $(document).on('change', '#section', function() {
            var sectionId = $(this).val();

            if (sectionId != undefined || sectionId != '') {

                $.ajax({
                    url: "{{ url('/get-subject-by-section') }}",
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);

                        var option = '';
                        option += '<option selected disabled>Select Subject</option>';

                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key]['name'] + '</option>';
                        };
                        $('#subject').empty().append(option);

                    },
                })
            }


        })


        // Question List Check All
        $(".check_all_qst").click(function() {
            var parentDiv = $(this).closest(".qstBox_group");
            parentDiv.find("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
        $("input[type=checkbox]").not(".check-all").click(function() {
            var parentDiv = $(this).closest(".qstBox_group");

            if (!parentDiv.find("input[type=checkbox]").not(".check-all").prop("checked")) {
                parentDiv.find(".check-all").prop("checked", false);
            }
        });



        // Get Question List By select Question Group
        $('#qstGroup').change(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('/filter-question') }}",
                data: $('#onlineExam_filterBar').serialize(),
                dataType: "json",
                success: function(res) {

                    let x = res.filterQuestion;
                    console.log(x);
                    $('#qstList_tbody').empty();

                    if (res.success == true) {
                        for (let i = 0; i < x.length; i++) {

                            let tr = $('<tr></tr>');
                            let td = $('<td class="text-center"><span class="chkBox_all"><input type="hidden" name="qid[]" value = "' + x[i].id + '"><input type = "checkbox" name = "singleQst_chkbox[]" value = "1" class="my_checkboxs" style = "cursor: pointer;"></span></td><td class="text-start">' + x[i].question + '</td><td class="text-start">' + x[i].question_type + '</td>');

                            tr.append(td);
                            $('#qstList_tbody').append(tr);

                        }

                    }
                }
            })
        });



        // Get Student List By Class, Section
        $('#section').change(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('/filter-student') }}",
                data: $('#onlineExam_filterBar').serialize(),
                dataType: "json",
                success: function(res) {

                    let x = res.filterStudents;
                    $('#stdlist_tbody').empty();

                    if (res.success == true) {
                        for (let i = 0; i < x.length; i++) {

                            let tr = $('<tr></tr>');
                            let td = $('<td class="text-center"><span class="chkBox_all"><input type="hidden" name="sid[]" value = "' + x[i].id + '"><input type = "checkbox" class="std_checkboxs" value = "1" name = "stdList_chkBox[]" value = "1" style = "cursor: pointer;"></span></td><td class="text-center">' + x[i].admission_no + '</td><td>' + x[i].first_name + ' ' + x[i].last_name + '</td><td class="text-center">' + x[i].class_name + ' (' + x[i].section_name + ')' + '</td><td>Guardian Name</td><td>' + x[i].mobile + '</td>');

                            tr.append(td);
                            $('#stdlist_tbody').append(tr);

                        }

                    }
                }
            })
        });


        // Get Student List By Class, Section & Category
        $('#studentCat').change(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('/filter-student') }}",
                data: $('#onlineExam_filterBar').serialize(),
                dataType: "json",
                success: function(res) {

                    let x = res.filterStudents;
                    $('#stdlist_tbody').empty();

                    if (res.success == true) {
                        for (let i = 0; i < x.length; i++) {

                            let tr = $('<tr></tr>');
                            let td = $('<td class="text-center"><span class="chkBox_all"><input type = "checkbox" name = "stdList_chkBox[]" value = "' + x[i].id + '" style = "cursor: pointer;"></span></td><td class="text-center">' + x[i].admission_no + '</td><td>' + x[i].first_name + ' ' + x[i].last_name + '</td><td class="text-center">' + x[i].class_name + ' (' + x[i].section_name + ')' + '</td><td>Guardian Name</td><td>' + x[i].mobile + '</td>');

                            tr.append(td);
                            $('#stdlist_tbody').append(tr);

                        }

                    }
                }
            })
        });


        // Get Student List By Class, Section, Category & Gender
        $('#studentGender').change(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('/filter-student') }}",
                data: $('#onlineExam_filterBar').serialize(),
                dataType: "json",
                success: function(res) {

                    let x = res.filterStudents;
                    $('#stdlist_tbody').empty();

                    if (res.success == true) {
                        for (let i = 0; i < x.length; i++) {

                            let tr = $('<tr></tr>');
                            let td = $('<td class="text-center"><span class="chkBox_all"><input type = "checkbox" name = "stdList_chkBox[]" value = "' + x[i].id + '" style = "cursor: pointer;"></span></td><td class="text-center">' + x[i].admission_no + '</td><td>' + x[i].first_name + ' ' + x[i].last_name + '</td><td class="text-center">' + x[i].class_name + ' (' + x[i].section_name + ')' + '</td><td>Guardian Name</td><td>' + x[i].mobile + '</td>');

                            tr.append(td);
                            $('#stdlist_tbody').append(tr);

                        }

                    }
                }
            })
        });


        // Student List Check All
        $(".check-all").click(function() {
            var parentDiv = $(this).closest(".checkbox-group");
            parentDiv.find("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
        $("input[type=checkbox]").not(".check-all").click(function() {
            var parentDiv = $(this).closest(".checkbox-group");

            if (!parentDiv.find("input[type=checkbox]").not(".check-all").prop("checked")) {
                parentDiv.find(".check-all").prop("checked", false);
            }
        });



        // Store Data -------------------------------------------->
        $('#onlineExam_filterBar').submit(function(e) {
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


            var myArray = [];

            $('.my_checkboxs').each(function() {
                if ($(this).is(':checked')) {
                    myArray.push(1);
                } else {
                    myArray.push(0);
                }
            });


            var stdArray = [];

            $('.std_checkboxs').each(function() {
                if ($(this).is(':checked')) {
                    stdArray.push(1);
                } else {
                    stdArray.push(0);
                }
            });


            if (isValid) {
                $.ajax({
                    url: "{{ route('online-exam.store') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#onlineExam_filterBar').serialize() + '&mycheckbox_item=' + myArray + '&stdcheckbox_item=' + stdArray,
                    success: function(data) {
                        if (data.success == true) {
                            alert("Added successfully");
                            $('#onlineExam_filterBar')['0'].reset();
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
<!-- End Attendance Report AJAX -->
@endsection