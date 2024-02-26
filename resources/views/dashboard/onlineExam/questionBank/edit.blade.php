@extends('dashboard.master')

@section('title')
Edit Question Bank
@endsection

<!-- Create Question Bank area -->
@section('body')
<div class="container py-5 px-5">
    <!-- Page Heading & Breadcrumb -->
    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">

            <div class="page_hading_bredcrumb">
                <h2>Question Bank</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb_bg">
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Question Bank</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->


    <!-- Page Content -->
    <div class="row">
        <div class="col-12 col-md-12">

            <form action="#" class="card" id="update_qstBank_form" edit_id="{{ $edit_data->id }}">
                <fieldset>
                    @csrf
                    <div class="inputs_data row card-body py-5">

                        <!-- Hidden ID -->
                        <input type="hidden" name="qstBank_id" id="{{ $edit_data->id }}" value="{{ $edit_data->id }}">

                        <!-- Question Type -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="question_type" class="form-label label_name">Question Type <span class="text-danger fillable">*</span></label>

                                <select class="" name="question_type" id="question_type" required>
                                    <option> Select Type </option>
                                    <option value="1" {{ ($edit_data->question_type == 1) ? 'selected' : ''}}> Single Choice </option>
                                    <option value="2" {{ ($edit_data->question_type == 2) ? 'selected' : ''}}> Multiple Choice </option>
                                    <option value="3" {{ ($edit_data->question_type == 3) ? 'selected' : ''}}> True / False </option>
                                    <option value="4" {{ ($edit_data->question_type == 4) ? 'selected' : ''}}> Descriptive </option>
                                </select>

                                <span id="question_type_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Question Group -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="question_group" class="form-label label_name">Question Group <span class="text-danger fillable">*</span></label>

                                <select class="select2_states" name="question_group" id="question_group" required>
                                    <option value="0"> Select Question Group </option>
                                    @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ ($edit_data->question_group == $group->id) ? 'selected' : ''}}>{{ $group->name }}</option>
                                    @endforeach
                                </select>

                                <span id="question_group_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="statuses" class="form-label label_name">Status <span class="text-danger fillable">*</span></label>
                                <select class="select2_states" name="status" id="statuses" required>
                                    <option value="1" {{ ($edit_data->status == 1) ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{ ($edit_data->status == 0) ? 'selected' : ''}}>Inactive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Mark -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="mark" class="form-label label_name">Mark <span class="text-danger fillable">*</span></label>

                                <input type="number" name="mark" value="{{ $edit_data->mark }}" min="1" class="keyword form-control inputs mr-2" placeholder="Enter mark" id="mark" required>

                                <span id="mark_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Question -->
                        <div class="col-12 col-md-12 mb-4">
                            <div class="mb-3">
                                <label for="question" class="form-label label_name">Question <span class="text-danger fillable">*</span></label>

                                <input type="text" value="{{ $edit_data->question }}" name="question" class="form-control inputs mr-2" placeholder="Enter question" id="question" required>

                                <span id="question_error" class="error"></span>
                            </div>
                        </div>


                        <!-- Answer -->



                        <!-- Single Choice Sub-options -->
                        <div class="col-12 col-md-12" id="singleChoice_section">

                            <!-- Total option -->
                            <div class="col-12 col-md-12 mb-5 px-0" id="totalOption_wrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="total_option" class="form-label label_name">Total option <span class="text-danger fillable">*</span></label>

                                    <!-- Exist Total Option -->
                                    <select class="form-control inputs" name="sc_total_option" id="sc_total_option" required>

                                        <option value="0" selected>Select Option</option>

                                        @php
                                        $optValue = '';
                                        foreach ($answers as $key => $answer) {
                                        if($key == 0) {
                                        $optValue = $answer->total_option;
                                        }
                                        }
                                        echo $optValue;
                                        @endphp

                                        @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ ($optValue == $i) ? 'selected' : '' }}>{{ $i }}</option>

                                            @endfor
                                    </select>

                                    <span id="total_option_error" class="error"></span>

                                    <!-- Current Total Option -->
                                    <input type="hidden" name="total_option_item" id="current_total_option" value="{{ $optValue }}">
                                </div>

                            </div>

                            <!-- Option box -->
                            <div class="row col-12 col-md-12 px-0" id="sc_optionBox">
                                @foreach($answers as $key => $answer)
                                <div class="col-12 col-md-3 mb-4">
                                    <label for="sc_singleOption" class="form-label label_name">Option {{ $key + 1 }}
                                        <span class="text-danger fillable">*</span></label>

                                    <input type="text" value="{{ $answer->single_option }}" name="sc_singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="sc_singleOption" required>

                                    <input type="hidden" name="sc_single_option[]" id="{{ $answer->id }}" value="{{ $answer->id }}">

                                </div>

                                @endforeach
                            </div>


                            <!-- Answer -->
                            <div class="col-12 col-md-12 px-0 " id="answerWrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="sc_answer" class="form-label label_name">Answer <span class="text-danger fillable">*</span></label>

                                    <select class="select2_states form-control inputs" name="sc_answer" id="sc_answer" required>
                                        <option value="0"> Select Option </option>
                                       
                                        @foreach($answers as $key => $answer)
                                        <div class="col-12 col-md-3 mb-4">
                                            <option value="{{ $key + 1 }}" {{ ($edit_data->c_ans == $key + 1) ? 'selected' : '' }}> Option {{ $key + 1 }}
                                            </option>
                                        </div>
                                        @endforeach

                                    </select>

                                    <span id="answer_error" class="error"></span>
                                </div>

                            </div>

                        </div>
                        <!-- End Single Choice Sub options -->




                        <!-- Multiple Choice Sub-options -->
                        <div class="col-12 col-md-12" id="mcqChoice_section">

                            <!-- Total option -->
                            <div class="col-12 col-md-12 mb-5 px-0" id="mcq_totalOption_wrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="mcq_total_option" class="form-label label_name">Total option <span class="text-danger fillable">*</span></label>

                                    <select class=" form-control inputs" name="mcqtotal_option" id="mcq_total_option" required>

                                        <option value="0" selected>Select Option</option>
                                        @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}" @foreach($answers as $ans) {{ ($i == $ans->total_option) ? 'selected' : '' }} @endforeach> {{ $i }} </option>
                                            @endfor


                                    </select>

                                    <span id="mcqtotal_option_error" class="error"></span>
                                </div>
                            </div>


                            <!-- Option box -->
                            <div class="row col-12 col-md-12 px-0" id="mcqOptionBox">

                                @foreach($answers as $key => $answer)

                                <div class="col-12 col-md-3 mb-4">
                                    <label for="singleOption" class="form-label label_name">Option' {{ $key + 1 }} <span class="text-danger fillable">*</span></label>

                                    <input type="text" name="mcqSingleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="mcqSingleOption" value="{{ $answer->single_option }}" required>

                                    <!-- Hidden input -->
                                    <input type="hidden" name="mcq_single_option[]" id="{{ $answer->id }}" value="{{ $answer->id }}">

                                </div>
                                @endforeach


                            </div>


                            <!-- Answer -->
                            <div class="col-12 col-md-12 px-0 " id="mcqAnswerWrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="mcqAnswer" class="form-label label_name">Answer <span class="text-danger fillable">*</span></label>

                                    <!-- Option box -->
                                    <div class="mb-3 d-flex justify-content-start align-items-center" id="mcq_ansBox">

                                        @php
                                        $a = [];
                                        $c_key = '';
                                        $cAns = json_decode($edit_data->c_ans);
                                        $a[] = $cAns;

                                        @endphp

                                        @foreach($answers as $key => $data)
                                        <div class="col-12 col-md-2 mb-4">
                                            <div class="form-check form-check-inline">


                                                <input required class="form-check-input mb-2" type="checkbox" name="mcq_answer[]" id="mcqanswer{{ $key + 1 }} " value="{{ $key + 1 }}" @if(is_array($cAns)) @foreach($cAns as $c_key=> $c_ans)

                                                {{ ($key + 1 == $cAns[$c_key]) ? 'checked' : '' }}
                                                @endforeach @else
                                                {{ ($key + 1 == $edit_data->c_ans) ? 'checked' : '' }}
                                                @endif
                                                >

                                                <label class="form-check-label mb-2" for="mcqanswer{{ $key + 1 }}">Option {{ $key + 1 }}</label>&nbsp;
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                    <span id="mcq_ans_error" class="error"></span>
                                </div>

                            </div>

                        </div>
                        <!-- End Multiple Choice Sub options -->




                        <!-- True/False Sub-options -->
                        <div class="col-12 col-md-12" id="trueFalse_section">

                            <!-- Answer -->
                            <div class="col-12 col-md-12 px-0 " id="trueFalseAnswerWrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="trueFalseAnswer" class="form-label label_name">Answer <span class="text-danger fillable">*</span></label>


                                    <select class="select2_states form-control inputs" name="trueFalseAnswer" id="trueFalseAnswer" required>
                                        <option> Select Option </option>
                                        <option value="1" {{ ($edit_data->c_ans == 1) ? 'selected' : '' }}> True </option>
                                        <option value="0" {{ ($edit_data->c_ans == 0) ? 'selected' : '' }}> False </option>
                                    </select>


                                </div>
                                <span id="trueFalseAnswer_error" class="error"></span>
                            </div>

                        </div>
                        <!-- End True/False Sub options -->




                        <!-- Descriptive Sub-options -->
                        <div class="col-12 col-md-12" id="descrip_section">

                        </div>
                        <!-- Descriptive Sub options -->

                        <!-- Hidden input -->
                        <input type="hidden" name="qst_type_name" id="qst_type_name" value="{{ $edit_data->question_type }}">

                        <!-- Submit button -->
                        <div class="col-12 col-md-12 mt-5">
                            <button class="btn btn-primary float-right p-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                        </div>

                    </div>

                </fieldset>
            </form>
        </div>
    </div>
    <!-- End Page Content -->


