<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\MarkRegister;
use App\Models\Shift;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Section;
use App\Models\Expense;
use App\Models\Cost;
use App\Models\Income;
use App\Models\IncomeExpense;
use App\Models\ClassRoutine;
use App\Models\ExamRoutine;
use App\Models\ExamType;
use App\Models\Day;
use App\Models\Type;
use App\Models\AssignData;
use PDF;
use DB;


class ReportController extends Controller
{
    public function marksheet(Request $request)
    {
        return view('dashboard.report.marksheet.index', [
            'classes' => Classes::all(),
            'examTypes' => ExamType::all(),
        ]);
    }
    public function getStudentMarksheet(Request $request)
    {
        $selectedClass = $request->class_id;
        $section = $request->section;
        $exam_type = $request->exam;
        $data = MarkRegister::where('mark_registers.class_id', $selectedClass)->where('mark_registers.section_id', $section)->where('mark_registers.exam_type', $exam_type)->groupBy('student_id')->with('students')->get();
        // dd($data);
        return response()->json(['success' => $data]);

    }
    public function marksheetOfStudent(Request $request)
    {

        $class = $request->class_id;
        $section = $request->section_id;
        $examType = $request->exam_type;
        $student = $request->student_id;
        // dd($student);
        $data = MarkRegister::where('class_id', $class)->where('section_id', $section)->where('exam_type', $examType)->where('student_id', $student)->with('class', 'section', 'exam', 'subject', 'students', )->get();
        // dd($data);
        return response()->json(['success' => $data]);

    }

    public function meritlist()
    {
        return view('dashboard.report.meritlist.index', [
            'classes' => Classes::all(),
            'shift' => Shift::all(),
            'exam_type' => ExamType::all(),
        ]);
    }
    public function meritSearch(Request $request)
    {
        // dd($request);
        $class = $request->class_id;
        $section = $request->section_id;
        $examType = $request->exam_type;
        $shift = $request->shift_id;

        $data = MarkRegister::select('students.id', 'students.first_name', 'students.last_name', DB::raw('SUM(mark_registers.total) as total_sum'), DB::raw('SUM(mark_registers.marks) as marks_sum'))
            ->join('students', 'students.id', '=', 'mark_registers.student_id')
            ->where('mark_registers.class_id', $class)
            ->where('mark_registers.section_id', $section)
            ->where('mark_registers.exam_type', $examType)
            ->where('students.shift_id', $shift)
            ->groupBy('students.id', 'students.first_name', 'students.last_name')
            ->with('class', 'section', 'exam')
            ->get();

        // echo "<pre/>";
        // print_r($data);
        // die;
        return response()->json(['success' => $data]);
    }

    public function progresscard()
    {
        return view('dashboard.report.progress.index', [
            'classes' => Classes::all(),
        ]);
    }
    public function getStudentProgress(Request $request)
    {
        $selectedClass = $request->class_id;
        $section = $request->section;
        $students = Student::where('class_id', $selectedClass)->where('section_id', $section)->get();
        return response()->json(['success' => $students]);

    }
    public function getProgressCard(Request $request)
    {
        // dd($request);
        $class = $request->class_id;
        $section = $request->section_id;
        $student = $request->student_id;

        $data = MarkRegister::where('class_id', $class)->where('section_id', $section)->where('student_id', $student)->with('class', 'section', 'exam', 'subject', 'students', )->get();
        return response()->json(['success' => $data]);
    }



    //duefess start
    public function duefees()
    {
        return view('dashboard.report.duefee.index', [
            'classes' => Classes::all(),
            'types' => Type::all(),
        ]);
    }


