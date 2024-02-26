<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentCategoryController;
use App\Http\Controllers\PromoteStudentController;
use App\Http\Controllers\DisableStudentController;
use App\Http\Controllers\GaurdianController;

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectAssignController;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\routine\ClassRoutineController;
use App\Http\Controllers\routine\ExamRoutineController;
use App\Http\Controllers\Transaction\IncomeAndExpenseController;
use App\Http\Controllers\Transaction\IncomeController;
use App\Http\Controllers\Transaction\ExpenseController;
use App\Http\Controllers\gallery\galleryCategoryController;
use App\Http\Controllers\gallery\galleryImageController;
use App\Http\Controllers\report\ReportController;


//fees
use App\Http\Controllers\fees\GroupController;
use App\Http\Controllers\fees\TypeController;
use App\Http\Controllers\fees\MasterController;
use App\Http\Controllers\fees\AssignController;
use App\Http\Controllers\fees\CollectFeesController;

//examination
use App\Http\Controllers\examination\ExamTypeController;
use App\Http\Controllers\examination\MarkGradeController;
use App\Http\Controllers\examination\ExamAssignController;
use App\Http\Controllers\examination\MarkRegisterController;

//online exam
// use App\Http\Controllers\online_exam\OnlineExamTypeController;


use App\Http\Controllers\attendance\AttendanceController;
use App\Http\Controllers\attendance\AttendanceReportController;

use App\Http\Controllers\backend\adminpanel\AdminController;
use App\Http\Controllers\backend\adminpanel\AdminPanelController;
use App\Http\Controllers\backend\adminpanel\ParentController;
use App\Http\Controllers\backend\adminpanel\StudentController as AdminpanelStudentController;
use App\Http\Controllers\backend\adminpanel\SuperAdminController;
use App\Http\Controllers\backend\adminpanel\TeacherController;
use App\Http\Controllers\backend\adminpanel\UserController;



// -------------- NH Tarik ------------------>
use App\Http\Controllers\bloodgroup\BloodGroupController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\religion\ReligionController;
use App\Http\Controllers\gender\GenderController;
use App\Http\Controllers\generalsetting\GeneralSettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\library\BookCategoryController;
use App\Http\Controllers\library\BookController;
use App\Http\Controllers\library\IssueBookController;
use App\Http\Controllers\library\MemberCategoryController;
use App\Http\Controllers\library\MemberController;
use App\Http\Controllers\onlineExam\OnlineExamController;
use App\Http\Controllers\onlineExam\OnlineExamTypeController;
use App\Http\Controllers\onlineExam\QuestionBankController;
use App\Http\Controllers\onlineExam\QuestionGroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\session\SessionController;
use App\Http\Controllers\setting\EmailSettingController;
use App\Http\Controllers\setting\RecaptchaSettingController;
use App\Http\Controllers\setting\StorageSettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\staffManage\StaffRoleController;
use App\Http\Middleware\adminpanel\SuperAdmin;
use App\Http\Middleware\adminpanel\User;
use GuzzleHttp\Cookie\SessionCookieJar;

// -------------- End NH Tarik ------------------>



// Route::get('/', function () {
//     return view('dashboard.master');
// });


//===========================================
// Backend Routes (Admin Panel) ------*******
// ==========================================

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard.master');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/adminpanel/superadmin', [SuperAdminController::class, 'index'])->name('adminpanel.superAdmin')->middleware('superadmin');

Route::get('/adminpanel/admin', [AdminController::class, 'index'])->name('adminpanel.admin')->middleware('admin');

Route::get('/adminpanel/teacher', [TeacherController::class, 'index'])->name('teacherP.teacher')->middleware('teacher');

Route::get('/adminpanel/student', [AdminpanelStudentController::class, 'index'])->name('adminpanel.student')->middleware('student');

Route::get('/adminpanel/parent', [ParentController::class, 'index'])->name('adminpanel.parent')->middleware('parent');

Route::get('/adminpanel/user', [UserController::class, 'index'])->name('adminpanel.user')->middleware('user');
// ----------- End Backend Routes (Admin Panel) ------------>>>>>>>>>>>>>>



