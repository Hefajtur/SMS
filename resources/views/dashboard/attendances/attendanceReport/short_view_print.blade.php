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
    <div class="card-body attendance_report_table table-responsive" id="report_table">
        <table class="table table-bordered" id="attendanceReportTable">
            <thead>
                <tr>
                    <th scope="col" class="report_info_td">Name</th>
                    <th scope="col">Roll NO</th>
                    <th scope="col">Admission NO</th>

                    @for($i = 1; $i <= 31; $i++) <th scope="col" class="report_date_th"> {{ $i }} </th>
                        @endfor

                        <th scope="col" class="text-success report_info_td">P</th>
                        <th scope="col" class="text-warning report_info_td">L</th>
                        <th scope="col" class="text-danger report_info_td">A</th>
                        <th scope="col" class="text-primary report_info_td">F</th>

                </tr>
            </thead>
            <tbody id="details_view_tbody">

                @foreach($students as $student)
                <tr>
                    <td>{{ $student['first_name'] . ' ' . $student['last_name'] }}</td>
                    <td>{{ $student['roll_no'] }}</td>
                    <td>{{ $student['admission_no'] }}</td>

                    @php
                    $present = [];
                    $absent = [];
                    $late = [];
                    $halfday = [];
                    @endphp

                    <!-- Attendance type -->
                    @for($i = 1; $i <= 31; $i++) <td>

                        @foreach($student['attendance'] as $data)

                        @php
                        $attendance_date = \Carbon\Carbon::parse($data['attendance_date'])->format('d')
                        @endphp

                        @if($attendance_date == $i)

                        @if($data['attendance'] == 'P')

                        @php
                        $present[] = $data['attendance'];
                        @endphp


                        <span class="text-success">{{ $data['attendance'] }}</span>

                        @elseif($data['attendance'] == 'L')

                        @php
                        $late[] = $data['attendance'];
                        @endphp

                        <span class="text-warning">{{ $data['attendance'] }}</span>

                        @elseif($data['attendance'] == 'A')

                        @php
                        $absent[] = $data['attendance'];
                        @endphp

                        <span class="text-danger">{{ $data['attendance'] }}</span>

                        @elseif($data['attendance'] == 'F')

                        @php
                        $halfday[] = $data['attendance'];
                        @endphp

                        <span class="text-primary">{{ $data['attendance'] }}</span>
                        @endif
                        @endif

                        @endforeach
                        </td>

                        @endfor


                        <!-- Total attendance for Present -->
                        <td>
                            <span style="color: #29d697"> {{ count($present) }}</span>
                        </td>

                        <!-- Total attendance for Late -->
                        <td>
                            <span style="color: rgb(255 189 39)"> {{ count($late) }}</span>
                        </td>

                        <!-- Total attendance for Absent -->
                        <td>
                            <span style="color: rgb(245, 53, 53)"> {{ count($absent) }}</span>
                        </td>

                        <!-- Total attendance for Halfday -->
                        <td>
                            <span style="color: rgb(23, 162, 184)"> {{ count($halfday) }}</span>
                        </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- Card Body -->
</body>

<script type="text/javascript">
    window.print();
</script>

</html>