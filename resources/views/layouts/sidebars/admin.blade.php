<!-- Dashboard -->
<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
        <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
    </a>
</li>

<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

<!-- Grades -->
<li class="{{ request()->routeIs('admin.grades.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#grades">
        <div class="pull-left"><i class="ti-bookmark-alt"></i><span class="right-nav-text">{{ __('main.grades') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="grades" class="collapse {{ request()->routeIs('admin.grades.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.grades.index') ? 'active' : '' }}"><a href="{{ route('admin.grades.index') }}">{{ __('main.grades_list') }}</a></li>
    </ul>
</li>

<!-- Classrooms -->
<li class="{{ request()->routeIs('admin.classrooms.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#classrooms">
        <div class="pull-left"><i class="ti-blackboard"></i><span class="right-nav-text">{{ __('main.classrooms') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="classrooms" class="collapse {{ request()->routeIs('admin.classrooms.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.classrooms.index') ? 'active' : '' }}"><a href="{{ route('admin.classrooms.index') }}">{{ __('main.classrooms_list') }}</a></li>
    </ul>
</li>

<!-- Sections -->
<li class="{{ request()->routeIs('admin.sections.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
        <div class="pull-left"><i class="ti-layout-tab"></i><span class="right-nav-text">{{ __('main.sections') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="sections" class="collapse {{ request()->routeIs('admin.sections.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.sections.index') ? 'active' : '' }}"><a href="{{ route('admin.sections.index') }}">{{ __('main.sections_list') }}</a></li>
    </ul>
</li>

<!-- Subjects -->
<li class="{{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
        <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.subjects') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="subjects" class="collapse {{ request()->routeIs('admin.subjects.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.subjects.index') ? 'active' : '' }}"><a href="{{ route('admin.subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
    </ul>
</li>

<!-- Teachers -->
<li class="{{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers">
        <div class="pull-left"><i class="ti-pencil-alt"></i><span class="right-nav-text">{{ __('main.teachers') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="teachers" class="collapse {{ request()->routeIs('admin.teachers.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.teachers.index') ? 'active' : '' }}"><a href="{{ route('admin.teachers.index') }}">{{ __('main.teachers_list') }}</a></li>
    </ul>
</li>

<!-- Students -->
<li class="{{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
        <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">{{ __('main.students') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="students" class="collapse {{ request()->routeIs('admin.students.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.students.index') ? 'active' : '' }}"><a href="{{ route('admin.students.index') }}">{{ __('main.students_list') }}</a></li>
    </ul>
</li>

<!-- Parents -->
<li class="{{ request()->routeIs('admin.add_parent') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents">
        <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">{{ __('main.parents') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="parents" class="collapse {{ request()->routeIs('admin.add_parent') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.add_parent') ? 'active' : '' }}"><a href="{{ route('admin.add_parent') }}">{{ __('main.add_parent') }}</a></li>
    </ul>
</li>

<!-- Attendances -->
<li class="{{ request()->routeIs('admin.attendances.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendances">
        <div class="pull-left"><i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.attendances') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="attendances" class="collapse {{ request()->routeIs('admin.attendances.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.attendances.index') ? 'active' : '' }}"><a href="{{ route('admin.attendances.index') }}">{{ __('main.attendances') }}</a></li>
    </ul>
</li>

<!-- Exams -->
<li class="{{ request()->routeIs('admin.exams.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
        <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.exams') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="exams" class="collapse {{ request()->routeIs('admin.exams.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.exams.index') ? 'active' : '' }}"><a href="{{ route('admin.exams.index') }}">{{ __('main.exams_list') }}</a></li>
    </ul>
</li>

<!-- Questions -->
<li class="{{ request()->routeIs('admin.questions.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions">
        <div class="pull-left"><i class="ti-help-alt"></i><span class="right-nav-text">{{ __('main.questions') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="questions" class="collapse {{ request()->routeIs('admin.questions.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.questions.index') ? 'active' : '' }}"><a href="{{ route('admin.questions.index') }}">{{ __('main.questions_list') }}</a></li>
    </ul>
</li>

<!-- Online Classes -->
<li class="{{ request()->routeIs('admin.online-classes.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#online-classes">
        <div class="pull-left"><i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="online-classes" class="collapse {{ request()->routeIs('admin.online-classes.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.online-classes.index') ? 'active' : '' }}"><a href="{{ route('admin.online-classes.index') }}">{{ __('main.online_classes_list') }}</a></li>
        <li class="{{ request()->routeIs('admin.online-classes.create') ? 'active' : '' }}"><a href="{{ route('admin.online-classes.create') }}">{{ __('main.add_online_class') }}</a></li>
    </ul>
</li>

<!-- Library -->
<li class="{{ request()->routeIs('admin.libraries.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
        <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="library" class="collapse {{ request()->routeIs('admin.libraries.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.libraries.index') ? 'active' : '' }}"><a href="{{ route('admin.libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
        <li class="{{ request()->routeIs('admin.libraries.create') ? 'active' : '' }}"><a href="{{ route('admin.libraries.create') }}">{{ __('main.add_library') }}</a></li>
    </ul>
</li>

@can('manage_settings')
<!-- Fees -->
<li class="{{ request()->routeIs('admin.fees.*') || request()->routeIs('admin.fee-invoices.*') || request()->routeIs('admin.receipt-students.*') || request()->routeIs('admin.processing-fees.*') || request()->routeIs('admin.payment-students.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
        <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">{{ __('main.fees') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="fees" class="collapse {{ request()->routeIs('admin.fees.*') || request()->routeIs('admin.fee-invoices.*') || request()->routeIs('admin.receipt-students.*') || request()->routeIs('admin.processing-fees.*') || request()->routeIs('admin.payment-students.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.fees.index') ? 'active' : '' }}"><a href="{{ route('admin.fees.index') }}">{{ __('main.fees_list') }}</a></li>
        <li class="{{ request()->routeIs('admin.fee-invoices.*') ? 'active' : '' }}"><a href="{{ route('admin.fee-invoices.index') }}">{{ __('main.fee_invoices') }}</a></li>
        <li class="{{ request()->routeIs('admin.receipt-students.*') ? 'active' : '' }}"><a href="{{ route('admin.receipt-students.index') }}">{{ __('main.receipt_students') }}</a></li>
        <li class="{{ request()->routeIs('admin.processing-fees.*') ? 'active' : '' }}"><a href="{{ route('admin.processing-fees.index') }}">{{ __('main.processing_fees') }}</a></li>
        <li class="{{ request()->routeIs('admin.payment-students.*') ? 'active' : '' }}"><a href="{{ route('admin.payment-students.index') }}">{{ __('main.payment_students') }}</a></li>
    </ul>
</li>

<!-- Promotions -->
<li class="{{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#promotions">
        <div class="pull-left"><i class="ti-arrow-circle-up"></i><span class="right-nav-text">{{ __('main.promotions') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="promotions" class="collapse {{ request()->routeIs('admin.promotions.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.promotions.index') ? 'active' : '' }}"><a href="{{ route('admin.promotions.index') }}">{{ __('main.promotions') }}</a></li>
        <li class="{{ request()->routeIs('admin.promotions.management') ? 'active' : '' }}"><a href="{{ route('admin.promotions.management') }}">{{ __('main.manage_promotions') }}</a></li>
    </ul>
</li>

<!-- Graduations -->
<li class="{{ request()->routeIs('admin.graduations.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#graduations">
        <div class="pull-left"><i class="ti-crown"></i><span class="right-nav-text">{{ __('main.graduations') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="graduations" class="collapse {{ request()->routeIs('admin.graduations.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('admin.graduations.index') ? 'active' : '' }}"><a href="{{ route('admin.graduations.index') }}">{{ __('main.graduations') }}</a></li>
    </ul>
</li>

<!-- Settings -->
<li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
    <a href="{{ route('admin.settings.edit') }}">
        <i class="ti-settings"></i><span class="right-nav-text">{{ __('main.settings') }}</span>
    </a>
</li>
@endcan
