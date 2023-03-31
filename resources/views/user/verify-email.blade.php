<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Verify email address</title>

    <!-- Site favicon -->
    <link rel=" shortcut icon" type="image/png" sizes="16x16" href="{{ asset('vendors/images/logo-login-register.png') }}">


    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
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

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a>
                    <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="">
                </a>
            </div>
            {{-- NOTE: dropdownlist for change language --}}
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    @if (app()->getLocale() == 'en')
                        <img src="{{ asset('vendors/images/Flag_English.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langEnglish')
                    @elseif (app()->getLocale() == 'vie')
                        <img src="{{ asset('vendors/images/Flag_Vietnam.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langVietnamese')
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('lang-english') }}"><img
                            src="{{ asset('vendors/images/Flag_English.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langEnglish')</a>
                    <a class="dropdown-item" href="{{ route('lang-vietnamese') }}"><img
                            src="{{ asset('vendors/images/Flag_Vietnam.png') }}" height="30px" width="40px"
                            alt=""> @lang('messages.langVietnamese')</a>
                </div>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('vendors/images/forgot-password.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Verify You Email Address</h2>
                        </div>
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},</p>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <button class="btn btn-primary btn-block" type="submit">Re-send</button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">OR</div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group mb-0">
                                        <a href="{{ route('logout') }}" class="btn btn-outline-primary btn-block"
                                            type="submit">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
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
</body>

</html>
