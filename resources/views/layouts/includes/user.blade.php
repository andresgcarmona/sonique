<header class="aside-header block">
    <button class="btn-account flex flex-col items-center w-full" type="button"
            data-toggle="collapse"
            data-target="#dropdown-aside">
        <span class="user-avatar rounded-full overflow-hidden mb-3 h-24 w-24 block mx-auto">
            <img src="{{ user()->avatar }}" alt="" class="block">
        </span>
        <span class="account-summary">
            <span class="account-name">{{ user()->username }}</span>
            @admin
            <span class="account-description">{{ __('Admin') }}</span>
            @endadmin
        </span>
    </button>
    <div id="dropdown-aside" class="dropdown-aside collapse">
        <div class="pb-3">
            <a class="dropdown-item" href="{{ ('profile') }}"><span
                        class="dropdown-icon oi oi-person"></span>{{ __('Profile') }}</a>
            @admin
            <a class="dropdown-item" href="{{ ('admin.index') }}"><span
                        class="dropdown-icon fas fa-cog"></span> {{ __('Admin') }}</a>
            @endadmin
            <a class="dropdown-item" href="{{ route('logout') }}"><span
                        class="dropdown-icon oi oi-account-logout"></span>{{ __('Logout') }}</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">{{ __('Help Center') }}</a>
            <a class="dropdown-item" href="#">{{ __('Ask Forum') }}</a>
            <a class="dropdown-item" href="#">{{ __('Keyboard Shortcuts') }}</a>
        </div>
    </div>
</header>
