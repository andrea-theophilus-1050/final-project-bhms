<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>@lang('messages.titleSignIn')</title>

    <!-- Site favicon -->
    <link rel=" shortcut icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/logo-login-register.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">

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

<body class="login-page">

    <div class="login-header box-shadow">
        {{-- dropdownlist for change language --}}

        <div class="container-fluid d-flex justify-content-between align-items-center">

            <div class="brand-logo">
                <a href="#">
                    <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="">
                </a>
            </div>

            {{-- <div class="login-menu">
                <ul>
                    <li><a href="{{ route('register') }}">Register</a></li>
                </ul>
            </div> --}}
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @if (app()->getLocale() == 'chn')
                        <img src="{{ asset('vendors/images/Flag_China.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langChinese')
                    @elseif (app()->getLocale() == 'en')
                        <img src="{{ asset('vendors/images/Flag_English.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langEnglish')
                    @elseif (app()->getLocale() == 'fra')
                        <img src="{{ asset('vendors/images/Flag_France.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langFrench')
                    @elseif (app()->getLocale() == 'vie')
                        <img src="{{ asset('vendors/images/Flag_Vietnam.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langVietnamese')
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route(request()->route()->getName(),'chn') }}"><img
                            src="{{ asset('vendors/images/Flag_China.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langChinese')</a>
                    <a class="dropdown-item" href="{{ route(request()->route()->getName(),'en') }}"><img
                            src="{{ asset('vendors/images/Flag_English.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langEnglish')</a>
                    <a class="dropdown-item" href="{{ route(request()->route()->getName(),'fra') }}"><img
                            src="{{ asset('vendors/images/Flag_France.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langFrench')</a>
                    <a class="dropdown-item" href="{{ route(request()->route()->getName(),'vie') }}"><img
                            src="{{ asset('vendors/images/Flag_Vietnam.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langVietnamese')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('vendors/images/login-img-background.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">@lang('messages.titleSignIn')</h2>
                        </div>

                        {{-- alert success message after registration --}}
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- alert error message after registration --}}
                        @if (session('errors'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Error! </strong>{{ session('errors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.action', app()->getLocale()) }}">
                            @csrf
                            {{-- <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
                                        <input type="radio" name="options" id="admin" checked>
                                        <div class="icon"><img src="{{ asset('vendors/images/briefcase.svg') }}"
                                                class="svg" alt=""></div>
                                        <span>I'm</span>
                                        Landlord
                                    </label>
                                    <label class="btn">
                                        <input type="radio" name="options" id="user">
                                        <div class="icon"><img src="{{ asset('vendors/images/person.svg') }}"
                                                class="svg" alt=""></div>
                                        <span>I'm</span>
                                        Ternant
                                    </label>
                                </div>
                            </div> --}}
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg"
                                    placeholder="@lang('messages.labelUsername')" name="username" id="username" autofocus
                                    autocomplete="on" required
                                    @if (Cookie::has('username')) value="{{ Cookie::get('username') }}"
                                    @else
                                    value="{{ old('username') }}" @endif>

                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="@lang('messages.labelPassword')" id="password" name="password" required
                                    minlength="6"
                                    oninvalid="this.setCustomValidity('Password must be at least 6 characters')"
                                    oninput="this.setCustomValidity('')"
                                    @if (Cookie::has('password')) value="{{ Cookie::get('password') }}"
                                    @else
                                    value="{{ old('password') }}" @endif>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-eye"
                                            id="togglePassword"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember_me"
                                            name="remember_me" @if (Cookie::has('username')) checked @endif>
                                        <label class="custom-control-label"
                                            for="remember_me">@lang('messages.labelRemember')</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="{{ url('forgot-password') }}">@lang('messages.labelForgot')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit"
                                            value="@lang('messages.btnLogin')" onclick="checkEmail()">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-top: 5%">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    @lang('messages.textDonHaveAccount')
                                    <a href="{{ route('register', app()->getLocale()) }}"
                                        style="margin-left: 3%; color: blue">@lang('messages.linkRegister')</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                    @lang('messages.textOr')
                                </div>
                                @if (app()->getLocale() != 'fra')
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.googleRedirect') }}"
                                            style="display: flex; justify-content: flex-start"><img
                                                src="{{ asset('vendors/images/google-logo.png') }}"
                                                style="height: 30px; width: 30px; margin-right: 10%; margin-left: 5%" />
                                            @lang('messages.textLoginWithGoogle')</a>
                                    </div>
                                    <div class="input-group mb-0" style="margin-top: 10px">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.facebookRedirect') }}"
                                            style="display: flex; justify-content: flex-start"><img
                                                src="{{ asset('vendors/images/facebook-logo.png') }}"
                                                style="height: 30px; width: 30px; margin-right: 10%; margin-left: 5%" />
                                            @lang('messages.textLoginWithFacebook')</a>
                                    </div>
                                @else
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.googleRedirect') }}"
                                            style="display: flex; justify-content: flex-start; font-size: 15px"><img
                                                src="{{ asset('vendors/images/google-logo.png') }}"
                                                style="height: 30px; width: 30px; margin-right: 5%; margin-left: 5%" />
                                            @lang('messages.textLoginWithGoogle')</a>
                                    </div>
                                    <div class="input-group mb-0" style="margin-top: 10px">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.facebookRedirect') }}"
                                            style="display: flex; justify-content: flex-start; font-size: 15px"><img
                                                src="{{ asset('vendors/images/facebook-logo.png') }}"
                                                style="height: 30px; width: 30px; margin-right: 5%; margin-left: 5%" />
                                            @lang('messages.textLoginWithFacebook')</a>
                                    </div>
                                @endif
                                {{-- <div class="input-group mb-0" style="margin-top: 10px">
                                    <a class="btn btn-outline-primary btn-lg btn-block"
                                        href="{{ route('auth.githubRedirect') }}"
                                        style="display: flex; justify-content: flex-start"><img
                                            src="{{ asset('vendors/images/github-logo.png') }}"
                                            style="height: 30px; width: 30px; margin-right: 15%; margin-left: 5%" />
                                        Sign in with
                                        GitHub</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('vendors/scripts/validate.js') }}"></script>
</body>

</html>