Route::get('/adminpanel', [AdminPanelController::class, 'index'])->name('adminpanel');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Student --------------------->
    Route::resource('/students', StudentController::class);

    Route::post('/store/student', [StudentController::class, 'store'])->name('store');
    Route::get('/showStudent/{id}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/editStudent/{id}',[StudentController::class, 'edit'])->name('student.edit');
    Route::post('/updateStudent/{id}',[StudentController::class, 'update'])->name('update');
    Route::get('/document-delete/{id}', [StudentController::class, 'docDelete'])->name('docDelete');
    Route::get('/getSection/{id}', [StudentController::class, 'section'])->name('section.student');




    //Students Category
    Route::resource('/studentCategories', StudentCategoryController::class);

    //stdudents disable
    Route::get('/disable/student', [DisableStudentController::class, 'index'])->name('disable');
    Route::get('/disableStudent-data', [DisableStudentController::class, 'DisableStudentData'])->name('DisableStudentData');

    //promote students
    Route::get('/index/promoteStudent', [PromoteStudentController::class, 'index'])->name('promotestudentindex');
    Route::get('/getSection-from-class/{id}', [PromoteStudentController::class, 'sectionfromclass'])->name('section.promote');
    Route::get('/get-prostudents', [PromoteStudentController::class, 'studentData'])->name('studentData');
    Route::post('/promote-students', [PromoteStudentController::class, 'promoteStudents'])->name('promoteStudent');


    //Gaurdians
    Route::resource('/gaurdians', GaurdianController::class);
    Route::get('/gaurdiandelete/{id}', [GaurdianController::class, 'destroy'])->name('destroy');
    Route::post('/gaurdiansUpdate/{id}', [GaurdianController::class, 'update'])->name('update');

    //Class
    Route::resource('/class', ClassesController::class);

    //section
    Route::resource('/section', SectionController::class);

    //shift
    Route::resource('/shift', ShiftController::class);

    //Subject
    Route::resource('/subject', SubjectController::class);

    //SubjectAssign   & show subject and teacher data in A modal
    Route::resource('/subjectAssign', SubjectAssignController::class);

    Route::get('/getSection/{id}', [SubjectAssignController::class, 'section'])->name('section.subjectassign');
    Route::get('/subjectAssign/{class_id}/{section_id}', [SubjectAssignController::class, 'edit'])->name('edit');
    Route::post('/subjectAssignUpdate/{class_id}/{section_id}', [SubjectAssignController::class, 'update'])->name('update');
    Route::get('/subjectAssignDelete/{class_id}/{section_id}', [SubjectAssignController::class, 'destroy'])->name('destroy');

    //Time Schedule
    Route::resource('/timeSchedule', TimeScheduleController::class);

    //Class Room
    Route::resource('/classRoom', ClassRoomController::class);

    //Routine
//class Routine
    Route::resource('/ClassRoutine', ClassRoutineController::class);

    Route::get('/getSection/{id}', [ClassRoutineController::class, 'section'])->name('section.class');
    Route::get('/ClassRoutine/{class_id}/{section_id}', [ClassRoutineController::class, 'edit'])->name('edit');
    Route::post('/ClassRoutineUpdate/{class_id}/{section_id}', [ClassRoutineController::class, 'update'])->name('update');
    Route::get('/ClassRoutineDelete/{class_id}/{section_id}', [ClassRoutineController::class, 'destroy'])->name('destroy');

    //Exam Routine
    Route::resource('/examRoutine', ExamRoutineController::class);

    Route::get('/getSection/{id}', [ExamRoutineController::class, 'section'])->name('section.exam');
    Route::get('/examRoutine/{class_id}/{section_id}', [ExamRoutineController::class, 'edit'])->name('edit');
    Route::post('/examRoutineUpdate/{class_id}/{section_id}', [ExamRoutineController::class, 'update'])->name('update');
    Route::get('/examRoutineDelete/{class_id}/{section_id}', [ExamRoutineController::class, 'destroy'])->name('destroy');

    //Transaction
//IncomeAndExpense
    Route::resource('/incomeAndexpense', IncomeAndExpenseController::class);

    //income
    Route::resource('/income', IncomeController::class);
    Route::post('/incomeUpdate/{id}', [IncomeController::class, 'update'])->name('update');

    //expense
    Route::resource('/expense', ExpenseController::class);
    Route::post('/expenseUpdate/{id}', [ExpenseController::class, 'update'])->name('update');

    //Gallery