    //show dueFee data
    public function feesDueData(Request $request)
    {
        $class = $request->class;
        $section = $request->section;
        $feesValue = $request->feesValue;


        $data = DB::table('students')
            ->join('assign_data', 'students.id', '=', 'assign_data.students_id')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('sections', 'students.section_id', '=', 'sections.id')
            ->join('masters', 'assign_data.master_id', '=', 'masters.id')
            ->join('types', 'masters.type_id', '=', 'types.id')
            ->where('students.class_id', $class)
            ->where('students.section_id', $section)
            ->where('types.id', $feesValue)
            ->select(
                'students.admission_no',
                'students.first_name',
                'students.last_name',
                'classes.name as class_name',
                'sections.name as section_name',
                'types.name as type_name',
                'masters.amount as amount',
                'masters.fine_amount as fine_amount',
            )
            ->get();

        return response()->json($data);

    }


    //make pdf for dueFees_report
    public function dueFeesPdf(Request $request)
    {
        $class = $request->class;
        $section = $request->section;
        $feesValue = $request->feesValue;


        $data = DB::table('students')
            ->join('assign_data', 'students.id', '=', 'assign_data.students_id')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('sections', 'students.section_id', '=', 'sections.id')
            ->join('masters', 'assign_data.master_id', '=', 'masters.id')
            ->join('types', 'masters.type_id', '=', 'types.id')
            ->where('students.class_id', $class)
            ->where('students.section_id', $section)
            ->where('types.id', $feesValue)
            ->select(
                'students.admission_no',
                'students.first_name',
                'students.last_name',
                'classes.name as class_name',
                'sections.name as section_name',
                'types.name as type_name',
                'masters.amount as amount',
                'masters.fine_amount as fine_amount',
            )
            ->get();

        $data = ['data' => $data];

        $pdf = PDF::loadView('dashboard.report.duefee.mypdf', $data);
        return $pdf->download('dueFees_report.pdf');
    }


    //dueFees_report pdf print
    public function dueFeesPrint(Request $request)
    {
        $class = $request->class_id;
        $section = $request->section_id;
        $feesValue = $request->fees;


        $data = DB::table('students')
            ->join('assign_data', 'students.id', '=', 'assign_data.students_id')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('sections', 'students.section_id', '=', 'sections.id')
            ->join('masters', 'assign_data.master_id', '=', 'masters.id')
            ->join('types', 'masters.type_id', '=', 'types.id')
            ->where('students.class_id', $class)
            ->where('students.section_id', $section)
            ->where('types.id', $feesValue)
            ->select(
                'students.admission_no',
                'students.first_name',
                'students.last_name',
                'classes.name as class_name',
                'sections.name as section_name',
                'types.name as type_name',
                'masters.amount as amount',
                'masters.fine_amount as fine_amount',
            )
            ->get();

        $data = ['data' => $data];

        return view('dashboard.report.duefee.mypdf_print', $data);
    }
    //duefess end


    //feescollection start
    public function feescollection()
    {
        return view('dashboard.report.feescollection.index', [
            'classes' => Classes::all(),
        ]);
    }

    //show feescollection data
    public function getCollectionFees(Request $request)
    {

        $class = $request->class;
        $section = $request->section;
        $daterange = explode('-', $request->daterange);

        $date1 = date('Y-m-d', strtotime($daterange[0]));
        $date2 = date('Y-m-d', strtotime($daterange[1]));

        // $array1 = Income::where('income_expenses_id', $head)->whereBetween('date', [$date1, $date2])->sum('amount');

        $data = DB::table('students')
            ->join('assign_data', 'students.id', '=', 'assign_data.students_id')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('sections', 'students.section_id', '=', 'sections.id')
            ->join('masters', 'assign_data.master_id', '=', 'masters.id')
            ->join('types', 'masters.type_id', '=', 'types.id')
            ->where('students.class_id', $class)
            ->where('students.section_id', $section)
            ->whereBetween('masters.due_date', [$date1, $date2])
            ->select(
                'students.admission_no',
                'students.first_name',
                'students.last_name',
                'classes.name as class_name',
                'sections.name as section_name',
                'types.name as type_name',
                'masters.amount as amount',
                'masters.fine_amount as fine_amount',
                'masters.due_date as date',

            )
            ->get();

        return response()->json($data);

    }

