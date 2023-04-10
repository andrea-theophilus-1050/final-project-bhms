@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navProfile')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.title')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navProfile')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            @if (session('msg'))
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4 style="color:red">{{ session('msg') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            @if ($user->avatar == null)
                                <img src="{{ asset('avatar/default-avatar.png') }}" alt="" class="avatar-photo">
                            @else
                                <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt=""
                                    class="avatar-photo">
                            @endif
                        </div>
                        <h5 class="text-center h5 mb-0">
                            @if ($user->name == null)
                                Not provided
                            @else
                                {{ $user->name }}
                            @endif
                        </h5>
                        <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">@lang('messages.contactInfo')</h5>
                            <ul>
                                <li>
                                    <span>@lang('messages.labelEmail')</span>
                                    @if ($user->email == null)
                                        Not provided
                                    @else
                                        {{ $user->email }}
                                    @endif
                                </li>
                                <li>
                                    <span>@lang('messages.labelPhone')</span>
                                    @if ($user->phone == null)
                                        Not provided
                                    @else
                                        {{ $user->phone }}
                                    @endif
                                </li>
                                <span style="color: blue; font-size: 14px; font-weight: 500">Your houses address</span>
                                @foreach (auth()->user()->houses as $house)
                                    <li>
                                        @if ($house->house_address == null)
                                            Not provided
                                        @else
                                            {{ '- ' . $house->house_name . ': ' . $house->house_address }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#setting"
                                            role="tab">@lang('messages.tabSetting')</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#timeline"
                                            role="tab">@lang('messages.tabTimeline')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tasks"
                                            role="tab">@lang('messages.tabTask')</a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content">
                                    <!--SECTION-START: Setting Tab start -->
                                    <div class="tab-pane fade height-100-p show active" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="{{ route('update-profile') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <ul class="profile-edit-list row">
                                                    {{-- Edit personal information start --}}
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">@lang('messages.titleSetting')</h4>
                                                        @if (session('successProfile'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Success! </strong>{{ session('successProfile') }}
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @if (session('errorProfile'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Error! </strong>{{ session('errorProfile') }}
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <label style="color:red; font-size: 14px"><i>(*)
                                                                Required</i></label>
                                                        <div class="form-group">
                                                            @if ($user->type_login == 'username')
                                                                <label>@lang('messages.labelUsername')</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    id="username" name="username"
                                                                    placeholder="@lang('messages.labelUsername')"
                                                                    value="{{ $user->username }}" readonly disabled>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) @lang('messages.labelName')</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="name" name="name"
                                                                placeholder="@lang('messages.labelName')"
                                                                value="{{ $user->name }}" onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelName')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) @lang('messages.labelEmail')</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email" name="email"
                                                                placeholder="@lang('messages.labelEmail')"
                                                                value="{{ $user->email }}" onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelEmail')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) @lang('messages.labelPhone')</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="phone" name="phone"
                                                                placeholder="@lang('messages.labelPhone')"
                                                                value="{{ $user->phone }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelPhone')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) @lang('messages.labelDoB')</label>
                                                            <input class="form-control form-control-lg date-picker"
                                                                type="text" placeholder="@lang('messages.labelDoB')"
                                                                name="dob" onfocus="this.placeholder = ''"
                                                                value="{{ $user->dob }}"
                                                                onblur="this.placeholder = '@lang('messages.labelDoB')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) @lang('messages.labelGender')</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4"
                                                                        name="gender" class="custom-control-input"
                                                                        @if ($user->gender == 'Male') checked @endif
                                                                        value="Male">
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio4">@lang('messages.genderMale')</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5"
                                                                        name="gender" class="custom-control-input"
                                                                        value="Female"
                                                                        @if ($user->gender == 'Female') checked @endif>
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio5">@lang('messages.genderFemale')</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>@lang('messages.labelFile')</label>
                                                            <input type="file" class="form-control form-control-lg"
                                                                id="avatar" name="avatar">
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <button type="submit" class="btn btn-primary" id="btnSubmit"
                                                                name="btnSubmit" value="updateInformation"><i
                                                                    class="icon-copy dw dw-diskette2"></i> &nbsp;
                                                                @lang('messages.btnSave')</button>
                                                        </div>
                                                    </li>
                                                    {{-- Edit personal information end --}}

                                                    {{-- Change password start --}}
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">@lang('messages.tabChangePassword')</h4>
                                                        {{-- display error message --}}
                                                        @if (session('error'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Error!</strong> {{ session('error') }}
                                                                <button type="button" class="close"
                                                                    data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        {{-- display success message --}}
                                                        @if (session('success'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Success!</strong> {{ session('success') }}
                                                                <button type="button" class="close"
                                                                    data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif

                                                        <div class="form-group">
                                                            <label>@lang('messages.labelCurrentPass')</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="currentPassword" name="currentPassword"
                                                                placeholder="@lang('messages.labelCurrentPass')"
                                                                value="{{ old('currentPassword') }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelCurrentPass')'">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelNewPass')</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="newPassword" name="newPassword"
                                                                placeholder="@lang('messages.labelNewPass')"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelNewPass')'"
                                                                onkeyup="trigger()">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="indicator">
                                                                <span class="weak"></span>
                                                                <span class="medium"></span>
                                                                <span class="strong"></span>
                                                            </div>
                                                            <div class="text" id="weak">@lang('messages.passwordWeak')</div>
                                                            <div class="text" id="medium">@lang('messages.passwordMedium')</div>
                                                            <div class="text" id="strong">@lang('messages.passwordStrong')</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelConfirmPass')</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="confirmNewPassword" name="confirmNewPassword"
                                                                placeholder="@lang('messages.labelConfirmPass')"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelConfirmPass')'"
                                                                onkeyup="comparePassword()">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="textComparePassword" id="notMatch">
                                                                @lang('messages.alertPasswordNotMatch')</div>
                                                            <div class="textComparePassword" id="match"
                                                                style="color: blue;">@lang('messages.alertPasswordMatched')</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="showPass" onclick="showPassword()">
                                                                <label class="custom-control-label"
                                                                    for="showPass">@lang('messages.labelShowPass')</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="btnSubmitChangePassword" name="btnSubmit"
                                                                value="changePassword" onclick="validate()"><i
                                                                    class="icon-copy dw dw-tick"></i> &nbsp;
                                                                @lang('messages.tabChangePassword')</button>
                                                        </div>
                                                    </li>
                                                    {{-- Change password end --}}
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!--SECTION-END: Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendors/scripts/changePasswordValidate.js') }}"></script>
@endsection