//galleryCategory
    Route::resource('/galleryCategory', galleryCategoryController::class);

    //image
    Route::resource('/image', galleryImageController::class);
    Route::post('/imageUpdate/{id}', [galleryImageController::class, 'update'])->name('update');



    //Report
//maerksheet
    Route::get('/index/marksheet', [ReportController::class, 'marksheet'])->name('marksheet.index');
    Route::get('/get-student-marksheet', [ReportController::class, 'getStudentMarksheet']);
    Route::get('/marksheetOfStudent', [ReportController::class, 'marksheetOfStudent']);

    //merit
    Route::get('/index/meritlist', [ReportController::class, 'meritlist'])->name('meritlist.index');
    Route::get('/meritSearch', [ReportController::class, 'meritSearch']);
    //Progress Card
    Route::get('/index/progresscard', [ReportController::class, 'progresscard'])->name('progresscard.index');
    Route::get('/get-student-for-progress', [ReportController::class, 'getStudentProgress']);
    Route::get('/get-progress', [ReportController::class, 'getProgressCard']);

    //Due Fees
    Route::get('/index/duefees', [ReportController::class, 'duefees'])->name('duefees.index');
    Route::get('/getSectionforduefee/{id}', [ReportController::class, 'getSectionforduefee'])->name('getSectionforduefee.index');
    Route::get('/get-dueFees', [ReportController::class, 'feesDueData'])->name('feesDueData.index');
    Route::get('/dueFees-pdf', [ReportController::class, 'dueFeesPdf'])->name('dueFeesPdf');
    Route::get('/dueFees-pdf-print', [ReportController::class, 'dueFeesPrint'])->name('dueFeesPrint');



    //Fees Collection
    Route::get('/index/feescollection', [ReportController::class, 'feescollection'])->name('feescollection.index');
    Route::get('/getSectionforfeesCollection/{id}', [ReportController::class, 'getSectionforfeesCollection'])->name('getSectionforfeesCollection.index');
    Route::get('/get-feesCollection', [ReportController::class, 'getCollectionFees'])->name('get-feesCollection');


    //transactions
    Route::get('/index/transaction', [ReportController::class, 'transaction'])->name('transaction.index');
    Route::get('/getName/{id}', [ReportController::class, 'getName'])->name('getName');
    Route::get('/filter', [ReportController::class, 'filter'])->name('filter');
    Route::get('/report-search/transaction-pdf', [ReportController::class, 'transactionPdf'])->name('transactionPdf');
    Route::get('/transaction-pdf-print', [ReportController::class, 'transactionPrint'])->name('transactionPrint');


    //classroutine
    Route::get('/index/classroutine', [ReportController::class, 'classroutine'])->name('classroutine.index');
    Route::get('/getSectionforclassroutine/{id}', [ReportController::class, 'getSectionforclassroutine'])->name('getSectionforclassroutine.index');
    Route::get('/get-ClassRoutineData', [ReportController::class, 'classroutineData'])->name('classroutineData.index');
    Route::get('/report/classRoutinePdf', [ReportController::class, 'classRoutinePdf'])->name('classRoutinePdf');
    Route::get('/classRoutine-pdf-print', [ReportController::class, 'classRoutinePrint'])->name('classRoutinePrint');


    //examroutine
    Route::get('/index/examroutine', [ReportController::class, 'examroutine'])->name('examroutine.index');
    Route::get('/getSectionforexamroutine/{id}', [ReportController::class, 'getSectionforexamroutine'])->name('getSectionforexamroutine.index');
    Route::get('/get-ExamRoutineData', [ReportController::class, 'examroutineData'])->name('examroutineData.index');


    //attendance
    Route::get('/index/attendance', [ReportController::class, 'attendance'])->name('attendance.index');



    //Atik
//group
    Route::resource('/groups', GroupController::class);


    //type
    Route::resource('/types', TypeController::class);

    //master
    Route::resource('/masters', MasterController::class);


//assign and show data in modal
Route::resource('/assigns',AssignController::class);
Route::get('/get-student-by-class-section-gender',[AssignController::class,'get_student_by_class_section_gender']);
Route::get('/get-master-by-groupId/{id}',[AssignController::class,'get_master_by_groupId']);
Route::get('/get-section-for-assign/{id}',[AssignController::class,'getSectionforAssign']);