    //feescollection end


    //transactions start
    public function transaction()
    {
        return view('dashboard.report.transactions.index', [
            'cost' => Cost::all(),
        ]);
    }

    //get income and expense name
    public function getName($id)
    {
        $incomeORexpense = IncomeExpense::where('type', $id)->get();
        return $incomeORexpense;
    }
    //filter
    public function filter(Request $request)
    {

        $cost = $request->cost;
        $head = $request->head;
        $datepicker = explode('-', $request->daterange);

        $date1 = date('Y-m-d', strtotime($datepicker[0]));
        $date2 = date('Y-m-d', strtotime($datepicker[1]));

        $income = Income::with('incomeExpenses')->where('income_expenses_id', $head)->whereBetween('date', [$date1, $date2])->get();
        $array1 = Income::where('income_expenses_id', $head)->whereBetween('date', [$date1, $date2])->sum('amount');

        $expense = Expense::with('incomeExpenses')->where('income_expenses_id', $head)->whereBetween('date', [$date1, $date2])->get();
        $array2 = Expense::where('income_expenses_id', $head)->whereBetween('date', [$date1, $date2])->sum('amount');

        $data = [
            'income' => $income,
            'total_income' => $array1,
            'expense' => $expense,
            'total_expense' => $array2,
        ];

        return response()->json($data);
    }


    //make pdf for transaction
    public function transactionPdf(Request $request)
    {
        $cost = $request->cost;
        $head = $request->head;
        $datepicker = explode('-', $request->daterange);

        // Check if $datepicker contains at least two elements
        if (count($datepicker) >= 2) {
            $date1 = date('Y-m-d', strtotime($datepicker[0]));
            $date2 = date('Y-m-d', strtotime($datepicker[1]));

            $income = Income::with('incomeExpenses')
                ->where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->get();

            // dd($income);
            $array1 = Income::where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->sum('amount');

            $expense = Expense::with('incomeExpenses')
                ->where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->get();
            $array2 = Expense::where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->sum('amount');

            $data = [
                'income' => $income,
                'expense' => $expense,
                'total_income' => $array1,
                'total_expense' => $array2,
            ];

            $pdf = PDF::loadView('dashboard.report.transactions.mypdf', $data);
            return $pdf->download('transaction_report.pdf');
        }
    }


    //print pdf for transaction

    public function transactionPrint(Request $request)
    {
        $cost = $request->cost;
        $head = $request->head;
        $datepicker = explode('-', $request->daterange);

        // Check if $datepicker contains at least two elements
        if (count($datepicker) >= 2) {
            $date1 = date('Y-m-d', strtotime($datepicker[0]));
            $date2 = date('Y-m-d', strtotime($datepicker[1]));

            $income = Income::with('incomeExpenses')
                ->where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->get();

            $array1 = Income::where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->sum('amount');

            $expense = Expense::with('incomeExpenses')
                ->where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->get();
            $array2 = Expense::where('income_expenses_id', $head)
                ->whereBetween('date', [$date1, $date2])
                ->sum('amount');

            $data = [
                'income' => $income,
                'expense' => $expense,
                'total_income' => $array1,
                'total_expense' => $array2,
            ];

            return view('dashboard.report.transactions.mypdf_print', $data);
        }
    }

    //transactions end



    //class Routine start
    public function classroutine()
    {
        return view('dashboard.report.classroutine.index', [
            'classes' => Classes::all(),
        ]);

    }


