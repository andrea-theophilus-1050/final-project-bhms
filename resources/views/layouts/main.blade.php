<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@lang('messages.title')</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('vendors/images/System_Home_Icon_32.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <!-- custom scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/styles/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/passwordStrength.css') }}">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>


</head>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="">
            </div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>

    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
            <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="@lang('messages.placeholderSearch')">
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="ion-arrow-down-c"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
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
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/img.jpg" alt="">
                                        <h3>John Doe</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo1.jpg" alt="">
                                        <h3>Lea R. Frith</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo2.jpg" alt="">
                                        <h3>Erik L. Richards</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo3.jpg" alt="">
                                        <h3>John Doe</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/photo4.jpg" alt="">
                                        <h3>Renee I. Hansen</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="vendors/images/img.jpg" alt="">
                                        <h3>Vicki M. Coleman</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-info-dropdown" title="@lang('messages.titleHover')">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            @if (app()->getLocale() == 'chn')
                                <img src="{{ asset('vendors/images/Flag_China_square.png') }}" alt="">
                            @elseif(app()->getLocale() == 'en')
                                <img src="{{ asset('vendors/images/Flag_English_square.png') }}" alt="">
                            @elseif(app()->getLocale() == 'fra')
                                <img src="{{ asset('vendors/images/Flag_France_square.png') }}" alt="">
                            @elseif(app()->getLocale() == 'vie')
                                <img src="{{ asset('vendors/images/Flag_Vietnam_square.png') }}" alt="">
                            @endif
                        </span>
                        <span class="user-name">
                            @if (app()->getLocale() == 'chn')
                                @lang('messages.langChinese')
                            @elseif(app()->getLocale() == 'en')
                                @lang('messages.langEnglish')
                            @elseif(app()->getLocale() == 'fra')
                                @lang('messages.langFrench')
                            @elseif(app()->getLocale() == 'vie')
                                @lang('messages.langVietnamese')
                            @endif
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="{{ route(request()->route()->getName(),'chn') }}">
                            <img src="{{ asset('vendors/images/Flag_China.png') }}"> @lang('messages.langChinese')</a>
                        <a class="dropdown-item" href="{{ route(request()->route()->getName(),'en') }}">
                            <img src="{{ asset('vendors/images/Flag_English.png') }}"> @lang('messages.langEnglish')</a>
                        <a class="dropdown-item" href="{{ route(request()->route()->getName(),'fra') }}">
                            <img src="{{ asset('vendors/images/Flag_France.png') }}"> @lang('messages.langFrench')</a>
                        <a class="dropdown-item" href="{{ route(request()->route()->getName(),'vie') }}">
                            <img src="{{ asset('vendors/images/Flag_Vietnam.png') }}"> @lang('messages.langVietnamese')</a>
                    </div>
                </div>
            </div>

            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt="">
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
                        <a class="dropdown-item" href="{{ route('profile', app()->getLocale()) }}">
                            <i class="dw dw-user1"></i> @lang('messages.navProfile')</a>
                        <a class="dropdown-item" href="javascript:;" data-toggle="right-sidebar">
                            <i class="dw dw-settings2"></i> @lang('messages.navLayoutSetting')</a>
                        <a class="dropdown-item" href="faq.html">
                            <i class="dw dw-help"></i> Help</a>
                        <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}">
                            <i class="dw dw-logout"></i> @lang('messages.navLogout')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-1" checked="">
                        <label class="custom-control-label" for="sidebaricon-1"><i
                                class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-2">
                        <label class="custom-control-label" for="sidebaricon-2"><i
                                class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-3">
                        <label class="custom-control-label" for="sidebaricon-3"><i
                                class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-1" checked="">
                        <label class="custom-control-label" for="sidebariconlist-1"><i
                                class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-2">
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                                aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-3">
                        <label class="custom-control-label" for="sidebariconlist-3"><i
                                class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-4" checked="">
                        <label class="custom-control-label" for="sidebariconlist-4"><i
                                class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-5">
                        <label class="custom-control-label" for="sidebariconlist-5"><i
                                class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-6">
                        <label class="custom-control-label" for="sidebariconlist-6"><i
                                class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">Reset Settings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{ route('home', app()->getLocale()) }}">
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
                        <a href="{{ route('home', app()->getLocale()) }}" class="dropdown-toggle no-arrow">
                            <span class="micon fa fa-dashboard"></span><span class="mtext">@lang('messages.navHome')</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('room', app()->getLocale()) }}" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-home"></span><span class="mtext">@lang('messages.navRoom')</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-suitcase"></span><span class="mtext">@lang('messages.navService')</span>
                        </a>
                    </li>
                    <li>
                        <a href="calendar.html" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-save-water"></span><span class="mtext">Water bill</span>
                        </a>
                    </li>
                    <li class="dropdown">
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>

    <div class="main-container">

        @yield('content')

        <div class="footer-wrap pd-20 mb-20 card-box">
            Boarding House Management System - Developed by <a href="https://github.com/luuhoaiphong"
                target="_blank">Luu Hoai Phong</a>
        </div>
    </div>


    <!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/dashboard.js') }}"></script>
</body>

</html>