//collect
Route::resource('/collects', CollectFeesController::class);
Route::get('/fees-data',[CollectFeesController::class,'feesData'])->name('feesData.collect');
Route::get('/fees-collect/collect/{id}',[CollectFeesController::class,'show'])->name('show.collect');
Route::get('/get-section-collect',[CollectFeesController::class,'getclassAndsection'])->name('getSections');
Route::get('/get-student-collect',[CollectFeesController::class,'getStudents'])->name('getStudents');
Route::get('/data-show-modal',[CollectFeesController::class,'showDataModal'])->name('showDataModal');
Route::post('/fee-collect-from-modal',[CollectFeesController::class,'CollectFeeFromModal'])->name('CollectFeeFromModal');
Route::get('/revert-status/{id}',[CollectFeesController::class,'revertStatus'])->name('revertStatus');




    //Examination==================
//Exam-Type ExamTypeControllerexamtypes
    Route::resource('/examtypes', ExamTypeController::class);


    //ExamType ExamTypeControllerexamtypes
    Route::resource('/markgrades', MarkGradeController::class);
    Route::any('/markgrade/update/{id}', [MarkGradeController::class, 'update']);
    Route::any('/markgrade/destroy/{id}', [MarkGradeController::class, 'destroy']);



    //ExamAssign
    Route::resource('/examassigns', ExamAssignController::class);
    Route::any('/examassign/update/{id}', [ExamAssignController::class, 'update']);
    Route::any('/examassign/destroy/{id}/{exam_id}/{subject_id}/{section_id}', [ExamAssignController::class, 'destroy']);
    Route::get('/get-section-by-classId/{id}', [ExamAssignController::class, 'section']);
    Route::any('/examAssignSearch', [ExamAssignController::class, 'show']);

    //markregisters markregisters
    Route::resource('/markregisters', MarkRegisterController::class);
    Route::any('/markRegisterSearch', [MarkRegisterController::class, 'show']);
    Route::any('/subjectsForMarkRegister', [MarkRegisterController::class, 'subjectsForMarkRegister']);
    Route::any('/studentsForMarkRegister', [MarkRegisterController::class, 'studentsForMarkRegister']);
    Route::any('/markRegisterResult', [MarkRegisterController::class, 'markRegisterResult']);
    Route::any('/markregister/update/{id}', [MarkRegisterController::class, 'update']);
    Route::any('/markregister/destroy/{id}', [MarkRegisterController::class, 'destroy']);

    //settings
    Route::any('/passMark', [MarkGradeController::class, 'passMarkShow']);
    Route::any('/passMarkStore', [MarkGradeController::class, 'passMarkStore']);

    // Online Examination
