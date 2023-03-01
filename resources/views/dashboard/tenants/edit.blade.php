@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Update tenant information</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('tenant.index') }}">Tenants management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update tenant information</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <form method="post" action="{{ route('tenant.update', $tenant->tenant_id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="Full name" name="fullname"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full name'"
                                value="{{ $tenant->fullname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date of birth</label>
                        <div class="col-sm-12 col-md-5">
                            <input class="form-control date-picker" placeholder="Date of birth" type="text"
                                name="dob" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of birth'"
                                value="{{ $tenant->dob }}">
                        </div>

                        <label class="col-sm-12 col-md-1 col-form-label">Gender</label>
                        <div class="col-sm-12 col-md-3">
                            <div class="d-flex">
                                @if ($tenant->gender == 'Male')
                                    <div class="custom-control custom-radio mb-5 mr-20">
                                        <input type="radio" id="gender1" name="gender" class="custom-control-input"
                                            value="Male" checked>
                                        <label class="custom-control-label weight-400" for="gender1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="gender2" name="gender" class="custom-control-input"
                                            value="Female">
                                        <label class="custom-control-label weight-400" for="gender2">Female</label>
                                    </div>
                                @else
                                    <div class="custom-control custom-radio mb-5 mr-20">
                                        <input type="radio" id="gender1" name="gender" class="custom-control-input"
                                            value="Male">
                                        <label class="custom-control-label weight-400" for="gender1">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-5">
                                        <input type="radio" id="gender2" name="gender" class="custom-control-input"
                                            value="Female" checked>
                                        <label class="custom-control-label weight-400" for="gender2">Female</label>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="ID Card number" type="text" name="id_card"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'ID Card number'"
                                value="{{ $tenant->id_card }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Phone number" type="text" name="phone"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'"
                                value="{{ $tenant->phone_number }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Email address" type="text" name="email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'"
                                value={{ $tenant->email }}>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Hometown" type="text" name="hometown"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hometowm'"
                                value="{{ $tenant->hometown }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">ID Card photo</label>
                        <div class="col-sm-12 col-md-10">
                            <img src="{{ asset('uploads/tenants/id_card_front/' . $tenant->citizen_card_front_image) }}"
                                alt="" width="40%" title="{{ $tenant->citizen_card_front_image }}">
                            <img src="{{ asset('uploads/tenants/id_card_back/' . $tenant->citizen_card_back_image) }}"
                                alt="" width="40%" style="margin-left: 15px"
                                title="{{ $tenant->citizen_card_back_image }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Change ID Card front photo</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="file" name="id_card_front" id="id_card_front"
                                onchange="previewImage(id_card_front, preview_id_card_front)" accept="image/*">
                            <img src="" id="preview_id_card_front" alt="" width="40%"
                                style="margin-top: 10px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Change ID Card front photo</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="file" name="id_card_back" id="id_card_back"
                                onchange="previewImage(id_card_back, preview_id_card_back)" accept="image/*">
                            <img src="" id="preview_id_card_back" alt="" width="40%"
                                style="margin-top: 10px">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date and
                            time</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control datetimepicker" placeholder="Choose Date anf time" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control date-picker" placeholder="Select Date" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Month</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control month-picker" placeholder="Select Month" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Time</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control time-picker" placeholder="Select time" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Select</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Color</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="#563d7c" type="color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Input Range</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="50" type="range">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2"></div>
                        <div class="col-sm-12 col-md-10">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('tenant.index') }}" class="btn btn-danger"> Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
