@extends('tenants-pages.layouts.tenant-layout')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                            <h5 class="mb-20 h5 text-blue">Contact information</h5>
                            <ul>
                                <li>
                                    <span>Email address</span>
                                    @if ($user->email == null)
                                        Not provided
                                    @else
                                        {{ $user->email }}
                                    @endif
                                </li>
                                <li>
                                    <span>Phone number</span>
                                    @if ($user->phone == null)
                                        Not provided
                                    @else
                                        {{ $user->phone }}
                                    @endif
                                </li>
                                <li>
                                    <span>Country:</span>
                                    America
                                </li>
                                <li>
                                    <span>Address:</span>
                                    1807 Holden Street<br>
                                    San Diego, CA 92115
                                </li>
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
                                        <a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Personal
                                            information</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!--SECTION-START: Setting Tab start -->
                                    <div class="tab-pane fade height-100-p show active" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="{{ route('role.tenants.profile.action') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <ul class="profile-edit-list row">
                                                    {{-- Edit personal information start --}}
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Edit your personal information
                                                        </h4>
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

                                                        <div class="form-group">
                                                            <label>(*) Fullname</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="name" name="name"
                                                                placeholder="Fullname"
                                                                value="{{ $user->fullname }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Fullname'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) Email address</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email" name="email"
                                                                placeholder="Email address" value="{{ $user->email }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Email address'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) Phone number</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="phone" name="phone"
                                                                placeholder="Phone number"
                                                                value="{{ $user->phone_number }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Phone number'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) Date of birth</label>
                                                            <input class="form-control form-control-lg date-picker"
                                                                type="text" placeholder="Date of birth"
                                                                name="dob" onfocus="this.placeholder = ''"
                                                                value="{{ $user->dob }}"
                                                                onblur="this.placeholder = 'Date of birth'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>(*) Gender</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4"
                                                                        name="gender" class="custom-control-input"
                                                                        @if ($user->gender == 'Male') checked @endif
                                                                        value="Male">
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio4">Male</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5"
                                                                        name="gender" class="custom-control-input"
                                                                        value="Female"
                                                                        @if ($user->gender == 'Female') checked @endif>
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio5">Female</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Avatar</label>
                                                            <input type="file" class="form-control form-control-lg"
                                                                id="avatar" name="avatar">
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <button type="submit" class="btn btn-primary" id="btnSubmit"
                                                                name="btnSubmit" value="updateInformation"><i
                                                                    class="icon-copy dw dw-diskette2"></i> &nbsp;
                                                                Update information</button>
                                                        </div>
                                                    </li>
                                                    {{-- Edit personal information end --}}

                                                    {{-- Change password start --}}
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Change password
                                                        </h4>
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
                                                            <label>Current password</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="currentPassword" name="currentPassword"
                                                                placeholder="Current password"
                                                                value="{{ old('currentPassword') }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Current password'">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New password</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="newPassword" name="newPassword"
                                                                placeholder="New password"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'New password'"
                                                                onkeyup="trigger()">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="indicator">
                                                                <span class="weak"></span>
                                                                <span class="medium"></span>
                                                                <span class="strong"></span>
                                                            </div>
                                                            <div class="text" id="weak">Your password is too weak</div>
                                                            <div class="text" id="medium">Your password is medium</div>
                                                            <div class="text" id="strong">Your password is strong</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirm new password</label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="confirmNewPassword" name="confirmNewPassword"
                                                                placeholder="Confirm new password"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = 'Confirm new password'"
                                                                onkeyup="comparePassword()">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="textComparePassword" id="notMatch">
                                                                Password and Confirm password do not match</div>
                                                            <div class="textComparePassword" id="match"
                                                                style="color: blue;">Password and Confirm password matched</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="showPass" onclick="showPassword()">
                                                                <label class="custom-control-label"
                                                                    for="showPass">Show password</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-0">
                                                            <button type="submit" class="btn btn-primary"
                                                                id="btnSubmitChangePassword" name="btnSubmit"
                                                                value="changePassword" onclick="validate()"><i
                                                                    class="icon-copy dw dw-tick"></i> &nbsp;
                                                                Change password</button>
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
