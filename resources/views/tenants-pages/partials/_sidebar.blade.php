<div class="left-side-bar">
    <div class="brand-logo">
        <a>
            <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="" class="dark-logo">
            <img src="{{ asset('vendors/images/logo-boarding-house-white.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="{{ route('role.tenants.index') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('role.tenants.index') ? 'active' : '' }}">
                        <span class="micon fa fa-dashboard"></span><span class="mtext">@lang('messages.navHome')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('role.tenants.feedback') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('role.tenants.feedback') ? 'active' : '' }}">
                        <span class="micon dw dw-paper-plane"></span><span class="mtext">Send Feedback</span>
                    </a>
                </li>



            </ul>
        </div>
    </div>
</div>
