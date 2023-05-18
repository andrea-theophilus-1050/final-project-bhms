@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Assign Tenant</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('house.index') }}">House management</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a
                                    href="{{ route('room.index', $room->house_id) }}">Room management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Assign Tenant</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="pd-20 card-box mb-30">
            <h5 class="h5 text-blue mb-20">Tenant information</h5>
            <form id="assignTenant" method="post" action="{{ route('room.assign-tenant-action', $room->room_id) }}">
                @csrf
                @if ($errors->any())
                    <div class="form-group row ml-1">
                        <div class="alert alert-danger alert-dismissible fade show col-md-7" role="alert">
                            <ul style="list-style-type:circle">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    {{-- alert --}}
                    <div class="form-group row ml-1">
                        <div class="alert alert-danger alert-dismissible fade show col-md-7" role="alert">
                            <strong>Error! </strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-6 text-left">
                        <button class="btn btn-secondary btn-sm mb-20" data-target="#tenant-list" data-toggle="modal">
                            <i class="icon-copy dw dw-list"></i> &nbsp; Get tenants
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" type="submit">
                            <i class="icon-copy dw dw-diskette2"></i> &nbsp; Submit
                        </button>
                        <a class="btn btn-danger" href="{{ route('room.index', $room->house_id) }}">
                            <i class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Cancel
                        </a>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rental room</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $room->room_name }}" type="text" name="room_rental"
                            readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Room price</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $room->price }}" type="text" name="room_price" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="tenant_id" name="tenant_id">

                    <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" type="text" placeholder="Full name" autofocus name="fullname" value="{{ old('fullname') }}"
                            id="tenant_name" required>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" placeholder="ID Card number" type="text" name="id_card"
                            value="{{ old('id_card') }}" id="tenant_id_card" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Date of birth</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Date of birth" type="text" name="dob"
                            value="{{ old('dob') }}" id="dob" required>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="d-flex">
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
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Phone number" type="text" name="phone"
                            value="{{ old('phone') }}" id="phone_number" required>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Email" type="text" name="email" id="email"
                            value="{{ old('email') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                    <div class="col-sm-12 col-md-4">
                        <textarea class="form-control" placeholder="Hometown address" type="text" name="hometown" id="hometown"
                             required>{{ old('hometown') }}</textarea>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Start date</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Start date" type="text"
                            value="{{ old('start_date') }}" name="start_date" required>
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
                            <input type="hidden" class="form-control" value="{{ $room->room_id }}" name="roomID">
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        @if ($service->service_name == 'Water' || $service->service_name == 'Electricity')
                                            <input type="checkbox" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}" disabled
                                                checked>
                                            <input type="hidden" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}">
                                        @else
                                            <input type="checkbox" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}">
                                        @endif
                                    </td>
                                    <td hidden>{{ $service->service_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $service->service_name }}</td>
                                    <td>
                                        <input type="hidden" class="form-control" value="{{ $service->service_id }}"
                                            name="serviceID[]">
                                        <input type="number" class="form-control" value="{{ $service->price }}"
                                            name="servicePrice[]" style="width: 250px" required>
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
@endsection
