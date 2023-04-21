<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Registration</title>

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
                <a>
                    <img src="{{ asset('vendors/images/logo-boarding-house.png') }}" alt="">
                </a>
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
                            <h2 class="text-center text-primary">Sign up for Landlords</h2>
                        </div>

                        {{-- @if (session('errors'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> {{ session('errors') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif --}}

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul style="list-style-type:circle">
                                    @foreach ($errors->all() as $error)
                                        <li><strong>Error! </strong>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.action') }}">
                            @csrf
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" id="username"
                                    name="username" placeholder="Username" autofocus autocomplete="on" required
                                    value="{{ old('username') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>

                            <div class="input-group custom">
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Email address" autocomplete="on" required value="{{ old('email') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-email1"></i></span>
                                </div>
                            </div>

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="Password"
                                    id="password" name="password" required onkeyup="trigger()">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-eye" id="togglePassword"></i></span>
                                </div>
                            </div>

                            {{-- NOTE: check password strength --}}
                            <div class="indicator">
                                <span class="weak"></span>
                                <span class="medium"></span>
                                <span class="strong"></span>
                            </div>
                            <div class="text" id="weak">Your password is too weak</div>
                            <div class="text" id="medium">Your password is medium</div>
                            <div class="text" id="strong">Your password is strong</div>

                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="Confirm password" id="confirmPassword" name="confirmPassword"
                                    required onkeyup="comparePassword()">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-checked"
                                            id="checkedPassword"></i><i class="dw dw-eye"
                                            id="toggleConfirmPassword"></i></span>
                                </div>
                            </div>

                            <div class="textComparePassword">Password and Confirm password do not match</div>
                            {{-- NOTE: alert password not match --}}

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit"
                                            value="Register" onclick="validateInput()">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row" style="margin-top: 5%">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    Already have an account?
                                    <a href="{{ route('login') }}" style="margin-left: 3%; color: blue">Sign in</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                    Or
                                </div>

                                <div class="input-group mb-0">
                                    <a class="btn btn-outline-primary btn-lg btn-block d-flex justify-content-flex-start"
                                        href="{{ route('auth.googleRedirect') }}"><img
                                            src="{{ asset('vendors/images/google-logo.png') }}"
                                            style="height: 30px; width: 30px; margin-right: 10%; margin-left: 5%" />
                                        Sign in with Google</a>
                                </div>
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
    <script src="{{ asset('src/plugins/jquery-steps/jquery.steps.js') }}"></script>
    <script src="{{ asset('vendors/scripts/steps-setting.js') }}"></script>
    <script src="{{ asset('vendors/scripts/validate.js') }}"></script>
</body>

</html>
