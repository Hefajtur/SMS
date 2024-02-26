<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,500&display=swap" rel="stylesheet">

    <!-- Stylesheet -->
    <style>
        * {
            font-family: 'Lexend', sans-serif;
        }


        .color-red {
            color: red;
        }

        .bg-primary {
            background: #556ee6;
        }

        .text-center {
            text-align: center;
        }

        .rounded-top {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .mx-3 {
            margin-left: 0px 12px 0px 12px;
        }

        .pb-2 {
            padding-bottom: 8px;
        }

        .inline-block {
            display: inline-block;
        }

        .py-3 {
            padding: 12px 0px 12px 0px;
        }

        .d-none {
            display: none;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-end {
            justify-content: end;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .text-white {
            color: #fff;
        }

        #report_table {
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            border-collapse: collapse;
            text-align: center;
        }

        .card {
            width: 100%;
            background: white;
            margin: 0 auto;
            padding: 0px 0px 50px 0px;
        }

        .card-footer {
            background: whitesmoke;
            margin-top: 45px;
        }


        .attend_logo img {
            width: 250px;
        }

        .footer_logo img {
            width: 125px;
        }

        .card_footer_text {
            margin-top: -25px;
        }

        .dwnld_qst {
            margin-bottom: 0px;
            font-weight: 300;
        }

        h4.dwnld_qst {
            margin-bottom: 0px;
            font-weight: 400;
            font-size: 24px;
        }

        h4,
        h3 {
            margin: 0;
        }

        .card_footer_text {
            margin-top: 10px;
            font-size: 16px;
            font-weight: 300;
            color: #333;
        }

        .pdf_qst,
        .pdf_mark {
            font-weight: 500;
            font-size: 18px;
            color: #000;
        }

        .single_qst_heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="card">

        <!-- Card Header -->
        <div class="card-header text-center bg-primary mx-3 rounded-top">
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


        <!-- Card Body -->
        <div class="card-body" id="report_table">
   
            <div class="question_header">
                <div class="qst_header_content text-center">

                    @foreach($onlineExamData as $key => $value)

                    @if($value->online_exam_type->name == 'First')
                    <h4 class="dwnld_qst">{{ $value->online_exam_type->name .' '. 'term exam'  }}
                        <h4>

                            @elseif($value->online_exam_type->name == 'Mid')
                            <h4 class="dwnld_qst">{{ $value->online_exam_type->name .' '. 'term exam'  }}
                                <h4>

                                    @elseif($value->online_exam_type->name == 'Final')
                                    <h4 class="dwnld_qst">{{ $value->online_exam_type->name .' '. 'term exam'  }}
                                        <h4>

                                            @else
                                            <h4 class="dwnld_qst">{{ $value->online_exam_type->name }}
                                                <h4>

                                                    @endif



                                                    <span class="dwnld_qst">{{ 'Class: ' . $value->classes->name . ', ' . 'Section: ' .  $value->section->name }}</span><br>

                                                    <span class="dwnld_qst">{{ 'Mark: ' . $value->total_mark . ', ' }}</span>

                                                    @php
                                                    $start_time = \Carbon\Carbon::parse($value->start);
                                                    $end_time = \Carbon\Carbon::parse($value->end);

                                                    $hours_diff = $start_time->diffInHours($end_time);
                                                    $min_diff = $start_time->diffInMinutes($end_time);



                                                    if($hours_diff >= 24){

                                                    $totalDay = $start_time->diffInDays($end_time);
                                                    $remaining_hour = $hours_diff - $totalDay * 24;
                                                    $remaining_min;

                                                    echo 'Time: ' . $totalDay . ' Days' . ' ' . $remaining_hour . ' hours' . ' ';


                                                    }elseif($hours_diff < 24) { $totalHours=$start_time->diffInHours($end_time);

                                                        echo 'Time: ' . 0 . ' Days' . ' ' . $totalHours . ' hours' . ' ';

                                                        }

                                                        @endphp



                                                        @endforeach
                </div>
            </div>



            <div class="sub-heading" style="margin: 15px 0px 50px 0px;">
                <h2 class="text-center" style="font-size: 25px;">Online Exam Question</h2>
            </div>



            <!-- Question & Answer Options -->
            <div class="question_section">

                @foreach($questions as $key => $qst)
                <div class="single_qst" style="margin-bottom: 35px;">

                    <div class="single_qst_heading">

                        <span class="pdf_qst">{{ $key + 1 . '. ' . $qst->question }}</span>
                        <span class="pdf_mark">{{ $qst->mark }}</span>
                    </div>


                    <!-- If Question type is True / False -->
                    @if($qst->question_type == 3)
                    <span> {{ 1 . ' True' }} </span><br>
                    <span> {{ 2 . ' False' }} </span>
                    @endif


                    <!-- Answer Options -->
                    @foreach($qst->ans as $ans)
                    @if($ans->question_bank_id == $qst->id)
                    <p style="margin: 8px 0px 5px 0px;">{{ $loop->iteration . '. ' . $ans->single_option }}</p>
                    @endif
                    @endforeach
                </div>

                @endforeach
            </div>

        </div>
        <!-- Card Body -->

        <!-- Card Footer -->
        <div class="card-footer text-center mx-3 rounded-bottom">
            <div class="footer_logo pb-2 inline-block" style="padding-top: 20px;">
                <img src="{{ asset('/') }}/admin/assets/images/light_logo_footer.png" alt="Logo">
            </div>


            <!-- Card Header Text -->
            <div class="card_footer_text pb-2 text-dark">
                <h3>&copy; Onest Schooled - All right reserved</h3>
            </div>
        </div>
    </div>
</body>

</html>