<aside class="app-aside lg:expanded flex h-full fixed top-0 bottom-0 left-0 w-64 pt-2">
    <div class="aside-content flex flex-col h-full w-full">
        @auth
            @include('layouts.includes.user')
        @else
            <header class="aside-header d-block d-md-none shadow-none border-bottom">
                <ul class="menu">
                    <li class="menu-item my-3">
                        <a href="{{ route('login') }}" class="menu-link">{{ __('Login') }}</a>
                    </li>
                </ul>
            </header>
        @endauth

        <div class="aside-menu overflow-hidden ps h-full">
            <nav id="stacked-menu" class="stacked-menu stacked-menu-has-collapsible">
                <sidebar></sidebar>
                <ul class="menu">
                    <li class="menu-item
                    @if(in_array(request()->route()->getName(), [
                    ]))
                    {{ 'has-active' }}
                    @endif">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('headphones', 'fa-fw')</span>
                            <span class="menu-text">{{__('Artists')}}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('music', 'fa-fw')</span>
                            <span class="menu-text">{{__('Songs')}}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('list', 'fa-fw')</span>
                            <span class="menu-text">{{__('Playlists')}}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('broadcast-tower', 'fa-fw')</span>
                            <span class="menu-text">{{ __('Radio') }}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('podcast', 'fa-fw')</span>
                            <span class="menu-text">{{ __('Podcasts') }}</span>
                        </a>
                    </li>
                    <li class="menu-item
                    @if(in_array(request()->route()->getName(), [
                        'teams.index',
                        'team.show'
                    ]))
                    {{ 'has-active' }}
                    @endif">
                        <a href="" class="menu-link">
                            <span class="menu-icon">@fas('random', 'fa-fw')</span>
                            <span class="menu-text">{{ __('Daily Mix') }}</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">@fas('users', 'fa-fw')</span>
                            <span class="menu-text">{{ __('Friends') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <footer class="aside-footer border-top p-3">
            <button class="btn btn-light btn-block text-dark">
                <i class="fas fa-cog ml-1 far"></i> {{__('Configuration')}}
            </button>
        </footer>
    </div>
</aside>
