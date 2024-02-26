@extends('dashboard.master')

@section('title')
    Edit Exam-Assign
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5  mx-5 py-3">
                <h3 class=" bg-light text-center py-3">Edit Exam-Assign</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a
                                href="{{ url('/examassigns') }}">Exam-Assign</a></li>
                    </ol>
                </nav>
                <form action="" method="POST" class="p-5 bg-white" id="examAssignUpdate" moyemoye="{{$exam_assign->id}}">
                    <fieldset>
                        @csrf
                        <div class="row ">

                            <div class="col-md-6 ">
                                <label for="" class="col-md-12 label_name">Exam Type <span
                                        class="text-danger">*</span></label>
                               <select required class="js-example-basic-single col-md-12 form-control"
                                    name="exam_type[]" id="examType">
                                    <option class="form-control" value="">Select Exam Type</option>
                                    @foreach ($examTypes as $examType)
                                        <option class="form-control" value="{{ $examType->id }}"
                                            {{ $examType->id == $exam_assign->exam_type ? 'selected' : '' }}>
                                            {{ $examType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="exam_type_error" class="error"></span>
                            </div>


                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Class<span
                                        class="text-danger">*</span></label>
                                <select required id="classExam" class="js-example-basic-single col-md-12 form-control"
                                    name="class_id">
                                    <option class="form-control" required value="">select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}"
                                            {{ $class->id == $exam_assign->class_id ? 'selected' : '' }}>{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="col-md-12 label_name">Sections <span
                                        class="text-danger">*</span></label>
                                <div class="mx-5 d-flex justify-content-arround" style="font-size: 20px" id="sectionExam">
                                    <input class='mx-2 ' required type='checkbox' checked name='section_id[]'
                                        value=" {{ $exam_assign->section_id }} "> {{ $exam_assign->section->name }}
                                
                                </div>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="col-md-12 label_name">Subject <span
                                        class="text-danger">*</span></label>
                                <select required class="js-example-basic-multiple col-md-12 form-control"
                                    multiple="multiple" id="subject" name="subject_id[]">
                                    <option class="form-control" value="">Select Exam Type</option>
                                    @foreach ($subjects as $subject)
                                        @foreach ($exam_assign->parents as $val)
                                            {{ $val }}
                                            <option class="form-control" value="{{ $subject->id }}"
                                                {{ $subject->id == $val->subject_id ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                <span id="subject_id_error" class="error"></span>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-2">
                                <h4 class="">Subject </h4>
                            </div>
                            <div class="col-md-8">
                                <h4 class="">Mark Distribution</h4>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-2" id="CreateRow">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary float-end" type="submit"><i
                                    class="fa-solid fa-save px-1"></i>Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            var subjectId = $('#subject').select2();
            $('#subject').on('select2:select', function() {
                var mydata = subjectId.find(':selected');
                console.log(mydata.length);
                $("#subjectName").html('');
                for (i = 0; i < mydata.length; i++) {

                    var subjectName = '';
                    subjectName = '<div class="col-md-2 mt-3" ><h4 id="subjectName">' + mydata[i].text +
                        '</h4></div>';

                    subjectMark =
                        '<div class="col-md-8"><div class="row" id="moreField"> <table class="table table-bordered" id="crud_table"> <tr> <td width="48%" contenteditable="true" name="exam_title[' +
                        mydata[i].value +
                        '][]">Written/Practical</td> <td width="48%" contenteditable="true" name="exam_marks[' +
                        mydata[i].value + '][]">00</td> <td width="4%"></td> </tr> </table> </div> </div>';

                    addButton = '<div class="col-md-2"><p class="btn btn-danger" add_id="' + mydata[i]
                        .value + '" id="addField">+ Add</p> </div>';



                    $("#subjectName").append(subjectName);
                    $("#subjectName").append(subjectMark);
                    $("#subjectName").append(addButton);
                }
            })
            var count = 1;
            $('#subjectName').on('click', '#addField', function() {
                let id = $(this).attr("add_id");
                count = 1;
                if (id) {
                    count = count + 1;
                    var html_code = "<tr id='row" + count + "'>";
                    html_code += "<td contenteditable='true' name='exam_title[" + id +
                        "][]'>Written/Practical</td>";
                    html_code += "<td contenteditable='true' name='exam_marks[" + id + "][]'>00</td>";
                    html_code += "<td><button type='button' name='remove' data-row='row" + count +
                        "' class='btn btn-danger btn-xs remove'>-</button></td>";
                    html_code += "</tr>";
                    $('#crud_table').append(html_code);
                }
            });

            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {

            function addRow(subjectName, sid) {
                var newRow = $('<div class="row mt-2 row' + sid + '">');
                var left = $('<div class="col-md-2">');
                left.append('<h4>' + subjectName + '</h4>');
                var right = $('<div class="col-md-10">');
                right.append(
                    '<button type="button" class="btn btn-success float-end add-field" id="' + sid +
                    '">+ Add</button>');
                newRow.append(left);
                newRow.append(right);
                $('#CreateRow').append(newRow);
            }

            function addInputFields(subjectName, sid) {
                var inputRow = $('<div class="row mt-2 input-row ">');
                var left = $('<div class="col-md-6">');
                left.append('<input type="text" class="form-control" required name="title[' + sid +
                    '][]" placeholder="Enter Title">');
                var right = $('<div class="col-md-5">');
                right.append('<input type="text" class="form-control" required name="marks[' + sid +
                    '][]" placeholder="Enter Marks">');
                var removeButton = $('<div class="col-md-1 mx-auto">');
                removeButton.append(
                    '<button type="button" class="btn btn-danger float-end remove-field" ><i class="fa-solid fa-xmark"></i> </button>'
                );
                var hr = $('<div class="col-md-12">');
                hr.append(
                    ' <br/> <hr>');
                inputRow.append(left);
                inputRow.append(right);
                inputRow.append(removeButton);
                inputRow.append(hr);
                $('.row' + sid).append(inputRow);
            }
            $('#subject').on('change', function() {
                var selectedSubjects = $(this).val();
                $('#CreateRow').empty();
                if (selectedSubjects) {
                    $.each(selectedSubjects, function(index, subjectId) {
                        var subjectName = $("#subject option[value='" + subjectId + "']").text();
                        var sid = $("#subject option[value='" + subjectId + "']").val();
                        addRow(subjectName, sid);
                        addInputFields(subjectName, sid);
                    });
                }
            });

            $('#CreateRow').on('click', '.add-field', function() {
                var subjectName = $(this).closest('.row').find('h4').text();
                var sid = $(this).attr("id");
                addInputFields(subjectName, sid);
            });

            $('#CreateRow').on('click', '.remove-field', function() {
                $(this).closest('.input-row').remove();
            });


            @foreach ($exam_assign->parents as $key => $val)
                var sid = {{ $val->subject_id }};
                var subjectName = '{{ $val->subject->name }}';
                var title = '{{ $val->title }}';
                var marks = {{ $val->marks }};
                var aid = {{ $val->id }};
                addRow(subjectName, sid);
                addInputFields1(marks, title, sid, aid);
            @endforeach
            function addInputFields1(marks, title, sid, aid) {
                var inputRow = $('<div class="row mt-2 input-row ">');
                var left = $('<div class="col-md-6">');
                left.append('<input type="text" class="form-control" required name="title[' + sid +
                    '][]" value="' + title + '"> <input type="hidden" name="aid[]" value="' + aid + '">');
                var right = $('<div class="col-md-5">');
                right.append('<input type="text" class="form-control" required name="marks[' + sid +
                    '][]" value="' + marks + '">');
                var removeButton = $('<div class="col-md-1 mx-auto">');
                removeButton.append(
                    '<button type="button" class="btn btn-danger float-end remove-field" ><i class="fa-solid fa-xmark"></i> </button>'
                );
                var hr = $('<div class="col-md-12">');
                hr.append(
                    ' <br/> <hr>');
                inputRow.append(left);
                inputRow.append(right);
                inputRow.append(removeButton);
                inputRow.append(hr); 
                $(".row"+sid ).append(inputRow);
            }
        });
    </script>
@endsection