    public function classroutineData(Request $request)
    {
        $class = $request->class;
        $section = $request->section;

        $classRoutine = ClassRoutine::with('days', 'subject', 'timeschedule', 'classroom')
            ->where('class_id', $class)
            ->where('section_id', $section)
            ->get();

        $weekdays = [
            'SATURDAY',
            'SUNDAY',
            'MONDAY',
            'TUESDAY',
            'WEDNESDAY',
            'THURESDAY',
            'FRIDAY',
        ];

        $x = [];
        foreach ($weekdays as $key => $val) {
            $x[$val] = [];
            // dd($x);
        }

        foreach ($classRoutine as $entry) {
            $day = strtoupper($entry->days->day);
            $start_time = $entry->timeschedule->start_time;
            $end_time = $entry->timeschedule->end_time;
            $subject = $entry->subject->name;
            $class = $entry->classroom->room_no;

            $x[$day][] = [$subject, $class];
        }

        return response()->json($x);
    }


    //make pdf for classRoutine
    public function classRoutinePdf(Request $request)
    {

        $class = $request->class;
        $section = $request->section;

        $classRoutine = ClassRoutine::with('days', 'subject', 'timeschedule', 'classroom')
            ->where('class_id', $class)
            ->where('section_id', $section)
            ->get();


        $weekdays = [
            'SATURDAY',
            'SUNDAY',
            'MONDAY',
            'TUESDAY',
            'WEDNESDAY',
            'THURESDAY',
            'FRIDAY',
        ];


        $x = [];

        foreach ($weekdays as $key => $val) {
            $x[$val] = [];
        }

        foreach ($classRoutine as $entry) {
            $day = strtoupper($entry->days->day);
            $start_time = $entry->timeschedule->start_time;
            $end_time = $entry->timeschedule->end_time;
            $subject = $entry->subject->name;
            $class = $entry->classroom->room_no;

            $x[$day][] = [$subject, $class];
        }
        $pdf = PDF::loadView('dashboard.report.classroutine.myClassRoutinepdf', ['classRoutineData' => $x]);
        return $pdf->download('myClassRoutinePdf.pdf');
    }


    //pdf print for classRoutine
    public function classRoutinePrint(Request $request)
    {
        $class = $request->class;
        $section = $request->section;

        $classRoutine = ClassRoutine::with('days', 'subject', 'timeschedule', 'classroom')
            ->where('class_id', $class)
            ->where('section_id', $section)
            ->get();

        $weekdays = [
            'SATURDAY',
            'SUNDAY',
            'MONDAY',
            'TUESDAY',
            'WEDNESDAY',
            'THURESDAY',
            'FRIDAY',
        ];

        $x = [];

        foreach ($weekdays as $key => $val) {
            $x[$val] = [];
        }

        foreach ($classRoutine as $entry) {
            $day = strtoupper($entry->days->day);
            $start_time = $entry->timeschedule->start_time;
            $end_time = $entry->timeschedule->end_time;
            $subject = $entry->subject->name;
            $class = $entry->classroom->room_no;

            $x[$day][] = [$subject, $class];
        }
        return view('dashboard.report.classroutine.myClassRoutinePrint', ['classRoutineDt' => $x]);
    }
    //class Routine end





    //exam Routine start
    public function examroutine()
    {
        return view('dashboard.report.examroutine.index', [
            'classes' => Classes::all(),
            'examTypes' => ExamType::all(),
        ]);

    }


    public function examroutineData(Request $request)
    {
        $class = $request->class;
        $section = $request->section;
        $typeValue = $request->typeValue;

        $examRoutine = ExamRoutine::with('subject', 'timeschedule', 'classroom')
            ->where('class_id', $class)->where('section_id', $section)->where('type', $typeValue)->get();

        // dd($examRoutine);

        return response()->json($examRoutine);

    }
    //exam Routine end


    public function attendance()
    {
        return view('dashboard.report.attendance.index');
    }



    //Class And Section
    public function getSectionforclassroutine($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $abc = $sectionAll->toArray();
        return $abc;
    }


    public function getSectionforexamroutine($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $abc = $sectionAll->toArray();
        return $abc;
    }


    public function getSectionforduefee($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $abc = $sectionAll->toArray();
        return $abc;
    }


    public function getSectionforfeesCollection($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $abc = $sectionAll->toArray();
        return $abc;
    }





}