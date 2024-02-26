<div class="print_download_button my-4 mx-3">
    <a href="{{ route('attendanceReport.print_shortView') }}" class="print p-3 rounded btn btn-primary mr-2">Print Now <i class="fa-solid fa-print"></i></a>
    <a href="{{ route('attendanceReport.short_view_download_pdf') }}" class="download p-3 rounded btn btn-primary">PDF Download <i class="fa-regular fa-file"></i></a>
</div>

<!-- Card Header -->
<div class="card-header text-center bg-primary mx-3 rounded-top">
    <div class="attend_logo pb-2 inline-block">
        <img src="{{ asset('/') }}/admin/assets/images/light.png" alt="Logo">
    </div>
    <div class="verticle_seperator"></div>

    <!-- Card Header Text -->
    <div class="card_header_text py-3">
        <h3>Onest Schooled - School Management System</h3>
        <h4>Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
    </div>
</div>


<!-- Card Body Top -->

<div class="card-body-top pr-3 mt-2">
    <ul class="d-flex justify-content-end align-items-center">
        <li>
            <span class="text-success">Present = P</span>
        </li>
        <li>
            <span class="text-warning">Late = L</span>
        </li>
        <li>
            <span class="text-danger">Absent = A</span>
        </li>
        <li>
            <span class="text-primary">Half day = F</span>
        </li>
        <li>
            <span class="text-dark">Holiday = H</span>
        </li>
    </ul>
</div>

<!-- Card Body Top -->


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
                        <span class="text-success"> {{ count($present) }}</span>
                    </td>

                    <!-- Total attendance for Late -->
                    <td>
                        <span class="text-warning"> {{ count($late) }}</span>
                    </td>

                    <!-- Total attendance for Absent -->
                    <td>
                        <span class="text-danger"> {{ count($absent) }}</span>
                    </td>

                    <!-- Total attendance for Halfday -->
                    <td>
                        <span class="text-primary"> {{ count($halfday) }}</span>
                    </td>

            </tr>
            @endforeach
        </tbody>
    </table>


    <div class="paginate_nav row">
        <div class="col-12">
            <div class="pagination_button float-right mt-5">
                {{ $students->links() }}
            </div>
        </div>
    </div>

</div>
<!-- Card Body -->