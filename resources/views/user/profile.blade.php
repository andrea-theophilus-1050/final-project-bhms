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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home', app()->getLocale()) }}">@lang('messages.title')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navProfile')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">
                            <img src="{{ asset('avatar/' . auth()->user()->avatar) }}" alt="" class="avatar-photo">
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
                        <div class="profile-social">
                            <h5 class="mb-20 h5 text-blue">Social Links</h5>
                            <ul class="clearfix">
                                <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i
                                            class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i
                                            class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i
                                            class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i
                                            class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i
                                            class="fa fa-dribbble"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i
                                            class="fa fa-dropbox"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i
                                            class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i
                                            class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i
                                            class="fa fa-skype"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i
                                            class="fa fa-vine"></i></a></li>
                            </ul>
                        </div>
                        <div class="profile-skills">
                            <h5 class="mb-20 h5 text-blue">Key Skills</h5>
                            <h6 class="mb-5 font-14">HTML</h6>
                            <div class="progress mb-20" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6 class="mb-5 font-14">Css</h6>
                            <div class="progress mb-20" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6 class="mb-5 font-14">jQuery</h6>
                            <div class="progress mb-20" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6 class="mb-5 font-14">Bootstrap</h6>
                            <div class="progress mb-20" style="height: 6px;">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#timeline"
                                            role="tab">@lang('messages.tabTimeline')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tasks"
                                            role="tab">@lang('messages.tabTask')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p show active" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="{{ route('update-profile', app()->getLocale()) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <ul class="profile-edit-list row">
                                                    {{-- Edit personal information start --}}
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">@lang('messages.titleSetting')</h4>
                                                        @if (session('successProfile'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Success! </strong>{{ session('successProfile') }}
                                                                <button type="button" class="close"
                                                                    data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @if (session('errorProfile'))
                                                            <div class="alert alert-success alert-dismissible fade show"
                                                                role="alert">
                                                                <strong>Error! </strong>{{ session('errorProfile') }}
                                                                <button type="button" class="close"
                                                                    data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
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
                                                            <label>@lang('messages.labelName')</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="name" name="name"
                                                                placeholder="@lang('messages.labelName')"
                                                                value="{{ $user->name }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelName')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelEmail')</label>
                                                            <input class="form-control form-control-lg" type="email"
                                                                id="email" name="email"
                                                                placeholder="@lang('messages.labelEmail')"
                                                                value="{{ $user->email }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelEmail')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelPhone')</label>
                                                            <input class="form-control form-control-lg" type="text"
                                                                id="phone" name="phone"
                                                                placeholder="@lang('messages.labelPhone')"
                                                                value="{{ $user->phone }}"
                                                                onfocus="this.placeholder = ''"
                                                                onblur="this.placeholder = '@lang('messages.labelPhone')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelDoB')</label>
                                                            <input class="form-control form-control-lg date-picker"
                                                                type="text" placeholder="@lang('messages.labelDoB')"
                                                                name="dob" onfocus="this.placeholder = ''"
                                                                value="{{ $user->dob }}"
                                                                onblur="this.placeholder = '@lang('messages.labelDoB')'" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>@lang('messages.labelGender')</label>
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
                                                        {{-- <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="selectpicker form-control form-control-lg"
                                                                data-style="btn-outline-secondary btn-lg"
                                                                title="Not Chosen">
                                                                <option>United States</option>
                                                                <option>India</option>
                                                                <option>United Kingdom</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>State/Province/Region</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Postal Code</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Visa Card Number</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Paypal ID</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customCheck1-1">
                                                                <label class="custom-control-label weight-400"
                                                                    for="customCheck1-1">I agree to receive notification
                                                                    emails</label>
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group mb-0">
                                                            <button type="submit" class="btn btn-primary" id="btnSubmit"
                                                                name="btnSubmit"
                                                                value="updateInformation">@lang('messages.btnSave')</button>
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
                                                                value="changePassword"
                                                                onclick="validate()">@lang('messages.tabChangePassword')</button>
                                                        </div>
                                                    </li>
                                                    {{-- Change password end --}}
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade" id="timeline" role="tabpanel">
                                        <div class="pd-20">
                                            <div class="profile-timeline">
                                                <div class="timeline-month">
                                                    <h5>August, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 Aug</div>
                                                            <div class="task-name"><i class="ion-android-alarm-clock"></i>
                                                                Task Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name"><i class="ion-ios-chatboxes"></i> Task
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name"><i class="ion-ios-clock"></i> Event
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 Aug</div>
                                                            <div class="task-name"><i class="ion-ios-clock"></i> Event
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>July, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 July</div>
                                                            <div class="task-name"><i class="ion-android-alarm-clock"></i>
                                                                Task Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 July</div>
                                                            <div class="task-name"><i class="ion-ios-chatboxes"></i> Task
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="timeline-month">
                                                    <h5>June, 2020</h5>
                                                </div>
                                                <div class="profile-timeline-list">
                                                    <ul>
                                                        <li>
                                                            <div class="date">12 June</div>
                                                            <div class="task-name"><i class="ion-android-alarm-clock"></i>
                                                                Task Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name"><i class="ion-ios-chatboxes"></i> Task
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                        <li>
                                                            <div class="date">10 June</div>
                                                            <div class="task-name"><i class="ion-ios-clock"></i> Event
                                                                Added</div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <div class="task-time">09:30 am</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->
                                    <!-- Tasks Tab start -->
                                    <div class="tab-pane fade" id="tasks" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <!-- Open Task start -->
                                                <div class="task-title row align-items-center">
                                                    <div class="col-md-8 col-sm-12">
                                                        <h5>Open Tasks (4 Left)</h5>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 text-right">
                                                        <a href="task-add" data-toggle="modal" data-target="#task-add"
                                                            class="bg-light-blue btn text-blue weight-500"><i
                                                                class="ion-plus-round"></i> Add</a>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list pb-30">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-1">
                                                                <label class="custom-control-label"
                                                                    for="task-1"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea
                                                            earum.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-2">
                                                                <label class="custom-control-label"
                                                                    for="task-2"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-3">
                                                                <label class="custom-control-label"
                                                                    for="task-3"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-4">
                                                                <label class="custom-control-label"
                                                                    for="task-4"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet. Id ea earum.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2019</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Open Task End -->
                                                <!-- Close Task start -->
                                                <div class="task-title row align-items-center">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h5>Closed Tasks</h5>
                                                    </div>
                                                </div>
                                                <div class="profile-task-list close-tasks">
                                                    <ul>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-1" checked="" disabled="">
                                                                <label class="custom-control-label"
                                                                    for="task-close-1"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id ea
                                                            earum.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-2" checked="" disabled="">
                                                                <label class="custom-control-label"
                                                                    for="task-close-2"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-3" checked="" disabled="">
                                                                <label class="custom-control-label"
                                                                    for="task-close-3"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="task-close-4" checked="" disabled="">
                                                                <label class="custom-control-label"
                                                                    for="task-close-4"></label>
                                                            </div>
                                                            <div class="task-type">Email</div>
                                                            Lorem ipsum dolor sit amet. Id ea earum.
                                                            <div class="task-assign">Assigned to Ferdinand M. <div
                                                                    class="due-date">due date <span>22 February 2018</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Close Task start -->
                                                <!-- add task popup start -->
                                                <div class="modal fade customscroll" id="task-add" tabindex="-1"
                                                    role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Tasks
                                                                    Add</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"
                                                                    data-toggle="tooltip" data-placement="bottom"
                                                                    title="" data-original-title="Close Modal">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pd-0">
                                                                <div class="task-list-form">
                                                                    <ul>
                                                                        <li>
                                                                            <form>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Type</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Message</label>
                                                                                    <div class="col-md-8">
                                                                                        <textarea class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Assigned
                                                                                        to</label>
                                                                                    <div class="col-md-8">
                                                                                        <select
                                                                                            class="selectpicker form-control"
                                                                                            data-style="btn-outline-primary"
                                                                                            title="Not Chosen"
                                                                                            multiple=""
                                                                                            data-selected-text-format="count"
                                                                                            data-count-selected-text="{0} people selected">
                                                                                            <option>Ferdinand M.</option>
                                                                                            <option>Don H. Rabon</option>
                                                                                            <option>Ann P. Harris</option>
                                                                                            <option>Katie D. Verdin</option>
                                                                                            <option>Christopher S. Fulghum
                                                                                            </option>
                                                                                            <option>Matthew C. Porter
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row mb-0">
                                                                                    <label class="col-md-4">Due
                                                                                        Date</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control date-picker">
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:;" class="remove-task"
                                                                                data-toggle="tooltip"
                                                                                data-placement="bottom" title=""
                                                                                data-original-title="Remove Task"><i
                                                                                    class="ion-minus-circled"></i></a>
                                                                            <form>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Type</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Task
                                                                                        Message</label>
                                                                                    <div class="col-md-8">
                                                                                        <textarea class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4">Assigned
                                                                                        to</label>
                                                                                    <div class="col-md-8">
                                                                                        <select
                                                                                            class="selectpicker form-control"
                                                                                            data-style="btn-outline-primary"
                                                                                            title="Not Chosen"
                                                                                            multiple=""
                                                                                            data-selected-text-format="count"
                                                                                            data-count-selected-text="{0} people selected">
                                                                                            <option>Ferdinand M.</option>
                                                                                            <option>Don H. Rabon</option>
                                                                                            <option>Ann P. Harris</option>
                                                                                            <option>Katie D. Verdin</option>
                                                                                            <option>Christopher S. Fulghum
                                                                                            </option>
                                                                                            <option>Matthew C. Porter
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row mb-0">
                                                                                    <label class="col-md-4">Due
                                                                                        Date</label>
                                                                                    <div class="col-md-8">
                                                                                        <input type="text"
                                                                                            class="form-control date-picker">
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="add-more-task">
                                                                    <a href="#" data-toggle="tooltip"
                                                                        data-placement="bottom" title=""
                                                                        data-original-title="Add Task"><i
                                                                            class="ion-plus-circled"></i> Add More Task</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-primary">Add</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- add task popup End -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tasks Tab End -->
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