<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        {{-- <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search">
                    <div class="dropdown">
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
    <div class="header-right">
        {{-- <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div> --}}

        @php
            $notifications = Auth::user()
                ->notifications()
                ->latest('created_at')
                ->get();
        @endphp

        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    @if ($notifications->count() > 0)
                        <span class="badge notification-active"></span>
                    @endif
                </a>
                @if ($notifications->count() > 0)
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list ml-2 mb-3">
                            <a href="{{ route('clear-notification') }}">
                                <i class="fa fa-trash"></i>&nbsp;&nbsp;Clear all notifications</a>
                        </div>
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                @foreach ($notifications as $notify)
                                    <li>
                                        <a href="{{ $notify->url }}">
                                            <img src="{{ asset('vendors/images/bell-notify.png') }}" alt="">
                                            <h3>Bill status</h3>
                                            <p>{{ $notify->content }}</p>

                                            <span style="font-size: 10px">{{ $notify->created_at->diffForHumans() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 text-center">
                            <p>There is no notification</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        @if (auth()->user()->avatar == null)
                            <img src="{{ asset('avatar/default-avatar.png') }}" alt="" class="avatar-photo">
                        @else
                            <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt=""
                                class="avatar-photo">
                        @endif

                    </span>
                    <span class="user-name">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i> Layout settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="dw dw-logout"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
