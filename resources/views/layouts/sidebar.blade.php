<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    <!-- Dashboard -->
                    <li class="{{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'active' : '' }}">
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}">
                        @elserole('teacher')
                            <a href="{{ route('teacher.dashboard') }}">
                        @elserole('student')
                            <a href="{{ route('student.dashboard') }}">
                        @elserole('parent')
                            <a href="{{ route('parent.dashboard') }}">
                        @else
                            <a href="{{ route('dashboard') }}">
                        @endrole
                            <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
                        </a>
                    </li>

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

                    @role('student')
                    <!-- Subjects -->
                    <li class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                            <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.my_subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse {{ request()->routeIs('subjects.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('subjects.index') ? 'active' : '' }}"><a href="{{ route('subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Exams -->
                    <li class="{{ request()->routeIs('exams.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
                            <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.my_exams') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="exams" class="collapse {{ request()->routeIs('exams.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('exams.index') ? 'active' : '' }}"><a href="{{ route('exams.index') }}">{{ __('main.exams_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Attendance -->
                    <li class="{{ request()->is('*#attendance') ? 'active' : '' }}">
                        <a href="{{ route('student.dashboard') }}#attendance">
                            <i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.my_attendance') }}</span>
                        </a>
                    </li>

                    <!-- Library -->
                    <li class="{{ request()->routeIs('libraries.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse {{ request()->routeIs('libraries.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('libraries.index') ? 'active' : '' }}"><a href="{{ route('libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    @role('admin|teacher')
                    @role('admin')
                    <!-- Grades -->
                    <li class="{{ request()->routeIs('grades.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#grades">
                            <div class="pull-left"><i class="ti-bookmark-alt"></i><span class="right-nav-text">{{ __('main.grades') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="grades" class="collapse {{ request()->routeIs('grades.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('grades.index') ? 'active' : '' }}"><a href="{{ route('grades.index') }}">{{ __('main.grades_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Classrooms -->
                    <li class="{{ request()->routeIs('classrooms.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classrooms">
                            <div class="pull-left"><i class="ti-blackboard"></i><span class="right-nav-text">{{ __('main.classrooms') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classrooms" class="collapse {{ request()->routeIs('classrooms.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('classrooms.index') ? 'active' : '' }}"><a href="{{ route('classrooms.index') }}">{{ __('main.classrooms_list') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Sections -->
                    <li class="{{ request()->routeIs('sections.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                            <div class="pull-left"><i class="ti-layout-tab"></i><span class="right-nav-text">{{ __('main.sections') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections" class="collapse {{ request()->routeIs('sections.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('sections.index') ? 'active' : '' }}"><a href="{{ route('sections.index') }}">{{ __('main.sections_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Subjects -->
                    <li class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                            <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse {{ request()->routeIs('subjects.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('subjects.index') ? 'active' : '' }}"><a href="{{ route('subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Teachers -->
                    @role('admin')
                    <li class="{{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers">
                            <div class="pull-left"><i class="ti-pencil-alt"></i><span class="right-nav-text">{{ __('main.teachers') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teachers" class="collapse {{ request()->routeIs('teachers.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('teachers.index') ? 'active' : '' }}"><a href="{{ route('teachers.index') }}">{{ __('main.teachers_list') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Students -->
                    <li class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
                            <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">{{ __('main.students') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students" class="collapse {{ request()->routeIs('students.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('students.index') ? 'active' : '' }}"><a href="{{ route('students.index') }}">{{ __('main.students_list') }}</a></li>
                        </ul>
                    </li>

                    @role('admin')
                    <!-- Parents -->
                    <li class="{{ request()->routeIs('add_parent') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">{{ __('main.parents') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="parents" class="collapse {{ request()->routeIs('add_parent') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('add_parent') ? 'active' : '' }}"><a href="{{ route('add_parent') }}">{{ __('main.add_parent') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Attendances -->
                    <li class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendances">
                            <div class="pull-left"><i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.attendances') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendances" class="collapse {{ request()->routeIs('attendances.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('attendances.index') ? 'active' : '' }}"><a href="{{ route('attendances.index') }}">{{ __('main.attendances') }}</a></li>
                        </ul>
                    </li>

                    <!-- Exams -->
                    <li class="{{ request()->routeIs('exams.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
                            <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.exams') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="exams" class="collapse {{ request()->routeIs('exams.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('exams.index') ? 'active' : '' }}"><a href="{{ route('exams.index') }}">{{ __('main.exams_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Questions -->
                    <li class="{{ request()->routeIs('questions.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions">
                            <div class="pull-left"><i class="ti-help-alt"></i><span class="right-nav-text">{{ __('main.questions') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="questions" class="collapse {{ request()->routeIs('questions.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('questions.index') ? 'active' : '' }}"><a href="{{ route('questions.index') }}">{{ __('main.questions_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Online Classes -->
                    <li class="{{ request()->routeIs('online-classes.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#online-classes">
                            <div class="pull-left"><i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online-classes" class="collapse {{ request()->routeIs('online-classes.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('online-classes.index') ? 'active' : '' }}"><a href="{{ route('online-classes.index') }}">{{ __('main.online_classes_list') }}</a></li>
                            @role('admin|teacher')
                            <li class="{{ request()->routeIs('online-classes.create') ? 'active' : '' }}"><a href="{{ route('online-classes.create') }}">{{ __('main.add_online_class') }}</a></li>
                            @endrole
                        </ul>
                    </li>

                    <!-- Library -->
                    <li class="{{ request()->routeIs('libraries.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse {{ request()->routeIs('libraries.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('libraries.index') ? 'active' : '' }}"><a href="{{ route('libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
                            @role('admin')
                            <li class="{{ request()->routeIs('libraries.create') ? 'active' : '' }}"><a href="{{ route('libraries.create') }}">{{ __('main.add_library') }}</a></li>
                            @endrole
                        </ul>
                    </li>
                    @endrole

                    @can('manage_settings')
                    <!-- Fees -->
                    <li class="{{ request()->routeIs('fees.*') || request()->routeIs('fee-invoices.*') || request()->routeIs('receipt-students.*') || request()->routeIs('processing-fees.*') || request()->routeIs('payment-students.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
                            <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">{{ __('main.fees') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees" class="collapse {{ request()->routeIs('fees.*') || request()->routeIs('fee-invoices.*') || request()->routeIs('receipt-students.*') || request()->routeIs('processing-fees.*') || request()->routeIs('payment-students.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('fees.index') ? 'active' : '' }}"><a href="{{ route('fees.index') }}">{{ __('main.fees_list') }}</a></li>
                            <li class="{{ request()->routeIs('fee-invoices.*') ? 'active' : '' }}"><a href="{{ route('fee-invoices.index') }}">{{ __('main.fee_invoices') }}</a></li>
                            <li class="{{ request()->routeIs('receipt-students.*') ? 'active' : '' }}"><a href="{{ route('receipt-students.index') }}">{{ __('main.receipt_students') }}</a></li>
                            <li class="{{ request()->routeIs('processing-fees.*') ? 'active' : '' }}"><a href="{{ route('processing-fees.index') }}">{{ __('main.processing_fees') }}</a></li>
                            <li class="{{ request()->routeIs('payment-students.*') ? 'active' : '' }}"><a href="{{ route('payment-students.index') }}">{{ __('main.payment_students') }}</a></li>
                        </ul>
                    </li>

                    <!-- Promotions -->
                    <li class="{{ request()->routeIs('promotions.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#promotions">
                            <div class="pull-left"><i class="ti-arrow-circle-up"></i><span class="right-nav-text">{{ __('main.promotions') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="promotions" class="collapse {{ request()->routeIs('promotions.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('promotions.index') ? 'active' : '' }}"><a href="{{ route('promotions.index') }}">{{ __('main.promotions') }}</a></li>
                            <li class="{{ request()->routeIs('promotions.management') ? 'active' : '' }}"><a href="{{ route('promotions.management') }}">{{ __('main.manage_promotions') }}</a></li>
                        </ul>
                    </li>

                    <!-- Graduations -->
                    <li class="{{ request()->routeIs('graduations.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#graduations">
                            <div class="pull-left"><i class="ti-crown"></i><span class="right-nav-text">{{ __('main.graduations') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="graduations" class="collapse {{ request()->routeIs('graduations.*') ? 'show' : '' }}" data-parent="#sidebarnav">
                            <li class="{{ request()->routeIs('graduations.index') ? 'active' : '' }}"><a href="{{ route('graduations.index') }}">{{ __('main.graduations') }}</a></li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                        <a href="{{ route('settings.edit') }}">
                            <i class="ti-settings"></i><span class="right-nav-text">{{ __('main.settings') }}</span>
                        </a>
                    </li>
                    @endcan

                </ul>
            </div>
        </div>
        <!-- Left Sidebar End-->
