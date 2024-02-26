@extends('dashboard.master')

@section('title')
Create Question Bank
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
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Online Examination</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('question-bank.index') }}">Question Bank</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
    <!-- End Page Heading & Breadcrumb -->



    <div class="row">
        <div class="col-12 col-md-12">

            <form action="#" method="" class="card" id="qstBank_form">
                <fieldset>
                    @csrf
                    <div class="inputs_data row card-body py-5">

                        <!-- Question Type -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="question_type" class="form-label label_name">Question Type <span class="text-danger fillable">*</span></label>

                                <select class="select2_states" name="question_type" id="question_type" required>
                                    <option> Select Type </option>
                                    <option value="1"> Single Choice </option>
                                    <option value="2"> Multiple Choice </option>
                                    <option value="3"> True / False </option>
                                    <option value="4"> Descriptive </option>
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
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
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
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Mark -->
                        <div class="col-12 col-md-3">
                            <div class="mb-3">
                                <label for="mark" class="form-label label_name">Mark <span class="text-danger fillable">*</span></label>

                                <input type="number" name="mark" min="1" class="keyword form-control inputs mr-2" placeholder="Enter mark" id="mark" required>

                                <span id="mark_error" class="error"></span>
                            </div>
                        </div>

                        <!-- Question -->
                        <div class="col-12 col-md-12">
                            <div class="mb-3">
                                <label for="question" class="form-label label_name">Question <span class="text-danger fillable">*</span></label>

                                <input type="text" name="question" class="form-control inputs mr-2" placeholder="Enter question" id="question" required>

                                <span id="question_error" class="error"></span>
                            </div>
                        </div>


                        <!-- Single Choice Sub-options -->
                        <div class="col-12 col-md-12" id="singleChoice_section">

                            <!-- Total option -->
                            <div class="col-12 col-md-12 mb-5 px-0" id="sc_totalOption_wrapper">
                                <div class="mb-3 d-flex flex-column">
                                    <label for="sc_total_option" class="form-label label_name">Total option <span class="text-danger fillable">*</span></label>

                                    <select class=" form-control inputs" name="sc_total_option" id="sc_total_option" required>

                                        <option value="0" selected>Select Option</option>
                                        @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor

                                    </select>

                                    <span id="sc_total_option_error" class="error"></span>
                                </div>
                            </div>

                            <!-- Option box -->
                            <div class="row col-12 col-md-12 px-0" id="sc_optionBox"></div>


                            <!-- Answer -->
                            <div class="col-12 col-md-12 px-0 " id="sc_answerWrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="sc_answer" class="form-label label_name">Answer <span class="text-danger fillable">*</span></label>

                                    <select class="select2_states form-control inputs" name="sc_answer" id="sc_answer" required>
                                        <option value="0"> Select Option </option>
                                    </select>

                                    <!-- Option box -->
                                    <div class="row col-12 col-md-12 px-0" id="sc_answerBox">


                                    </div>
                                    <span id="sc_answer_error" class="error"></span>
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

                                    <select class=" form-control inputs" name="mcq_total_option" id="mcq_total_option" required>

                                        <option value="0" selected>Select Option</option>
                                        @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor

                                    </select>

                                    <span id="mcq_total_option_error" class="error"></span>
                                </div>
                            </div>

                            <!-- Option box -->
                            <div class="row col-12 col-md-12 px-0" id="mcq_OptionBox"></div>


                            <!-- Answer -->
                            <div class="col-12 col-md-12 px-0 " id="mcq_AnswerWrapper">

                                <div class="mb-3 d-flex flex-column">
                                    <label for="mcq_Answer" class="form-label label_name">Answer <span class="text-danger fillable">*</span></label>


                                    <!-- Option box -->
                                    <div class="mb-3 justify-content-start align-items-center" id="mcq_ansBox">





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
                                        <option value="1"> True </option>
                                        <option value="0"> False </option>
                                    </select>


                                </div>
                                <span id="trueFalseAnswer_error" class="error"></span>
                            </div>

                        </div>
                    </div>
                    <!-- End True/False Sub options -->


                    <!-- Descriptive Sub-options -->
                    <div class="col-12 col-md-12" id="descrip_section">

                    </div>
                    <!-- Descriptive Sub options -->


                    <!-- Submit button -->
                    <div class="col-12 col-md-12">
                        <button class="btn btn-primary float-right p-3 mb-5 mr-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>


                </fieldset>
            </form>
        </div>
    </div>

</div>

<!-- End Page Content -->



<!-- Department AJAX -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $('#qstGroup_form').validate();

    $(document).ready(function() {


        //  ---------- Question Bank Ajax goes here ---------->
        $('#singleChoice_section').css('display', 'none');
        $('#mcqChoice_section').css('display', 'none');
        $('#trueFalse_section').css('display', 'none');
        $('#descrip_section').css('display', 'none');

        $(document).on('change', '#question_type', function(e) {
            e.preventDefault();


            // ----------   Question Bank Single Choice   ---------->
            $('#singleChoice_section').css('display', 'none');
            $('#mcqChoice_section').css('display', 'none');
            $('#trueFalse_section').css('display', 'none');
            $('#descrip_section').css('display', 'none');

            let questionType = $('#question_type').val();

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
                        let label = $('<label for="sc_singleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="sc_singleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="sc_singleOption" required><span id="sc_singleOption_error" class="error"></span>');

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
            // ----------   End Question Bank Single Choice   ---------->





            //  ----------   Multiple Choice   ---------->
            if (questionType == 2) {
                $('#mcqChoice_section').css('display', 'block');

                $(document).on('change', '#mcq_total_option', function(e) {
                    e.preventDefault();

                    let totalOption = $('#mcq_total_option').val();
                    $('#mcq_ansBox').empty();
                    $('#mcq_OptionBox').empty();
                    $('#mcq_OptionBox').removeClass('mt-4');
                    $('#mcq_AnswerWrapper').removeClass('mt-3');


                    for (i = 1; i <= totalOption; i++) {

                        let mcqSingleOption = $('<div class="col-12 col-md-3 mb-4"></div>');
                        // let errMsg = $('<span id="mcq_SingleOption_error" class="error"></span>');
                        let label = $('<label for="mcq_SingleOption" class="form-label label_name">Option' + ' ' + i + ' <span  class="text-danger fillable">*</span></label><input type="text" name="mcq_SingleOption[]" class="form-control inputs mr-2" placeholder="Enter option" id="mcq_SingleOption" required><span id="mcq_SingleOption_error" class="error"></span>');

                        let ansOpt = $('<div class="form-check form-check-inline"><input class="form-check-input mb-2" type="checkbox" name="mcq_answer[]" id="mcq_answer' + [i] + '" value="' + [i] + '"><label class="form-check-label mb-2" for="mcq_answer' + [i] + '">Option ' + [i] + '</label>&nbsp;</div> ');

                        mcqSingleOption.append(label);
                        // singleOption.append(errMsg);
                        $('#mcq_OptionBox').append(mcqSingleOption);
                        $('#mcq_OptionBox').addClass('mt-4');
                        $('#mcq_AnswerWrapper').addClass('mt-3');

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




        })
        //  ---------- End Question Bank Ajax here  ---------->




        // ---------- Store Question Data ---------->
        $('#qstBank_form').submit(function(e) {
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
                    url: "{{ route('question-bank.store') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        console.log(res);
                        if (res.success == true) {
                            $('#qstBank_form')[0].reset();
                            alert('Added successfully');
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
        })
        // ---------- End Store Question Data ---------->





    });
</script>
<!-- End Department AJAX -->
@endsection