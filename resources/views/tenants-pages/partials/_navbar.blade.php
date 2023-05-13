<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input month-picker" placeholder="Search Here" id="searchBill" name="searchBill">
                </div>
            </form>
        </div>
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
            $notification = auth('tenants')
                ->user()
                ->notifications()
                ->latest('created_at')
                ->get();
        @endphp

        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>

                    @if (count($notification) > 0)
                        <span class="badge notification-active"></span>
                    @endif

                </a>
                @if (count($notification) > 0)
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list ml-2 mb-3">
                            <a href="{{ route('role.tenants.clear-notification') }}"><i
                                    class="fa fa-trash"></i>&nbsp;&nbsp;Clear all notifications</a>
                        </div>
                        <div class="notification-list mx-h-350 customscroll">

                            <ul>
                                @foreach ($notification as $notify)
                                    <li>
                                        <a href="#notify-{{ $notify->url }}">
                                            <img src="{{ asset('vendors/images/bell-notify.png') }}" alt="">
                                            <h3>Room billing notify</h3>
                                            <p>{{ $notify->content }}</p>
                                            <span
                                                style="font-size: 10px">{{ $notify->created_at->diffForHumans() }}</span>
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
                        @if (auth('tenants')->user()->avatar == null)
                            <img src="{{ asset('avatar/default-avatar.png') }}" alt="" class="avatar-photo">
                        @else
                            <img src="{{ asset('avatar/' . auth('tenants')->user()->avatar) }}" alt=""
                                class="avatar-photo">
                        @endif

                    </span>
                    {{-- <span class="user-name">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </span> --}}
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    {{-- <span class="dropdown-item">
                        <b>
                            @auth
                                {{ Auth::user()->name }}
                            @endauth
                        </b>
                    </span> --}}
                    <a class="dropdown-item" href="{{ route('role.tenants.profile') }}">
                        <i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i> Layout settings</a>
                    <a class="dropdown-item" href="faq.html">
                        <i class="dw dw-help"></i> Help</a>
                    <a class="dropdown-item" href="{{ route('role.tenants.logout') }}">
                        <i class="dw dw-logout"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
