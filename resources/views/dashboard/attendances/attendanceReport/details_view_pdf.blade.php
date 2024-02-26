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
        
    </style>
</head>

<body>
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

        <table id="attendanceReportTable_details_view">
            <thead>
                <tr>
                    <th>Student name</th>
                    <th>Roll NO</th>
                    <th>Admission NO</th>
                    <th>Class (Section)</th>
                    <th>Date</th>
                    <th>Attendance</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>

                @foreach($students as $student)
       
                <tr>
                    <td>{{ $student->first_name . ' ' . $student->last_name }}</td>
                    <td>{{ $student->roll_no }}</td>
                    <td>{{ $student->admission_no }}</td>


                    <!-- Student Class(section) -->
                    <td>

                        @foreach($classes as $class)

                        @if($student->class_id == $class->id)
                        {{ $class->name }}
                        @endif
                        @endforeach


                        @foreach($sections as $section)

                        @if($student->section_id == $section->id)
                        {{ '(' . $section->name . ')'}}
                        @endif
                        @endforeach

                    </td>


                    <!-- Attendance Date -->
                    <td>
                        @php
                        $attendance_date = \Carbon\Carbon::parse($student->attendance_date)->format('d M Y');
                        @endphp
                        {{ $attendance_date }}
                    </td>


                    <!-- Attendance -->
                    <td>
                        @if($student->attendance == 'P')
                        <span style="color: #29d697">{{ 'Present' }}</span>

                        @elseif($student->attendance == 'L')
                        <span style="color: rgb(255 189 39)">{{ 'Late' }}</span>

                        @elseif($student->attendance == 'A')
                        <span style="color: rgb(245, 53, 53)">{{ 'Absent' }}</span>

                        @elseif($student->attendance == 'F')
                        <span style="color: rgb(23, 162, 184)">{{ 'Halfday' }}</span>
                        @endif
                    </td>


                    <!-- Note -->
                    <td>
                        {{ $student->note }}
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <!-- Card Body -->
</body>

</html>

