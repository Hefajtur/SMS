<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Svg\Tag\Rect;

class AttendanceReportController extends Controller
{
    // attendance Report Index 
    public function attendanceReportIndex(Request $request)
    {


        if ($request->select_views == 0) {

            // $value = Session::get(['selectedClass', 'selectedSection', 'selectedMonth', 'selectedDate', 'selectedRoll']);
            // dd($value);

            $classes = Classes::all();
            $selectedClass = Session::get('selectedClass');
            $selectedSection = Session::get('selectedSection');
            $selectedMonth = Session::get('selectedMonth');
            $selectedDate = Session::get('selectedDate');
            $selectedRoll = Session::get('selectedRoll');

            $students = Student::with(['class', 'section', 'attendance' => function ($query) use ($selectedDate, $selectedMonth) {

                if (!is_null($selectedDate) && $selectedDate != '') {

                    return $query->where('attendance_date', \Carbon\Carbon::parse($selectedDate)->format('Y-m-d'));
                }

                if (!is_null($selectedMonth) && $selectedMonth != '') {

                    return $query->whereMonth('attendance_date', $selectedMonth);
                }
            }])->when($selectedClass, function ($query, $selectedClass) {

                return $query->where('class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {

                return $query->where('section_id', $selectedSection);
            })->when($selectedRoll, function ($query, $selectedRoll) {

                return $query->where('roll_no', $selectedRoll);
            })->paginate(4);


            if ($request->ajax()) {
                return view('dashboard.attendances.attendanceReport.short_view', compact('students'))->render();
            }
            return view('dashboard.attendances.attendanceReport.index', compact('students', 'classes'));
        } else {

            $selectedClass = Session::get('selectedClass');
            $selectedSection = Session::get('selectedSection');
            $selectedMonth = Session::get('selectedMonth');
            $selectedDate = Session::get('selectedDate');
            $selectedRoll = Session::get('selectedRoll');

            // \DB::enableQueryLog();

            $students = DB::table('attendances')->join('students', 'students.id', '=', 'attendances.std_id')
                ->when($selectedClass, function ($query, $selectedClass) {
                    return $query->where('students.class_id', $selectedClass);
                })->when($selectedSection, function ($query, $selectedSection) {
                    return $query->where('students.section_id', $selectedSection);
                })->when($selectedRoll, function ($query, $selectedRoll) {
                    return $query->where('students.roll_no', $selectedRoll);
                })->when($selectedDate, function ($query, $selectedDate) {
                    return $query->where('attendance_date', $selectedDate);
                })->when($selectedMonth, function ($query, $selectedMonth) {
                    return $query->whereMonth('attendance_date', $selectedMonth);
                })
                ->paginate(4); // Apply paginate(4) here

            $classes = Classes::all();
            $sections = Section::all();

            Session::put(['students' => $students, 'classes' => $classes, 'sections' => $sections]);

            if ($request->ajax()) {
                return view('dashboard.attendances.attendanceReport.details_view', compact('students', 'classes', 'sections'))->render();
            }

            return view('dashboard.attendances.attendanceReport.index', compact('students', 'classes', 'sections'));
        }













        // -------------------------------->
        // return view('dashboard.attendances.attendanceReport.short_view', [
        //     'classes' => $classes,
        //     'students' => [],
        // ])->render();

        // $classes = Classes::all();
        // return view('dashboard.attendances.attendanceReport.index', [
        //     'classes' => $classes,
        //     'students' => [],
        // ]);
    }


    // attendReportSection
    public function attendReportSection($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $sections = $sectionAll->toArray();
        return $sections;
    }



    // Attendance Report Filter Student
    public function filterView(Request $request)
    {

        if ($request->select_views == 0) {

            $selectedClass = $request->select_classes;
            Session::put('selectedClass', $selectedClass);
            $selectedSection = $request->select_section;
            Session::put('selectedSection', $selectedSection);
            $month = $request->month;
            $selectedMonth = \Carbon\Carbon::parse($month)->format('m');
            Session::put('selectedMonth', $selectedMonth);
            $selectedDate = $request->date;
            Session::put('selectedDate', $selectedDate);
            $selectedRoll = $request->roll;
            Session::put('selectedRoll', $selectedRoll);
            
            $students = Student::with(['class', 'section', 'attendance' => function ($query) use ($selectedDate, $selectedMonth) {

                if (!is_null($selectedDate) && $selectedDate != '') {

                    return $query->where('attendance_date', \Carbon\Carbon::parse($selectedDate)->format('Y-m-d'));
                }

                if (!is_null($selectedMonth) && $selectedMonth != '') {

                    return $query->whereMonth('attendance_date', $selectedMonth);
                }
            }])->when($selectedClass, function ($query, $selectedClass) {

                return $query->where('class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {

                return $query->where('section_id', $selectedSection);
            })->when($selectedRoll, function ($query, $selectedRoll) {

                return $query->where('roll_no', $selectedRoll);
            })
            // ->get();
            ->paginate(4);

            // dd($students);


            if ($request->ajax()) {
                return view('dashboard.attendances.attendanceReport.short_view', compact('students'));
            }
            return view('dashboard.attendances.attendanceReport.short_view', compact('students'));
        } else {

            $selectedClass = $request->select_classes;
            Session::put('selectedClass', $selectedClass);
            $selectedSection = $request->select_section;
            Session::put('selectedSection', $selectedSection);
            $month = $request->month;
            $selectedMonth = \Carbon\Carbon::parse($month)->format('m');

            Session::put('selectedMonth', $selectedMonth);
            $selectedDate = $request->date;
            Session::put('selectedDate', $selectedDate);
            $selectedRoll = $request->roll;
            Session::put('selectedRoll', $selectedRoll);


            $students = Attendance::join('students', 'students.id', '=', 'attendances.std_id')
                ->when($selectedClass, function ($query, $selectedClass) {
                    return $query->where('students.class_id', $selectedClass);
                })->when($selectedSection, function ($query, $selectedSection) {
                    return $query->where('students.section_id', $selectedSection);
                })->when($selectedRoll, function ($query, $selectedRoll) {
                    return $query->where('students.roll_no', $selectedRoll);
                })->when($selectedDate, function ($query, $selectedDate) {
                    return $query->where('attendance_date', $selectedDate);
                })->when($selectedMonth, function ($query, $selectedMonth) {
                    return $query->whereMonth('attendance_date', $selectedMonth);
                })
                    // ->get();
                ->paginate(5);

                // dd($students);

 
            $classes = Classes::all();
            $sections = Section::all();

            Session::put(['students' => $students, 'classes' => $classes, 'sections' => $sections]);

            if ($request->ajax()) {
                return view('dashboard.attendances.attendanceReport.details_view', compact('students', 'classes', 'sections'));
            }
            return view('dashboard.attendances.attendanceReport.details_view', compact('students', 'classes', 'sections'));
        }
    }



    // Generate PDF (Short view)
    public function short_view_download_pdf(Request $request)
    {
        $selectedClass = Session::get('selectedClass');
        $selectedSection = Session::get('selectedSection');
        $selectedMonth = Session::get('selectedMonth');
        $selectedDate = Session::get('selectedDate');
        $selectedRoll = Session::get('selectedRoll');


        $students = Student::with(['class', 'section', 'attendance' => function ($query) use ($selectedDate, $selectedMonth) {

            if (!is_null($selectedDate) && $selectedDate != '') {

                return $query->where('attendance_date', \Carbon\Carbon::parse($selectedDate)->format('Y-m-d'));
            }

            if (!is_null($selectedMonth) && $selectedMonth != '') {

                return $query->whereMonth('attendance_date', $selectedMonth);
            }
        }])->when($selectedClass, function ($query, $selectedClass) {

            return $query->where('class_id', $selectedClass);
        })->when($selectedSection, function ($query, $selectedSection) {

            return $query->where('section_id', $selectedSection);
        })->when($selectedRoll, function ($query, $selectedRoll) {

            return $query->where('roll_no', $selectedRoll);
        })
            ->get();

        // $customPaper = [0, 0, 567.00, 500.80];
        $pdf = Pdf::loadView('dashboard.attendances.attendanceReport.short_view_pdf', compact('students'))->setPaper('a4', 'landscape');
        return $pdf->download('Attendance_report' . '_' . date('d-m-Y') . '.pdf');
    }


    // Generate PDF (Details view)
    public function details_view_download_pdf(Request $request)
    {
        $selectedClass = Session::get('selectedClass');
        $selectedSection = Session::get('selectedSection');
        $selectedMonth = Session::get('selectedMonth');
        $selectedDate = Session::get('selectedDate');
        $selectedRoll = Session::get('selectedRoll');


        $students = Attendance::join('students', 'students.id', '=', 'attendances.std_id')
            ->when($selectedClass, function ($query, $selectedClass) {
                return $query->where('students.class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {
                return $query->where('students.section_id', $selectedSection);
            })->when($selectedRoll, function ($query, $selectedRoll) {
                return $query->where('students.roll_no', $selectedRoll);
            })->when($selectedDate, function ($query, $selectedDate) {
                return $query->where('attendance_date', $selectedDate);
            })->when($selectedMonth, function ($query, $selectedMonth) {
                return $query->whereMonth('attendance_date', $selectedMonth);
            })
            ->get();


        $classes = Classes::all();
        $sections = Section::all();

        $pdf = Pdf::loadView('dashboard.attendances.attendanceReport.details_view_pdf', compact('students', 'classes', 'sections'))->setPaper('a4', 'landscape');;

        return $pdf->download('Attendance_report' . '_' . date('d-m-Y') . '.pdf');
    }



    // Print PDF (Short Report)
    public function print_shortView(Request $request)
    {        
        $selectedClass = Session::get('selectedClass');
        $selectedSection = Session::get('selectedSection');
        $selectedMonth = Session::get('selectedMonth');
        $selectedDate = Session::get('selectedDate');
        $selectedRoll = Session::get('selectedRoll');


        $students = Student::with(['class', 'section', 'attendance' => function ($query) use ($selectedDate, $selectedMonth) {

            if (!is_null($selectedDate) && $selectedDate != '') {

                return $query->where('attendance_date', \Carbon\Carbon::parse($selectedDate)->format('Y-m-d'));
            }

            if (!is_null($selectedMonth) && $selectedMonth != '') {

                return $query->whereMonth('attendance_date', $selectedMonth);
            }
        }])->when($selectedClass, function ($query, $selectedClass) {

            return $query->where('class_id', $selectedClass);
        })->when($selectedSection, function ($query, $selectedSection) {

            return $query->where('section_id', $selectedSection);
        })->when($selectedRoll, function ($query, $selectedRoll) {

            return $query->where('roll_no', $selectedRoll);
        })
            ->get();


        return view('dashboard.attendances.attendanceReport.short_view_print', compact('students'));
    }


    // Print PDF (Details Report)
    public function print_detailsView(Request $request)
    {

        $selectedClass = Session::get('selectedClass');
        $selectedSection = Session::get('selectedSection');
        $selectedMonth = Session::get('selectedMonth');
        $selectedDate = Session::get('selectedDate');
        $selectedRoll = Session::get('selectedRoll');


        $students = Attendance::join('students', 'students.id', '=', 'attendances.std_id')
            ->when($selectedClass, function ($query, $selectedClass) {
                return $query->where('students.class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {
                return $query->where('students.section_id', $selectedSection);
            })->when($selectedRoll, function ($query, $selectedRoll) {
                return $query->where('students.roll_no', $selectedRoll);
            })->when($selectedDate, function ($query, $selectedDate) {
                return $query->where('attendance_date', $selectedDate);
            })->when($selectedMonth, function ($query, $selectedMonth) {
                return $query->whereMonth('attendance_date', $selectedMonth);
            })
            ->get();


        $classes = Classes::all();
        $sections = Section::all();

        return view('dashboard.attendances.attendanceReport.details_view_print', compact('students', 'classes', 'sections'));
    }
}
