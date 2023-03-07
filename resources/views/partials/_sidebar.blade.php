<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="" class="dark-logo">
            <img src="{{ asset('vendors/images/logo-boarding-house-white.png') }}" alt=""
                class="light-logo">
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
                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-home"></span><span class="mtext">@lang('messages.navRoom')</span>
                    </a>
                </li> --}}


                {{-- <li class="dropdown">
                    <a href="{{ route('utility-bill') }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('utility-bill') ? 'active' : '' }}">
                        <span class="micon dw dw-flash1"></span><span class="mtext">@lang('messages.navUtility')</span>

                    </a>
                </li> --}}

                <li class="dropdown">
                    <a href="{{ route('electricity-bill', now()->format('F Y')) }}"
                        class="dropdown-toggle no-arrow {{ request()->routeIs('electricity-bill') ? 'active' : '' }}">
                        <span class="micon dw dw-flash1"></span><span class="mtext">Electricity bill</span>

                    </a>
                </li>

                <li class="dropdown">
                    <a href="{{ route('water-bill', now()->format('F Y')) }}"
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
                    <a href="{{ route('room-billing') }}"
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
                {{-- <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-apartment"></span><span class="mtext"> UI Elements </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-cards-hover.html">Cards Hover</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-tabs.html">Tabs</a></li>
                        <li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
                        <li><a href="ui-sweet-alert.html">Sweet Alert</a></li>
                        <li><a href="ui-notification.html">Notification</a></li>
                        <li><a href="ui-timeline.html">Timeline</a></li>
                        <li><a href="ui-progressbar.html">Progressbar</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-list-group.html">List group</a></li>
                        <li><a href="ui-range-slider.html">Range slider</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-paint-brush"></span><span class="mtext">Icons</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="font-awesome.html">FontAwesome Icons</a></li>
                        <li><a href="foundation.html">Foundation Icons</a></li>
                        <li><a href="ionicons.html">Ionicons Icons</a></li>
                        <li><a href="themify.html">Themify Icons</a></li>
                        <li><a href="custom-icon.html">Custom Icons</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-analytics-21"></span><span class="mtext">Charts</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="highchart.html">Highchart</a></li>
                        <li><a href="knob-chart.html">jQuery Knob</a></li>
                        <li><a href="jvectormap.html">jvectormap</a></li>
                        <li><a href="apexcharts.html">Apexcharts</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-right-arrow1"></span><span class="mtext">Additional Pages</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="video-player.html">Video Player</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                        <li><a href="reset-password.html">Reset Password</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-browser2"></span><span class="mtext">Error Pages</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="400.html">400</a></li>
                        <li><a href="403.html">403</a></li>
                        <li><a href="404.html">404</a></li>
                        <li><a href="500.html">500</a></li>
                        <li><a href="503.html">503</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-copy"></span><span class="mtext">Extra Pages</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="blank.html">Blank</a></li>
                        <li><a href="contact-directory.html">Contact Directory</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-detail.html">Blog Detail</a></li>
                        <li><a href="product.html">Product</a></li>
                        <li><a href="product-detail.html">Product Detail</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="pricing-table.html">Pricing Tables</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-list3"></span><span class="mtext">Multi Level Menu</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="javascript:;">Level 1</a></li>
                        <li><a href="javascript:;">Level 1</a></li>
                        <li><a href="javascript:;">Level 1</a></li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-plug"></span><span class="mtext">Level 2</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="javascript:;">Level 2</a></li>
                                <li><a href="javascript:;">Level 2</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Level 1</a></li>
                        <li><a href="javascript:;">Level 1</a></li>
                        <li><a href="javascript:;">Level 1</a></li>
                    </ul>
                </li>
                <li>
                    <a href="sitemap.html" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-diagram"></span><span class="mtext">Sitemap</span>
                    </a>
                </li>
                <li>
                    <a href="chat.html" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-chat3"></span><span class="mtext">Chat</span>
                    </a>
                </li>
                <li>
                    <a href="invoice.html" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-invoice"></span><span class="mtext">Invoice</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Extra</div>
                </li>
                <li>
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-edit-2"></span><span class="mtext">Documentation</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="introduction.html">Introduction</a></li>
                        <li><a href="getting-started.html">Getting Started</a></li>
                        <li><a href="color-settings.html">Color Settings</a></li>
                        <li><a href="third-party-plugins.html">Third Party Plugins</a></li>
                    </ul>
                </li>
                <li>
                    <a href="https://dropways.github.io/deskapp-free-single-page-website-template/"
                        target="_blank" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-paper-plane1"></span>
                        <span class="mtext">Landing Page <img src="vendors/images/coming-soon.png"
                                alt="" width="25"></span>
                    </a>
                </li> --}}

                {{-- put element to the bottom of the sidebar --}}
                {{-- <li style="margin-top: 30%">
                    <div class="dropdown-divider"></div>
                </li>
                <li class="dropdown" style="display: flex; justify-content: space-around; align-items: center">
                    <a href="{{ route('profile') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-user1"></span><span class="mtext">Profile</span>
                    </a>
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <span class="micon dw dw-settings2"></span><span class="mtext">Settings</span>
                    </a>

                </li>
                <li class="dropdown" style="display: flex; justify-content: space-around; align-items: center">
                    <a href="" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-help"></span><span class="mtext">Help</span>
                    </a>

                    <a href="{{ route('logout') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-logout"></span><span class="mtext">Logout</span>
                    </a>
                </li> --}}


            </ul>
        </div>
    </div>
</div>