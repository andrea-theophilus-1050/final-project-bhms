<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>@lang('messages.titleTab')</title>

    <!-- Site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('vendors/images/logo-login-register.png') }}">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
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

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="#">
                    <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="">
                </a>
            </div>
            {{-- <div class="login-menu">
                <ul>
                    <li><a href="{{ route('login') }}">Login</a></li>
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
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('vendors/images/register-img-background.png') }}" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">@lang('messages.titleRegister')</h2>
                        </div>

                        @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> {{ session('errors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.action', app()->getLocale()) }}">
                            @csrf
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" id="username"
                                    name="username" placeholder="@lang('messages.labelUsername')" autofocus autocomplete="on"
                                    required value="{{ old('username') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="@lang('messages.labelPassword')" id="password" name="password" required
                                    onkeyup="trigger()">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-eye"
                                            id="togglePassword"></i></span>
                                </div>
                            </div>

                            <div class="indicator">
                                <span class="weak"></span>
                                <span class="medium"></span>
                                <span class="strong"></span>
                            </div>
                            <div class="text" id="weak">@lang('messages.passwordWeak')</div>
                            <div class="text" id="medium">@lang('messages.passwordMedium')</div>
                            <div class="text" id="strong">@lang('messages.passwordStrong')</div>

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="@lang('messages.labelConfirmPassword')" id="confirmPassword" name="confirmPassword"
                                    required onkeyup="comparePassword()">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-checked"
                                            id="checkedPassword"></i><i class="dw dw-eye"
                                            id="toggleConfirmPassword"></i></span>
                                </div>
                            </div>
                            <div class="textComparePassword">@lang('messages.alertPasswordNotMatch')</div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit"
                                            value="@lang('messages.btnRegister')" onclick="validateInput()">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-top: 5%">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    @lang('messages.textAlreadyHaveAccount')
                                    <a href="{{ route('login', app()->getLocale()) }}"
                                        style="margin-left: 3%; color: blue">@lang('messages.titleSignIn')</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html Start -->
    <button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal"
        data-backdrop="static">Launch modal</button>

    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h3 class="mb-20">Form Submitted!</h3>
                    <div class="mb-30 text-center"><img src="{{ asset('vendors/images/success.png') }}"></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="{{ url('login') }}" class="btn btn-primary">Done</a>
                </div>
            </div>
        </div>
    </div>
    <!-- success Popup html End -->
    <!-- js -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>
    <script src="{{ asset('vendors/scripts/validate.js') }}"></script>
</body>

</html>
