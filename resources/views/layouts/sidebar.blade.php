<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">

                    @role('admin')
                        @include('layouts.sidebars.admin')
                    @elserole('teacher')
                        @include('layouts.sidebars.teacher')
                    @elserole('student')
                        @include('layouts.sidebars.student')
                    @elserole('parent')
                        @include('layouts.sidebars.parent')
                    @else
                        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
                            </a>
                        </li>
                    @endrole

                </ul>
            </div>
        </div>
        <!-- Left Sidebar End-->
