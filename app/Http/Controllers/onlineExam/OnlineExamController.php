<?php

namespace App\Http\Controllers\onlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\onlineExam\OnlineExamRequest;
use App\Models\Classes;
use App\Models\onlineExam\Gender;
use App\Models\onlineExam\OnlineExam;
use App\Models\onlineExam\OnlineExamQstList;
use App\Models\onlineExam\OnlineExamStdList;
use App\Models\onlineExam\OnlineExamType;
use App\Models\onlineExam\QuestionBank;
use App\Models\onlineExam\QuestionBankAnswer;
use App\Models\onlineExam\QuestionGroup;
use App\Models\onlineExam\StudentCategory;
use App\Models\Section;
use App\Models\Subject;
use App\Services\onlineExam\OnlineExamService;
use App\Services\onlineExam\OnlineExamTypeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OnlineExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $classes = Classes::all();
        $sections = Section::all();
        $onlineExamData = OnlineExam::with('question_group', 'classes', 'section', 'subject', 'online_exam_type')->get();


        // dd($onlineExamData);
        return view(
            'dashboard.onlineExam.onlineExam.index',
            compact(
                'classes',
                'sections',
                'onlineExamData',
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $qstGroup = QuestionGroup::all();
        $classes = Classes::all();
        $std_cats = StudentCategory::all();
        $genders = Gender::all();
        $types = OnlineExamType::all();
        return view('dashboard.onlineExam.onlineExam.create', [
            'qstGroup' => $qstGroup,
            'classes' => $classes,
            'std_cats' => $std_cats,
            'genders' => $genders,
            'types' => $types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OnlineExamRequest $request)
    {

        $validateData = $request->validated();
        $onlineExamData = new OnlineExamService();
        $data = $onlineExamData->store($request);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OnlineExam $onlineExam)
    {
        // dd($onlineExam->id);
        $assignQuestion = DB::table('online_exam_qst_lists')
            ->where('online_exam_id', $onlineExam->id)
            ->join('question_banks', 'online_exam_qst_lists.question_bank_id', '=', 'question_banks.id')
            ->select('online_exam_qst_lists.status as qstList_status', 'online_exam_qst_lists.question_bank_id')
            ->get();

        // dd($assignQuestion);

        $assignStudent = DB::table('online_exam_std_lists')
            ->where('online_exam_id', $onlineExam->id)
            ->get();

        $onlineExamData = OnlineExam::where('id', $onlineExam->id)->get();
        // dd($onlineExamData);


        $qstGroup = QuestionGroup::all();
        $classes = Classes::all();
        $std_cats = StudentCategory::all();
        $genders = Gender::all();
        $types = OnlineExamType::all();

        return view('dashboard.onlineExam.onlineExam.edit', [
            'qstGroup' => $qstGroup,
            'classes' => $classes,
            'std_cats' => $std_cats,
            'genders' => $genders,
            'types' => $types,
            'edit_data' => $onlineExam,
            'assign_questions' => $assignQuestion,
            'assignStudents' => $assignStudent,
            'exam_id' => $onlineExam->id,
            'onlineExam' => $onlineExamData,
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(OnlineExamRequest $request, OnlineExam $onlineExam)
    {
        $validateData = $request->validated();
        $updateOnlineExamType = new OnlineExamService();
        $data = $updateOnlineExamType->update($request, $onlineExam);

        return $data;
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OnlineExam $onlineExam)
    {
        $deleteData = new OnlineExamService();
        return $deleteData->destroy($onlineExam);
    }



    // Get Section by Class
    public function getSectionByClass($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $sections = $sectionAll->toArray();
        return $sections;
    }


    public function getSection($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $sections = $sectionAll->toArray();
        return $sections;
    }


    // Get Section by Class
    public function getSubjectBySection()
    {
        $allSubject = Subject::all();
        $subject = $allSubject->toArray();
        return $subject;
    }


    // Filter Student
    public function filterStudent(Request $request)
    {
        // dd($request->all());
        $selectedClass = $request->classes;
        $selectedSection = $request->section;
        $selectedCat = $request->stdCat;
        $selectedGender = $request->gender;

        // $filterStudents = DB::table('students')
            // ->join('classes', 'students.class_id', '=', 'classes.id')
            // ->join('sections', 'students.section_id', '=', 'sections.id')
            // ->leftjoin('online_exam_std_lists', 'students.id', '=', 'online_exam_std_lists.student_id')
            // ->when($selectedClass, function ($query, $selectedClass) {
            //     return $query->where('students.class_id', $selectedClass);
            // })->when($selectedSection, function ($query, $selectedSection) {
            //     return $query->where('students.section_id', $selectedSection);
            // })->when($selectedCat, function ($query, $selectedCat) {
            //     return $query->where('students.category_id', $selectedCat);
            // })->when($selectedGender, function ($query, $selectedGender) {
            //     return $query->where('students.gender', $selectedGender);
            // })->select('students.*', 'classes.name as class_name', 'sections.name as section_name', 'online_exam_std_lists.status as stdList_status')->get()->toArray();

        // ----------------------->
            $filterStudents = DB::table('students')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->join('sections', 'students.section_id', '=', 'sections.id')
            ->leftjoin('online_exam_std_lists', 'students.id', '=', 'online_exam_std_lists.student_id')
            ->when($selectedClass, function ($query, $selectedClass) {
                return $query->where('students.class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {
                return $query->where('students.section_id', $selectedSection);
            })->when($selectedCat, function ($query, $selectedCat) {
                return $query->where('students.category_id', $selectedCat);
            })->when($selectedGender, function ($query, $selectedGender) {
                return $query->where('students.gender', $selectedGender);
            })->select('students.*', 'classes.name as class_name', 'sections.name as section_name', 'online_exam_std_lists.status as stdList_status')->get()->toArray();

        
        // echo '<pre>';
        // dd($filterStudents);
        return response()->json(['success' => true, 'filterStudents' => $filterStudents]);
    }




    // Filter Question
    public function filterQuestion(Request $request)
    {

        $selectedQstGroup = $request->qstGroup;

        $filterQuestion = QuestionBank::leftJoin('question_groups', 'question_banks.question_group', '=', 'question_groups.id')
            ->when($selectedQstGroup, function ($query, $selectedQstGroup) {
                return $query->where('question_banks.question_group', $selectedQstGroup);
            })->select('question_banks.id', 'question_banks.question', 'question_banks.question_type', 'question_groups.name')
            ->with('question_list')
            ->get()->toArray();


        // dd($filterQuestion);


        $questions = OnlineExamQstList::where('online_exam_id', $request->exam_id)->get();



        // ------- Return Data -------------->
        return response()->json(['success' => true, 'filterQuestion' => $filterQuestion, 'questions' => $questions,]);
    }


    // Download Question
    public function pdf($examId)
    {
        // dd($examId);        

        $questions = DB::table('online_exam_qst_lists')
            ->where('online_exam_id', $examId)
            ->join('question_banks', 'online_exam_qst_lists.question_bank_id', '=', 'question_banks.id')
            ->get();

        for ($i = 0; $i < count($questions); $i++) {

            $questions[$i]->ans = DB::table('question_bank_answers')
                ->where('question_bank_id', $questions[$i]->question_bank_id)
                ->get();
        }


        // $questions = QuestionBank::where('id', $examId)->get();
        // $questionBankAns = QuestionBankAnswer::where('question_bank_id', $examId)->get();

        $onlineExamData = OnlineExam::where('id', $examId)->with('question_group', 'classes', 'section', 'subject', 'online_exam_type')->get();

        $pdf = Pdf::loadView('dashboard.onlineExam.onlineExam.downloadQst', compact('onlineExamData', 'questions'));

        return $pdf->download('Online_Exam_Question_' . date('d-m-Y') . '.pdf');

        // return view('dashboard.onlineExam.onlineExam.downloadQst', compact('onlineExamData', 'questions'));
    }


    // View Question
    public function viewQuestion($examId)
    {
        // dd($examId); 

        $questions = DB::table('online_exam_qst_lists')
            ->where('online_exam_id', $examId)
            ->join('question_banks', 'online_exam_qst_lists.question_bank_id', '=', 'question_banks.id')
            ->get();

        for ($i = 0; $i < count($questions); $i++) {

            $questions[$i]->ans = DB::table('question_bank_answers')
                ->where('question_bank_id', $questions[$i]->question_bank_id)
                ->get();
        }

        $onlineExamData = OnlineExam::where('id', $examId)->with('question_group', 'classes', 'section', 'subject', 'online_exam_type')->get();

        return response()->json(['onlineExamData' => $onlineExamData, 'questions' => $questions]);
    }



    // View Student
    public function viewStudent($id)
    {
        $listedStd = OnlineExamStdList::where('online_exam_id', $id)->with('students')->get();
        return response()->json(['listedStd' => $listedStd]);
    }


    // View Student Answers
    public function viewStudentAns($examId, $sid)
    {

        $examData = OnlineExam::where('id', $examId)->with('online_exam_type')->get();

        $questions = DB::table('online_exam_qst_lists')
            ->where('online_exam_id', $examId)
            ->join('question_banks', 'online_exam_qst_lists.question_bank_id', '=', 'question_banks.id')
            ->get();


        $options = DB::table('online_exam_qst_lists')
            ->where('online_exam_id', $examId)
            ->join('question_bank_answers', 'online_exam_qst_lists.question_bank_id', '=', 'question_bank_answers.question_bank_id',)
            ->get();


        return view('dashboard.onlineExam.onlineExam.examAns', compact('examData', 'questions', 'options', 'examId', 'sid'));
    }


    // Filter Index
    public function filterIndex(Request $request)
    {
        // dd($request->all());
        $selectedClass = $request->select_classes;
        $selectedSection = $request->select_section;
        $selectedSubject = $request->select_subject;
        $searchKeyword = $request->search_keyword;

        $classes = Classes::all();
        $sections = Section::all();
        // $onlineExamData = OnlineExam::with('question_group', 'classes', 'section', 'subject', 'online_exam_type')->get();

        $onlineExamData = OnlineExam::with('classes', 'section', 'subject', 'question_group')
            ->when($selectedClass, function ($query, $selectedClass) {

                return $query->where('class_id', $selectedClass);
            })->when($selectedSection, function ($query, $selectedSection) {

                return $query->where('section_id', $selectedSection);
            })->when($selectedSubject, function ($query, $selectedSubject) {

                return $query->where('subject_id', $selectedSubject);
            })->when($searchKeyword, function ($query, $searchKeyword) {

                return $query->where('name', 'like', '%' . $searchKeyword . '%');
                return $query->orwhere('start', 'like', '%' . $searchKeyword . '%');
            })->get();


        if ($request->ajax()) {
            return view('dashboard.onlineExam.onlineExam.index_table', compact('classes', 'sections', 'onlineExamData',));
        }

        // dd($onlineExamData);
        return view(
            'dashboard.onlineExam.onlineExam.index',
            compact(
                'classes',
                'sections',
                'onlineExamData',
            )
        );
    }
}
