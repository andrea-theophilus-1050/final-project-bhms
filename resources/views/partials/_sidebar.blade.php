<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
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
                    <a href="{{ route('home') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('home') ? 'active' : '' }}">
                        <span class="micon fa fa-dashboard"></span><span class="mtext">@lang('messages.navHome')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('payment.index') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('payment.index') ? 'active' : '' }}">
                        <span class="micon dw dw-settings2"></span><span class="mtext">Config Payment VNPay</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('services.index') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('services.index') ? 'active' : '' }}">
                        <span class="micon dw dw-suitcase"></span><span class="mtext">@lang('messages.navService')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('house.index') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('house.index') || request()->routeIs('room.index') || request()->routeIs('room.assign-tenant') ? 'active' : '' }}">
                        <span class="micon dw dw-house1"></span><span class="mtext">@lang('messages.navHouse')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tenant.index') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('tenant.index') || request()->routeIs('tenant.create') || request()->routeIs('tenant.edit') ? 'active' : '' }}">
                        <span class="micon dw dw-user-2"></span><span class="mtext">@lang('messages.navTenant')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('electricity-bill', [now()->format('F Y'), 'all-house']) }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('electricity-bill') ? 'active' : '' }}">
                        <span class="micon dw dw-flash1"></span><span class="mtext">Electricity bill</span>

                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('water-bill', [now()->format('F Y'), 'all-house']) }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('water-bill') ? 'active' : '' }}">
                        <span class="micon dw dw-save-water"></span><span class="mtext">Water bill</span>

                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('costs-incurred') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('costs-incurred') ? 'active' : '' }}">
                        <span class="micon dw dw-notebook"></span><span class="mtext">@lang('messages.navCostsIncurred')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('room-billing', [now()->format('F Y'), 'all-house']) }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('room-billing') ? 'active' : '' }}">
                        <span class="micon fa fa-calculator"></span><span class="mtext">@lang('messages.navRoomBilling')</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('feedback') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('feedback') ? 'active' : '' }}">
                        <span class="micon dw dw-chat-11"></span><span class="mtext">@lang('messages.navFeedback')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
