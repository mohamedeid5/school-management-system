<!-- Dashboard -->
<li class="{{ request()->routeIs('parent.dashboard') ? 'active' : '' }}">
    <a href="{{ route('parent.dashboard') }}">
        <i class="ti-home"></i><span class="right-nav-text">{{ __('main.dashboard') }}</span>
    </a>
</li>
