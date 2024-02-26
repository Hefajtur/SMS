<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript: void(0);">
                        <i class="bx bx-layout"></i>
                        <span>Online Admission</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Student Info</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('students.index')}}">Students</a></li>
                        <li><a href="{{route('studentCategories.index')}}">Student Category</a></li>
                        <li><a href="{{route('promotestudentindex')}}">Promote Students</a></li>
                        <li><a href="{{route('disable')}}">Disabled Students</a></li>
                        <li><a href="{{route('gaurdians.index')}}">Guardian</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Academic</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('class.index')}}">Class</a></li>
                        <li><a href="{{route('section.index')}}">Section</a></li>
                        <li><a href="{{route('shift.index')}}">Shift</a></li>
                        <li><a href="{{route('subject.index')}}">Subject</a></li>
                        <li><a href="{{route('subjectAssign.index')}}">Subject Assign</a></li>
                        <li><a href="{{route('timeSchedule.index')}}">Time Schedule</a></li>
                        <li><a href="{{route('classRoom.index')}}">Class Room</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Routines</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('ClassRoutine.index')}}">Class Routine</a></li>
                        <li><a href="{{route('examRoutine.index')}}">Exam Routine</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Attendance</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('attendance.index') }}">Attendance</a></li>
                        <li><a href="{{ route('attendanceReportIndex') }}">Attendance Report</a></li>
                    </ul>
                </li>


                {{-- @if(auth()->user()->role == 2) --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Fees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/groups') }}">Group</a></li>
                        <li><a href="{{ url('/types') }}">Type</a></li>
                        <li><a href="{{ url('/masters') }}">Master</a></li>
                        <li><a href="{{ url('/assigns') }}">Assign</a></li>
                        <li><a href="{{ url('/collects') }}">Collect</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Examination</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/examtypes') }}">Type</a></li>
                        <li><a href="{{ url('/markgrades') }}">Marks Grade</a></li>
                        <li><a href="{{ url('/examassigns') }}">Exam Assign</a></li>
                        <li><a href="{{ url('/markregisters') }}">Mark Register</a></li>
                        <li><a href="{{ url('/passMark') }}">Settings</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Online Examination</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('online-exam-type.index')}}">Type</a></li>
                        <li><a href="{{route('question-group.index')}}">Question Group</a></li>
                        <li><a href="{{ route('question-bank.index') }}">Question Bank</a></li>
                        <li><a href="{{ route('online-exam.index') }}">Online Exam</a></li>
                    </ul>
                    
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Library</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('book-category.index') }}">Book Category</a></li>
                        <li><a href="{{ route('book.index') }}">Book</a></li>
                        <li><a href="{{ route('member-category.index') }}">Member Category</a></li>
                        <li><a href="{{ route('member.index') }}">Member</a></li>
                        <li><a href="{{ route('issue-book.index') }}">Issue Book</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Transactions</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('incomeAndexpense.index')}}">Income & Expense Head</a></li>
                        <li><a href="{{route('income.index')}}">Income</a></li>
                        <li><a href="{{route('expense.index')}}">Expense</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('marksheet.index')}}">Marksheet</a></li>
                        <li><a href="{{route('meritlist.index')}}">Merit List</a></li>
                        <li><a href="{{route('progresscard.index')}}">Progress Card</a></li>
                        <li><a href="{{route('duefees.index')}}">Due Fees</a></li>
                        <li><a href="{{route('feescollection.index')}}">Fees Collection</a></li>
                        <li><a href="{{route('transaction.index')}}">Transactions</a></li>
                        <li><a href="{{route('classroutine.index')}}">Class Routine</a></li>
                        <li><a href="{{route('examroutine.index')}}">Exam Routine</a></li>
                        <li><a href="{{route('attendance.index')}}">Attendance</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('lang.index') }}" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Languages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li></li>
                    </ul>
                </li>

                 <!-- Staff Roles & Permission -->
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Staff Manage</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('staff-role.index') }}">Roles</a></li>
                        <li><a href="{{ route('staffIndex') }}">Staff</a></li>
                        <li><a href="{{ route('departments.index') }}">Department</a></li>
                        <li><a href="{{ route('designations.index') }}">Designation</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Subscription</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Manage Enroll</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Contact Message</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Manage Enroll</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Website Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Manage Enroll</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Gallery</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('galleryCategory.index')}}">Gallery Category</a></li>
                    </ul>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('image.index')}}">Images</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('religions.index') }}">Religions</a></li>
                        <li><a href="{{ route('genders.index') }}">Genders</a></li>
                        <li><a href="{{ route('blood-groups.index') }}">Blood Groups</a></li>
                        <li><a href="{{ route('school-sessions.index') }}">Sessions</a></li>
                        <li><a href="{{ route('genSetting.index') }}">General Settings</a></li>
                        <li><a href="{{ route('storage.index') }}">Storage Settings</a></li>
                        <li><a href="{{ route('recaptcha.index') }}">Recaptcha Settings</a></li>
                        <li><a href="{{ route('emailSetting.index') }}">Email Settings</a></li>
                    </ul>
                </li>
                    {{-- @endif --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
