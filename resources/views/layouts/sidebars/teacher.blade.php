<!-- Dashboard -->
<li class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
    <a href="{{ route('teacher.dashboard') }}">
        <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
    </a>
</li>

<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

<!-- Sections -->
<li class="{{ request()->routeIs('sections.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections">
        <div class="pull-left"><i class="ti-layout-tab"></i><span class="right-nav-text">{{ __('main.sections') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="sections" class="collapse {{ request()->routeIs('teacher.sections.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.sections.index') ? 'active' : '' }}"><a href="{{ route('teacher.sections.index') }}">{{ __('main.sections_list') }}</a></li>
    </ul>
</li>

<!-- Subjects -->
<li class="{{ request()->routeIs('teacher.subjects.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
        <div class="pull-left"><i class="ti-book"></i><span class="right-nav-text">{{ __('main.subjects') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="subjects" class="collapse {{ request()->routeIs('teacher.subjects.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.subjects.index') ? 'active' : '' }}"><a href="{{ route('teacher.subjects.index') }}">{{ __('main.subjects_list') }}</a></li>
    </ul>
</li>

<!-- Students -->
<li class="{{ request()->routeIs('teacher.students.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students">
        <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">{{ __('main.students') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="students" class="collapse {{ request()->routeIs('teacher.students.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.students.index') ? 'active' : '' }}"><a href="{{ route('teacher.students.index') }}">{{ __('main.students_list') }}</a></li>
    </ul>
</li>

<!-- Attendances -->
<li class="{{ request()->routeIs('teacher.attendances.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendances">
        <div class="pull-left"><i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.attendances') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="attendances" class="collapse {{ request()->routeIs('teacher.attendances.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.attendances.index') ? 'active' : '' }}"><a href="{{ route('teacher.attendances.index') }}">{{ __('main.attendances') }}</a></li>
    </ul>
</li>

<!-- Exams -->
<li class="{{ request()->routeIs('teacher.exams.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#exams">
        <div class="pull-left"><i class="ti-write"></i><span class="right-nav-text">{{ __('main.exams') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="exams" class="collapse {{ request()->routeIs('teacher.exams.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.exams.index') ? 'active' : '' }}"><a href="{{ route('teacher.exams.index') }}">{{ __('main.exams_list') }}</a></li>
    </ul>
</li>

<!-- Questions -->
<li class="{{ request()->routeIs('teacher.questions.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions">
        <div class="pull-left"><i class="ti-help-alt"></i><span class="right-nav-text">{{ __('main.questions') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="questions" class="collapse {{ request()->routeIs('teacher.questions.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.questions.index') ? 'active' : '' }}"><a href="{{ route('teacher.questions.index') }}">{{ __('main.questions_list') }}</a></li>
    </ul>
</li>

<!-- Online Classes -->
<li class="{{ request()->routeIs('teacher.online-classes.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#online-classes">
        <div class="pull-left"><i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="online-classes" class="collapse {{ request()->routeIs('teacher.online-classes.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.online-classes.index') ? 'active' : '' }}"><a href="{{ route('teacher.online-classes.index') }}">{{ __('main.online_classes_list') }}</a></li>
        <li class="{{ request()->routeIs('teacher.online-classes.create') ? 'active' : '' }}"><a href="{{ route('teacher.online-classes.create') }}">{{ __('main.add_online_class') }}</a></li>
    </ul>
</li>

<!-- Library -->
<li class="{{ request()->routeIs('teacher.libraries.*') ? 'active' : '' }}">
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library">
        <div class="pull-left"><i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span></div>
        <div class="pull-right"><i class="ti-plus"></i></div>
        <div class="clearfix"></div>
    </a>
    <ul id="library" class="collapse {{ request()->routeIs('teacher.libraries.*') ? 'show' : '' }}" data-parent="#sidebarnav">
        <li class="{{ request()->routeIs('teacher.libraries.index') ? 'active' : '' }}"><a href="{{ route('teacher.libraries.index') }}">{{ __('main.libraries_list') }}</a></li>
    </ul>
</li>
