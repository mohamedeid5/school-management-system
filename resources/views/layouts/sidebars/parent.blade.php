<!-- Dashboard -->
<li class="{{ request()->routeIs('parent.dashboard') ? 'active' : '' }}">
    <a href="{{ route('parent.dashboard') }}">
        <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
    </a>
</li>

<!-- menu title -->
<li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('main.processes') }}</li>

<!-- Subjects -->
<li class="{{ request()->routeIs('parent.subjects.*') ? 'active' : '' }}">
    <a href="{{ route('parent.subjects.index') }}">
        <i class="ti-book"></i><span class="right-nav-text">{{ __('main.my_subjects') }}</span>
    </a>
</li>

<!-- Exams -->
<li class="{{ request()->routeIs('parent.exams.*') ? 'active' : '' }}">
    <a href="{{ route('parent.exams.index') }}">
        <i class="ti-write"></i><span class="right-nav-text">{{ __('main.my_exams') }}</span>
    </a>
</li>

<!-- Attendance -->
<li class="{{ request()->routeIs('parent.attendances.*') ? 'active' : '' }}">
    <a href="{{ route('parent.attendances.index') }}">
        <i class="ti-check-box"></i><span class="right-nav-text">{{ __('main.my_attendance') }}</span>
    </a>
</li>

<!-- Online Classes -->
<li class="{{ request()->routeIs('parent.online-classes.*') ? 'active' : '' }}">
    <a href="{{ route('parent.online-classes.index') }}">
        <i class="ti-video-camera"></i><span class="right-nav-text">{{ __('main.online_classes') }}</span>
    </a>
</li>

<!-- Library -->
<li class="{{ request()->routeIs('parent.libraries.*') ? 'active' : '' }}">
    <a href="{{ route('parent.libraries.index') }}">
        <i class="ti-archive"></i><span class="right-nav-text">{{ __('main.library') }}</span>
    </a>
</li>

<!-- Fee Invoices -->
<li class="{{ request()->routeIs('parent.fee-invoices.*') ? 'active' : '' }}">
    <a href="{{ route('parent.fee-invoices.index') }}">
        <i class="ti-money"></i><span class="right-nav-text">{{ __('main.fee_invoices') }}</span>
    </a>
</li>