// type
    Route::resource('/onlineExamTypes', OnlineExamTypeController::class);
    Route::any('/onlineExamType/update/{id}', [OnlineExamTypeController::class, 'restore']);
    Route::any('/onlineExamType/delete/{id}', [OnlineExamTypeController::class, 'delete']);







    // ------------------- NH Tarik -------------------->

    //--------------    Settings(Attendance) Routes       -------------->
    Route::get('/attendance', [AttendanceController::class, 'attendanceIndex'])->name('attendance.index');

    Route::get('/attendance/search', [AttendanceController::class, 'attendanceSearch'])->name('attendance.search');

    Route::get('/attendance-section/{id}', [AttendanceController::class, 'attend_section'])->name('attendance.section');

    Route::get('/attendance-student/{id}', [AttendanceController::class, 'attend_student'])->name('attendance.student');

    Route::any('/get-student-by-class-section-keyword', [AttendanceController::class, 'get_student_by_class_section_keyword'])->name('attendance.studentFilter');


    Route::post('/attendace-submit', [AttendanceController::class, 'attendanceSubmit'])->name('attendanceSubmit');

    //--------------    End Settings(Attendance) Routes   -------------->







    //--------------    Attendance Report Routes   -------------->

    Route::get('/attendance/report-search', [AttendanceReportController::class, 'attendanceReportIndex'])->name('attendanceReportIndex');

    // Route::get('/attendance/report/selectClass', [AttendanceReportController::class, 'selectClass'])->name('selectClass');


    Route::get('/attendance-report-section/{id}', [AttendanceReportController::class, 'attendReportSection'])->name('attendReportSection');


    Route::any('/attendance-report/short-details-view', [AttendanceReportController::class, 'filterView'])->name('attendanceReport.filterView');

    //--------------    End Settings(AtAttendance Report Routes   -------------->



    //--------------  Download Attendance pdf    -------------->
    Route::get('/attendance/report-search/short-view', [AttendanceReportController::class, 'short_view_download_pdf'])->name('attendanceReport.short_view_download_pdf');

    Route::get('/attendance/report-search/details-view', [AttendanceReportController::class, 'details_view_download_pdf'])->name('attendanceReport.details_view_download_pdf');




    //--------------  Print pdf    -------------->
    Route::get('/attendance-report/print-short-view', [AttendanceReportController::class, 'print_shortView'])->name('attendanceReport.print_shortView');


    Route::get('/attendance-report/print-details-view', [AttendanceReportController::class, 'print_detailsView'])->name('attendanceReport.print_detailsView');


    //--------------    Language Routes       -------------->
    Route::get('/languages', [LanguageController::class, 'langIndex'])->name('lang.index');

    Route::get('/language/create', [LanguageController::class, 'LangForm'])->name('LangForm');

    Route::post('/language/create', [LanguageController::class, 'createLang'])->name('createLang');

    Route::get('/language/edit/{id}', [LanguageController::class, 'editLangForm'])->name('editLangForm');

    Route::post('/language/update/{id}', [LanguageController::class, 'editLang'])->name('editLang');

    Route::get('/language/delete/{id}', [LanguageController::class, 'deleteLang'])->name('deleteLang');


    //--------------    Language Routes       -------------->


    // //--------------    Report (Marksheet) Routes       -------------->
    // Route::get('/report-marksheet', [ReportController::class, 'marksheetIndex'])->name('report.marksheet');
    // Route::get('/get-student-marksheet', [ReportController::class, 'getStudentMarksheet']);
    // Route::get('/marksheetOfStudent', [ReportController::class, 'marksheetOfStudent']);

    // Route::get('/report-merit-list', [ReportController::class, 'meritIndex'])->name('report.meritlist');

    // Route::get('/progress-card', [ReportController::class, 'progressIndex'])->name('report.progress');
    //--------------    End Report (Marksheet) Routes   -------------->

    //--------------    Staff Department Routes       -------------->

    Route::get('/department/index', [DepartmentController::class, 'index'])->name('dept.index');

    Route::get('/department/create', [DepartmentController::class, 'createDeptForm'])->name('createDeptForm');

    Route::post('/department/create', [DepartmentController::class, 'createDept'])->name('createDept');

    Route::get('/department', [DepartmentController::class, 'showDept'])->name('showDept');

    Route::get('/department/edit/{id}', [DepartmentController::class, 'editDeptForm'])->name('editDeptForm');

    Route::post('/department/edit/{id}', [DepartmentController::class, 'updateDept'])->name('updateDept');

    Route::get('/department/delete/{id}', [DepartmentController::class, 'deleteDept'])->name('deleteDept');

    //--------------    End Staff Department Routes       -------------->




    //--------------    Staff Designation Routes       -------------->



    //--------------       End Staff Designation Routes       -------------->




    //--------------    Staff Role Routes       -------------->

    Route::resource('/staff-role', StaffRoleController::class);

    //--------------       End Staff Role Routes       -------------->




    //--------------    Staff (STAFF) Routes       -------------->

    Route::get('/staff/index', [StaffController::class, 'index'])->name('staffIndex');

    Route::get('/staff/create', [StaffController::class, 'createStaffForm'])->name('createStaffForm');

    Route::post('/staff/create', [StaffController::class, 'createStaff'])->name('createStaff');

    Route::get('/staff', [StaffController::class, 'showStaff'])->name('showStaff');

    Route::get('/staff/edit/{id}', [StaffController::class, 'editStaff'])->name('editStaff');

    Route::post('/staff/edit/{id}', [StaffController::class, 'update'])->name('updateStaff');

    Route::get('/doc-delete/{id}', [StaffController::class, 'docDelete'])->name('docDelete');

    Route::get('/staff/delete/{id}', [StaffController::class, 'deleteStaff'])->name('deleteStaff');

    //--------------       End Staff(STAFF) Staff Routes       -------------->


    Route::get('/get-all-members', [MemberController::class, 'getAllMember'])->name('getAllMember');


    //--------------    Resource Routes       -------------->

    Route::resource('/religions', ReligionController::class);
    Route::resource('/genders', GenderController::class);
    Route::resource('/blood-groups', BloodGroupController::class);
    Route::resource('/school-sessions', SessionController::class);
    Route::resource('/designations', DesignationController::class);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/book', BookController::class);
    Route::resource('/book-category', BookCategoryController::class);
    Route::resource('/member-category', MemberCategoryController::class);
    Route::resource('/member', MemberController::class);
    Route::resource('/issue-book', IssueBookController::class);
    // Route::resource('/attendance', IssueBookController::class);



    // -------   Online Examination ---------------->
    Route::resource('/online-exam-type', OnlineExamTypeController::class);
    Route::resource('/question-group', QuestionGroupController::class);
    Route::resource('/question-bank', QuestionBankController::class);
    Route::resource('/online-exam', OnlineExamController::class);

    Route::get('/get-section-by-class/{id}', [OnlineExamController::class, 'getSectionByClass'])->name('onlineExam.getSectionByClass');

    Route::get('/get-section/{id}', [OnlineExamController::class, 'getSection'])->name('onlineExam.getSection');

    Route::get('/get-subject-by-section', [OnlineExamController::class, 'getSubjectBySection'])->name('onlineExam.getSubjectBySection');

    Route::get('/filter-student', [OnlineExamController::class, 'filterStudent'])->name('onlineExam.filterStudent');

    Route::get('/filter-question', [OnlineExamController::class, 'filterQuestion'])->name('onlineExam.filterQuestion');

    Route::get('/pdf/{id}', [OnlineExamController::class, 'pdf']);

    Route::get('/view-question/{id}', [OnlineExamController::class, 'viewQuestion'])->name('onlineExam.viewQuestion');

    Route::get('/view-students/{id}', [OnlineExamController::class, 'viewStudent'])->name('onlineExam.viewStudent');

    Route::get('/view-students/answer/{examId}/{sid}', [OnlineExamController::class, 'viewStudentAns'])->name('onlineExam.viewStudentAns');


    Route::any('/online-exam/online-exam-filter', [OnlineExamController::class, 'filterIndex'])->name('onlineExam.filterIndex');

    // -------   End Online Examination ---------------->










    //--------------    Settings(General Settings) Routes       -------------->

    Route::get('/general-settings', [GeneralSettingController::class, 'index'])->name('genSetting.index');

    Route::post('/general-settings/edit', [GeneralSettingController::class, 'updategenSetting'])->name('updategenSetting');

    //--------------    End Settings(General Settings) Routes    -------------->



    //--------------    Settings(Storage Settings) Routes       -------------->

    Route::get('/storage-settings', [StorageSettingController::class, 'index'])->name('storage.index');

    Route::post('/storage-settings/edit', [StorageSettingController::class, 'updateStorage'])->name('updateStorage');

    //--------------    End Settings(Storage Settings) Routes       -------------->



    //--------------    Settings(Recaptcha Settings) Routes       -------------->

    Route::get('/recaptcha-settings', [RecaptchaSettingController::class, 'index'])->name('recaptcha.index');

    Route::post('/recaptcha-settings/edit', [RecaptchaSettingController::class, 'updateRecaptcha'])->name('updateRecaptcha');

    //--------------    End Settings(Recaptcha Settings) Routes       -------------->



    //--------------    Settings(Email Settings) Routes       -------------->

    Route::get('/email-settings', [EmailSettingController::class, 'index'])->name('emailSetting.index');

    Route::post('/email-settings/update', [EmailSettingController::class, 'updateEmailSetting'])->name('updateEmailSetting');

    //--------------    End Settings(Email Settings) Routes       -------------->
// ------------------- End NH Tarik -------------------->




});

require __DIR__ . '/auth.php';


// php artisan migrate:refresh --path=/database/migrations/2023_07_30_063427_create_assigns_table.php
// php artisan migrate --path=/database/migrations/2023_10_01_052754_create_online_exam_std_lists_table.php
