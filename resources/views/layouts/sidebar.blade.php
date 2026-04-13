<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    <!-- Dashboard -->
                    <li>
                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}">
                        @elserole('teacher')
                            <a href="{{ route('teacher.dashboard') }}">
                        @else
                            <a href="{{ route('dashboard') }}">
                        @endrole
                            <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
                        </a>
                    </li>

                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

                    @role('admin|teacher')
                    @role('admin')
                    <!-- Grades -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#grades">
                            <div class="pull-left"><i class="ti-bookmark-alt"></i><span class="right-nav-text">{{ __('main.grades') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="grades" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('grades.index') }}">{{ __('main.grades_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Classrooms -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classrooms">
                            <div class="pull-left"><i class="ti-blackboard"></i><span class="right-nav-text">{{ __('main.classrooms') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classrooms" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('classrooms.index') }}">{{ __('main.classrooms_list') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Sections -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
                            <div class="pull-left"><i class="ti-layout-tab"></i><span class="right-nav-text">{{ __('main.sections') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('sections.index') }}">{{ __('main.sections_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Subjects -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                            <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Teachers -->
                    @role('admin')
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers">
                            <div class="pull-left"><i class="ti-pencil-alt"></i><span class="right-nav-text">{{ __('main.teachers') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teachers" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('teachers.index') }}">{{ __('main.teachers_list') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Students -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
                            <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">{{ __('main.students') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('students.index') }}">{{ __('main.students_list') }}</a></li>
                        </ul>
                    </li>

                    @role('admin')
                    <!-- Parents -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
                            <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">{{ __('main.parents') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="parents" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('add_parent') }}">{{ __('main.add_parent') }}</a></li>
                        </ul>
                    </li>
                    @endrole

                    <!-- Attendances -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendances">
                            <div class="pull-left"><i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.attendances') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendances" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('attendances.index') }}">{{ __('main.attendances') }}</a></li>
                        </ul>
                    </li>

                    <!-- Exams -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
                            <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.exams') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="exams" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('exams.index') }}">{{ __('main.exams_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Questions -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions">
                            <div class="pull-left"><i class="ti-help-alt"></i><span class="right-nav-text">{{ __('main.questions') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="questions" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('questions.index') }}">{{ __('main.questions_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Online Classes -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#online-classes">
                            <div class="pull-left"><i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="online-classes" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('online-classes.index') }}">{{ __('main.online_classes_list') }}</a></li>
                            @role('admin|teacher')
                            <li><a href="{{ route('online-classes.create') }}">{{ __('main.add_online_class') }}</a></li>
                            @endrole
                        </ul>
                    </li>

                    <!-- Library -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
                            <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
                            @role('admin')
                            <li><a href="{{ route('libraries.create') }}">{{ __('main.add_library') }}</a></li>
                            @endrole
                        </ul>
                    </li>
                    @endrole

                    @can('manage_settings')
                    <!-- Fees -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
                            <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">{{ __('main.fees') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('fees.index') }}">{{ __('main.fees_list') }}</a></li>
                            <li><a href="{{ route('fee-invoices.index') }}">{{ __('main.fee_invoices') }}</a></li>
                            <li><a href="{{ route('receipt-students.index') }}">{{ __('main.receipt_students') }}</a></li>
                            <li><a href="{{ route('processing-fees.index') }}">{{ __('main.processing_fees') }}</a></li>
                            <li><a href="{{ route('payment-students.index') }}">{{ __('main.payment_students') }}</a></li>
                        </ul>
                    </li>

                    <!-- Promotions -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#promotions">
                            <div class="pull-left"><i class="ti-arrow-circle-up"></i><span class="right-nav-text">{{ __('main.promotions') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="promotions" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('promotions.index') }}">{{ __('main.promotions') }}</a></li>
                            <li><a href="{{ route('promotions.management') }}">{{ __('main.manage_promotions') }}</a></li>
                        </ul>
                    </li>

                    <!-- Graduations -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#graduations">
                            <div class="pull-left"><i class="ti-crown"></i><span class="right-nav-text">{{ __('main.graduations') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="graduations" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('graduations.index') }}">{{ __('main.graduations') }}</a></li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li>
                        <a href="{{ route('settings.edit') }}">
                            <i class="ti-settings"></i><span class="right-nav-text">{{ __('main.settings') }}</span>
                        </a>
                    </li>
                    @endcan

                </ul>
            </div>
        </div>
        <!-- Left Sidebar End-->
