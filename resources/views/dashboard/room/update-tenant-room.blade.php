@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>@lang('messages.navAssignTenant')</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('house.index') }}">@lang('messages.navHouse')</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('room.index', $rental->rooms->houses->house_id) }}">@lang('messages.navRoom')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('messages.navAssignTenant')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="pd-20 card-box mb-30">
            <div class="pull-right">
                <button class="btn btn-primary" type="submit" onclick="submitForm()"><i
                        class="icon-copy dw dw-diskette2"></i> &nbsp; Submit</button>
                <a class="btn btn-danger" href="{{ route('room.index', $rental->rooms->houses->house_id) }}"><i
                        class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Cancel</a>
            </div>
            <h5 class="h5 text-blue mb-20">Tenant information</h5>
            <button class="btn btn-secondary btn-sm mb-20" data-target="#tenant-list" data-toggle="modal"><i
                    class="icon-copy dw dw-list"></i> &nbsp; Get
                tenants</button>
            <form id="assignTenant" method="post"
                action="{{ route('room.update-tenant-action', [$rental->rooms->houses->house_id, $rental->rental_room_id]) }}">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rental room</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $rental->rooms->room_name }}" type="text"
                            name="room_rental" readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Room price</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $rental->rooms->price }}" type="text" name="room_price"
                            readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="text" id="tenant_id" name="tenant_id">
                    <input type="text" name="currentTenant" value="{{ $rental->tenants->tenant_id }}">

                    <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" type="text" placeholder="Full name" autofocus name="fullname"
                            value="{{ $rental->tenants->fullname }}" id="tenant_name">
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" placeholder="ID Card number" type="text" name="id_card"
                            value="{{ $rental->tenants->id_card }}" id="tenant_id_card">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Date of birth</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Date of birth" type="text" name="dob"
                            value="{{ $rental->tenants->dob }}" id="dob">
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="d-flex">
                            <div class="custom-control custom-radio mb-5 mr-20">
                                <input type="radio" id="gender1" name="gender" class="custom-control-input"
                                    value="Male" @if ($rental->tenants->gender == 'Male') checked @endif>
                                <label class="custom-control-label weight-400" for="gender1">Male</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="gender2" name="gender" class="custom-control-input"
                                    value="Female"@if ($rental->tenants->gender == 'Female') checked @endif>
                                <label class="custom-control-label weight-400" for="gender2">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Phone number" type="text" name="phone"
                            value="{{ $rental->tenants->phone_number }}" id="phone_number">
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Email" type="text" name="email" id="email"
                            value="{{ $rental->tenants->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" placeholder="Hometown address" type="text" name="hometown"
                            value="{{ $rental->tenants->hometown }}" id="hometown">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Start date</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Start date" type="text"
                            value="{{ $rental->start_date }}" name="start_date" required>
                    </div>
                </div>

                <div style="width: 100%; height: 1px; background: #0b132b" class="mb-20"></div>

                <h5 class="h5 text-blue mb-20">Services</h5>
                {{-- NOTE: Services section --}}
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th scope="col">No. </th>
                                <th scope="col">Service name</th>
                                <th scope="col">Price</th>

                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" class="form-control" value="{{ $rental->rooms->room_id }}"
                                name="roomID">
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        @if ($service->service_name == 'Water' || $service->service_name == 'Electricity')
                                            <input type="checkbox" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}" disabled
                                                checked>
                                            <input type="hidden" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}" checked>
                                        @else
                                            @if (collect($rental->servicesUsed)->where('service_id', $service->service_id)->isEmpty())
                                                <input type="checkbox" class="form-control" style="width: 25px;"
                                                    name="selectService[]" value="{{ $service->service_id }}">
                                            @else
                                                <input type="checkbox" class="form-control" style="width: 25px;"
                                                    name="selectService[]" value="{{ $service->service_id }}" checked>
                                            @endif
                                        @endif
                                    </td>
                                    <td hidden>{{ $service->service_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $service->service_name }}</td>
                                    <td>
                                        <input type="hidden" class="form-control" value="{{ $service->service_id }}"
                                            name="serviceID[]">
                                        <input type="number" class="form-control" value="{{ $service->price }}"
                                            name="servicePrice[]" style="width: 250px">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    @include('dashboard.room.get-tenant-component')

    <script>
        function submitForm() {
            document.getElementById('assignTenant').submit();
        }
    </script>
@endsection
