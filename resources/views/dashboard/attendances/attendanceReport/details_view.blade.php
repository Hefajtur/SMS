<div class="print_download_button my-4 mx-3">
    <a href="{{ route('attendanceReport.print_detailsView') }}" class="print p-3 rounded btn btn-primary mr-2" id="print_btn">Print Now <i class="fa-solid fa-print"></i></a>
    <a href="{{ route('attendanceReport.details_view_download_pdf') }}" class="download p-3 rounded btn btn-primary">PDF Download <i class="fa-regular fa-file"></i></a>
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

    <table class="table table-bordered" id="attendanceReportTable_details_view">
        <thead>
            <tr>
                <th class="details_view_th">Student name</th>
                <th class="details_view_th">Roll NO</th>
                <th class="details_view_th">Admission NO</th>
                <th class="details_view_th">Class (Section)</th>
                <th class="details_view_th">Date</th>
                <th class="details_view_th">Attendance</th>
                <th class="details_view_th">Note</th>
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
                    <span class="badge_status_act">{{ 'Present' }}</span>

                    @elseif($student->attendance == 'L')
                    <span class="badge_status_warning">{{ 'Late' }}</span>

                    @elseif($student->attendance == 'A')
                    <span class="badge_status_inact">{{ 'Absent' }}</span>

                    @elseif($student->attendance == 'F')
                    <span class="badge_status_info">{{ 'Halfday' }}</span>
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

    <div class="paginate_nav row">
        <div class="col-12">
            <div class="pagination_button float-right mt-5">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Card Body -->
