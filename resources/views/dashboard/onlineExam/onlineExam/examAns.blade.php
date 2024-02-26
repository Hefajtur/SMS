@extends('dashboard.master')

@section('title')
Online Exam Answer
@endsection

<!-- Online Exam area -->
@section('body')
<div class="container py-5 px-5">

    <div class="row">
        <div class="col-12 col-md-12 pt-5 px-0">
            <div class="card viewStdAns_page px-4">

                <!-- Card Header -->
                <div class="card-header text-center bg-primary mx-3 mb-5 rounded-top">
                    <div class="attend_logo pb-2 inline-block" style="padding-top: 20px;">
                        <img src="{{ asset('/') }}/admin/assets/images/light.png" alt="Logo">
                    </div>

                    <div class="verticle_seperator"></div>

                    <!-- Card Header Text -->
                    <div class="card_header_text py-3 text-white">
                        <h3>Onest Schooled - School Management System</h3>
                        <h4>Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
                    </div>
                </div>


                <!-- {{ $examData }} -->

                <!-- {{ $questions }} -->


                <!-- Middle Content -->
                <div class="middle_content card py-3">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div class="xm_title col-12 col-md-7" style="font-size: 18px; font-weight: 300;">
                            <span class="col-12 col-md-4">Exam Name: </span>
                            @foreach($examData as $data)

                            @if($data->online_exam_type->name == 'First')
                            <span class="col-12 col-md-8 text-center">{{ $data->online_exam_type->name .' '. 'term exam' }}</span>

                            @elseif($data->online_exam_type->name == 'Mid')
                            <span class="col-12 col-md-8 text-center">{{ $data->online_exam_type->name .' '. 'term exam'  }}</span>

                            @elseif($data->online_exam_type->name == 'Final')
                            <span class="col-12 col-md-8 text-center">{{ $data->online_exam_type->name .' '. 'term exam'  }}</span>

                            @else
                            <span class="col-12 col-md-8 text-center">{{ $data->online_exam_type->name }}</span>

                            @endif

                            @if($data->online_exam_type->name != 'First' || $data->online_exam_type->name != 'Mid' || $data->online_exam_type->name != 'Final')


                            @endif

                            @endforeach
                        </div>

                        <div class="xm_title col-12 col-md-5 d-flex justify-content-between" style="font-size: 18px; font-weight: 300;">
                            <span class="col-12 col-md-4">Mark: </span>
                            @foreach($examData as $data)
                            <span class="col-12 col-md-8 text-center">{{ $data->total_mark}}</span>
                            @endforeach
                        </div>


                    </div>
                </div>

                <div class="middle_Heading text-center my-5">
                    <h3 class="text-dark">Exam Answer</h3>
                </div>



                <!-- Card Body -->
                <div class="card">

                    <!-- {{ $questions }} -->

                    <div class="card-body">

                        <form action="#" method="" id="examAnsForm" formId="">

                            <!-- {{ $options }} -->
                            @foreach($questions as $qstKey => $qst)
                            <div class="question_body d-flex justify-content-around align-items-baseline">


                                <!-- Question Part -->
                                <div class="qstPart col-12 col-md-10 mb-4">

                                    <span class="xm_ans_Qst">
                                        {{ $loop->iteration . '. ' . $qst->question }}
                                    </span><br>

                                    <!-- Options Part -->
                                    @foreach($options as $ans)
                                    @if( $ans->question_bank_id == $qst->id )
                                    <span class="xm_ans_ans">
                                        {{ $loop->iteration .'. ' . $ans->single_option }}
                                    </span><br>

                                    @endif
                                    @endforeach


                                    <!-- Answer Indicate Part -->
                                    <span class="text-danger correct_ans">Answer: </span><span class="text-dark ans_digit">{{ $qst->c_ans }}</span><br>


                                    <!-- Correct Answer -->
                                    <span class="text-success correct_ans">Correct Answer: </span><span class="text-dark ans_digit">{{ $qst->c_ans }}</span>

                                </div>

                                <!-- Checkbox Part -->
                                <div class="xmAnsChkBox col-12 col-md-1 mb-3">
                                    <input type="checkbox" name="xm_ans_chkbox[]" id="xm_ans_chkbox{{ $qst->mark }}" value="{{ $qst->mark }}">
                                </div>


                                <!-- Mark Part -->
                                <div class="qstChkBox col-12 col-md-1 mb-3">
                                    @foreach($questions as $key => $qst)

                                    @if($qstKey == $key)

                                    <span class="xm_ans_mark">{{$qst->mark }}</span><br>
                                    @endif
                                    @endforeach
                                </div>

                            </div>
                            @endforeach


                            <!-- Submit Button -->
                            <div class="col-12 col-md-12 ml-2 mr-3">
                                <button type="" class="btn btn-primary text-white float-right inputs px-3" id="attend_report_search"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            </div>


                        </form>



                    </div>
                    <!-- End Card Body -->


                    <!-- Card Footer -->
                    <div class="card-footer text-center rounded-bottom mt-5">
                        <div class="footer_logo pb-2 inline-block" style="padding-top: 20px;">
                            <img src="{{ asset('/') }}/admin/assets/images/light_logo_footer.png" alt="Logo">
                        </div>


                        <!-- Card Header Text -->
                        <div class="card_footer_text pb-2 text-dark">
                            <h3>&copy; Onest Schooled - All right reserved</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>





        <!-- Page Content -->

        <!-- End Page Content -->



    </div>



    <!-- AJAX -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        $('#onlineExam_filterBar').validate();

        $(document).ready(function() {



        });
    </script>
    <!-- End AJAX -->
    @endsection