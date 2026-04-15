<!-- Dashboard -->
<li class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
    <a href="{{ route('student.dashboard') }}">
        <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
    </a>
</li>

<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

<!-- Subjects -->
<li class="{{ request()->routeIs('student.subjects.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
        <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.my_subjects') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="subjects" class="collapse {{ request()->routeIs('student.subjects.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('student.subjects.index') ? 'active' : '' }}"><a href="{{ route('student.subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
    </ul>
</li>

<!-- Exams -->
<li class="{{ request()->routeIs('student.exams.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
        <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.my_exams') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="exams" class="collapse {{ request()->routeIs('student.exams.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('student.exams.index') ? 'active' : '' }}"><a href="{{ route('student.exams.index') }}">{{ __('main.exams_list') }}</a></li>
    </ul>
</li>

<!-- Attendance -->
<li class="{{ request()->routeIs('student.attendances.*') ? 'active' : '' }}">
    <a href="{{ route('student.attendances.index') }}">
        <i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.my_attendance') }}</span>
    </a>
</li>

<!-- Online Classes -->
<li class="{{ request()->routeIs('student.online-classes.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#online-classes-student">
        <div class="pull-left"><i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="online-classes-student" class="collapse {{ request()->routeIs('student.online-classes.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('student.online-classes.index') ? 'active' : '' }}"><a href="{{ route('student.online-classes.index') }}">{{ __('main.online_classes_list') }}</a></li>
    </ul>
</li>

<!-- Library -->
<li class="{{ request()->routeIs('student.libraries.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
        <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="library" class="collapse {{ request()->routeIs('student.libraries.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('student.libraries.index') ? 'active' : '' }}"><a href="{{ route('student.libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
    </ul>
</li>

<!-- Fee Invoices -->
<li class="{{ request()->routeIs('student.fee-invoices.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#fee-invoices-student">
        <div class="pull-left"><i class="ti-money"></i><span class="right-nav-text">{{ __('main.fee_invoices') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="fee-invoices-student" class="collapse {{ request()->routeIs('student.fee-invoices.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('student.fee-invoices.index') ? 'active' : '' }}"><a href="{{ route('student.fee-invoices.index') }}">{{ __('main.fee_invoices_list') }}</a></li>
    </ul>
</li>