</div>
<!-- Exam Type AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#update_qstGroup_form').validate();

    $(document).ready(function() {

        //  ---------- Question Bank Ajax goes here ---------->  
        $('#singleChoice_section').css('display', 'none');
        $('#mcqChoice_section').css('display', 'none');
        $('#trueFalse_section').css('display', 'none');
        $('#descrip_section').css('display', 'none');





        // Default edit mode selected question type
        $('#singleChoice_section').css('display', 'none');
        let questionType = $('#question_type').val();

        // During default selected question type
        if (questionType == 1) {
            $('#singleChoice_section').css('display', 'block');

            $(document).on('change', '#sc_total_option', function(e) {
                e.preventDefault();

                let sc_totalOption = $('#sc_total_option').val();
                $('#sc_optionBox').empty();
                $('#sc_answer').empty();
                $('#sc_optionBox').removeClass('mt-4');
                $('#sc_answerWrapper').removeClass('mt-3');


                for (i = 1; i <= sc_totalOption; i++) {

                    let sc_singleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
                    // let errMsg = $('<span id="sc_singleOption_error" class="error"></span>');
                    let label = $('<label for="sc_singleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="sc_singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="sc_singleOption">');

                    sc_singleOption.append(label);
                    // sc_singleOption.append(errMsg);
                    $('#sc_optionBox').append(sc_singleOption);
                    $('#sc_optionBox').addClass('mt-4');
                    $('#sc_answerWrapper').addClass('mt-3');

                    // Answer section
                    $('#sc_answer').append('<option value="' + [i] + '">Option ' + [i] + '</option>');

                }
            })
        }


        //  ----------   Multiple Choice   ---------->
        if (questionType == 2) {
            $('#mcqChoice_section').css('display', 'block');

            $(document).on('change', '#mcq_total_option', function(e) {
                e.preventDefault();

                let totalOption = $('#mcq_total_option').val();
                $('#mcq_ansBox').empty();
                $('#mcqOptionBox').empty();
                $('#mcqOptionBox').removeClass('mt-4');
                $('#mcqAnswerWrapper').removeClass('mt-3');


                for (i = 1; i <= totalOption; i++) {

                    let singleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
                    // let errMsg = $('<span id="singleOption_error" class="error"></span>');
                    let label = $('<label for="mcqSingleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="mcqSingleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="mcqSingleOption">');

                    // let ansOpt = $('<div class="form-check form-check-inline"><input class="form-check-input mb-2" type="checkbox" name="answer[]" id="mcq_ans_chkbox' + [i] + '" value="' + [i] + '"><label class="form-check-label mb-2" for="mcq_ans_chkbox' + [i] + '">Option ' + [i] + '</label>&nbsp;</div> ');

                    let ansOpt = $('<div class="form-check form-check-inline"><input class="form-check-input mb-2" type="checkbox" name="mcq_answer[]" id="mcq_answer' + [i] + '" value="' + [i] + '"><label class="form-check-label mb-2" for="mcq_answer' + [i] + '">Option ' + [i] + '</label></div> ');

                    singleOption.append(label);
                    // singleOption.append(errMsg);
                    $('#mcqOptionBox').append(singleOption);
                    $('#mcqOptionBox').addClass('mt-4');
                    $('#mcqAnswerWrapper').addClass('mt-3');

                    // Answer section
                    $('#mcq_ansBox').append(ansOpt);

                }
            })
        }
        //  ----------   End Multiple Choice   ---------->


        //  ----------   True/False Choice   ---------->
        if (questionType == 3) {
            $('#trueFalse_section').css('display', 'block');
        }
        //  ----------   End True/False Choice   ---------->



        //  ----------   Descriptive Section   ---------->
        if (questionType == 4) {
            $('#descrip_section').css('display', 'block');
        }
        //  ----------   End Descriptive Section   ---------->






        //----- During jquery on change selected question type
        $(document).on('change', '#question_type', function(e) {

            $('#singleChoice_section').css('display', 'none');
            $('#mcqChoice_section').css('display', 'none');
            $('#trueFalse_section').css('display', 'none');
            $('#descrip_section').css('display', 'none');


            let selectedQuestionType = $('#question_type').val();
            let qst_type_name = $('#qst_type_name').val();


            if (selectedQuestionType != qst_type_name) {
                $('#question').css('color', 'transparent');
            } else {
                $('#question').css('color', 'inherit');
            }


            if (selectedQuestionType == 1) {
                $('#singleChoice_section').css('display', 'block');


                if (questionType == 1) {
                    $('#singleChoice_section').css('display', 'block');

                    $(document).on('change', '#sc_total_option', function(e) {
                        e.preventDefault();

                        let sc_totalOption = $('#sc_total_option').val();
                        $('#sc_optionBox').empty();
                        $('#sc_answer').empty();
                        $('#sc_optionBox').removeClass('mt-4');
                        $('#sc_answerWrapper').removeClass('mt-3');


                        for (i = 1; i <= totalOption; i++) {

                            let sc_singleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
                            // let errMsg = $('<span id="sc_singleOption_error" class="error"></span>');
                            let label = $('<label for="sc_singleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="sc_singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="sc_singleOption">');

                            sc_singleOption.append(label);
                            // sc_singleOption.append(errMsg);
                            $('#sc_optionBox').append(sc_singleOption);
                            $('#sc_optionBox').addClass('mt-4');
                            $('#sc_answerWrapper').addClass('mt-3');

                            // Answer section
                            $('#sc_answer').append('<option value="' + [i] + '">Option ' + [i] + '</option>');

                        }
                    })
                }
            }



            //  ----------   Multiple Choice   ---------->
            if (selectedQuestionType == 2) {
                $('#mcqChoice_section').css('display', 'block');

                $(document).on('change', '#mcq_total_option', function(e) {
                    e.preventDefault();

                    let totalOption = $('#mcq_total_option').val();
                    $('#mcq_ansBox').empty();
                    $('#mcqOptionBox').empty();
                    $('#mcqOptionBox').removeClass('mt-4');
                    $('#mcqAnswerWrapper').removeClass('mt-3');


                    for (i = 1; i <= totalOption; i++) {

                        let singleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
                        // let errMsg = $('<span id="singleOption_error" class="error"></span>');
                        // let label = $('<label for="singleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="sc_singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="singleOption">');

                        let label = $('<label for="mcqSingleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="mcqSingleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="mcqSingleOption">');

                        let ansOpt = $('<div class="form-check form-check-inline"><input class="form-check-input mb-2" type="checkbox" name="answer[]" id="mcq_ans_chkbox' + [i] + '" value="' + [i] + '"><label class="form-check-label mb-2" for="mcq_ans_chkbox' + [i] + '">Option ' + [i] + '</label>&nbsp;</div> ');

                        singleOption.append(label);
                        // singleOption.append(errMsg);
                        $('#mcqOptionBox').append(singleOption);
                        $('#mcqOptionBox').addClass('mt-4');
                        $('#mcqAnswerWrapper').addClass('mt-3');

                        // Answer section
                        $('#mcq_ansBox').append(ansOpt);

                    }
                })
            }
            //  ----------   End Multiple Choice   ---------->


            //  ----------   True/False Choice   ---------->
            if (selectedQuestionType == 3) {
                $('#trueFalse_section').css('display', 'block');
            }
            //  ----------   End True/False Choice   ---------->



            //  ----------   Descriptive Section   ---------->
            if (selectedQuestionType == 4) {
                $('#descrip_section').css('display', 'block');
            }
            //  ----------   End Descriptive Section   ---------->
        })




        // ----------   Question Bank Single Choice   ---------->

        // if (questionType == 1) {
        //     $('#singleChoice_section').css('display', 'block');
        //     let without_onChange_existTotalOption = $('#exist_total_option').val();

        //     $(document).on('change', '#exist_total_option', function(e) {
        //         e.preventDefault();

        //         let existTotalOption = $('#exist_total_option').val();
        //         let newCurrent = $('#current_total_option').attr('value', existTotalOption);
        //         let currentTotalOption = newCurrent.val();






        //         // ------- Different between (existTotalOption, currentTotalOption) ------->
        //         if ($('#exist_total_option').attr('updatedExistTotalOpt') != undefined) {

        //             updatedExistTotalOpt = $('#exist_total_option').attr('updatedexisttotalopt');
        //             // alert('currentTotalOption ' + Number(currentTotalOption));
        //             // alert('updatedExistTotalOpt ' + Number(updatedExistTotalOpt));

        //             if (currentTotalOption > updatedExistTotalOpt) {
        //                 alert('if');
        //                 let diff_value = currentTotalOption - updatedExistTotalOpt;
        //                 alert('diff_value is : ' + diff_value);

        //                 $('#optionBox').empty();
        //                 $('#answer').empty();
        //                 $('#optionBox').removeClass('mt-4');
        //                 $('#answerWrapper').removeClass('mt-3');


        //                 for (i = 1; i <= currentTotalOption; i++) {

        //                     let singleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
        //                     let label = $('<label for="singleOption" class="form-label label_name">Option' + ' ' + [i + parseInt(updatedexisttotalopt)] + ' <span  class="text-danger fillable">*</span></label><input type="text" name="singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="singleOption">');

        //                     $(singleOption).empty(label);
        //                     singleOption.append(label);
        //                     $('#optionBox').append(singleOption);
        //                     $('#optionBox').addClass('mt-4');
        //                     $('#answerWrapper').addClass('mt-3');


        //                     // Answer section
        //                     $('#answer').append('<option value="' + [i] + '">Option ' + [i] + '</option>');

        //                 }

        //                 $('#exist_total_option').attr('updatedExistTotalOpt', currentTotalOption);





        //             }

        //         } 

        //     })
        // }
        // ----------   End Question Bank Single Choice   ---------->

        //  ---------- End Question Bank Ajax here  ---------->






        // Update Data
        $('#update_qstBank_form').submit(function(e) {
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

            var id = $(this).attr('edit_id');
            var url = '{{ route("question-bank.update", ":id") }}';
            url = url.replace(':id', id);

            if (isValid) {
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            alert('Question bank updated Successfully');
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
<!-- End Exam Type AJAX -->
@endsection