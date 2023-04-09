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
            <form id="assignTenant" method="post"
                action="{{ route('room.update-tenant-action', [$rental->rooms->houses->house_id, $rental->rental_room_id]) }}">
                @csrf
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
                            <input type="hidden" class="form-control" value="{{ $rental->rooms->room_id }}" name="roomID">
                            @foreach ($services as $service)
                                <tr>
                                    <td>
                                        @if ($service->service_name == 'Water' || $service->service_name == 'Electricity')
                                            <input type="checkbox" class="form-control" style="width: 25px;"
                                                name="selectService[]" value="{{ $service->service_id }}" disabled checked>
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
                                        <input type="text" class="form-control"
                                            value="{{ $rental->servicesUsed->where('service_id', $service->service_id)->first() != null ? $rental->servicesUsed->where('service_id', $service->service_id)->first()->price_if_changed : $service->price }}"
                                            name="servicePrice[]" style="width: 250px">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="width: 100%; height: 1px; background: #0b132b" class="mb-20"></div>

                <h5 class="h5 text-blue mb-30">Tenant information
                    <small id="passwordHelpBlock" class="form-text text-muted d-flex justify-content-between">
                        <div>
                            If you want to <i>"change the tenant information"</i>, <a
                                href="{{ route('tenant.edit', $rental->tenants->tenant_id) }}" class="text-blue"><u>please
                                    click here</u></a>
                        </div>
                        <b>OR</b>
                        <div>
                            If you want to <i>"replace with another tenant"</i>, <a id="btn-replace-tenant"
                                href="javascript:;" class="text-blue" data-id="{{ $rental->rental_room_id }}"
                                data-tenantName="{{ $rental->tenants->fullname }}"
                                data-roomName="{{ $rental->rooms->room_name }}"><u>please
                                    click here</u></a>
                        </div>
                    </small>
                </h5>



                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rental room</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $rental->rooms->room_name }}" type="text" readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Room price</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" value="{{ $rental->rooms->price }}" type="text" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" type="text" placeholder="Full name"
                            value="{{ $rental->tenants->fullname }}" id="tenant_name" readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" placeholder="ID Card number" type="text"
                            value="{{ $rental->tenants->id_card }}" id="tenant_id_card"readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Date of birth</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Date of birth" type="text"
                            value="{{ $rental->tenants->dob }}" id="dob"readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
                    <div class="col-sm-12 col-md-4">
                        <div class="d-flex">
                            @if ($rental->tenants->gender == 'Male')
                                <div class="custom-control custom-radio mb-5 mr-20">
                                    <input type="radio" id="gender1" class="custom-control-input" value="Male"
                                        checked>
                                    <label class="custom-control-label weight-400" for="gender1">Male</label>
                                </div>
                            @else
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="gender2" class="custom-control-input"
                                        value="Female"checked>
                                    <label class="custom-control-label weight-400" for="gender2">Female</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Phone number" type="text"
                            value="{{ $rental->tenants->phone_number }}" id="phone_number" readonly>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" placeholder="Email" type="text" id="email"
                            value="{{ $rental->tenants->email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control" placeholder="Hometown address" type="text"
                            value="{{ $rental->tenants->hometown }}" id="hometown" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Start date</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control date-picker" placeholder="Start date" type="text"
                            value="{{ $rental->start_date }}" readonly>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SECTION-START: confirm delete popup --}}
    <div class="modal fade" id="confirm-replace-tenant-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500">Are you sure you want a
                        replacement?<br>
                        <span class="weight-400 font-16" id="msg-delete-confirm">This action cannot be undone.</span>
                    </h4>
                    <form id="delete-form" method="post">
                        @csrf
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                NO
                            </div>
                            <div class="col-6">
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                YES
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- SECTION-END: confirm delete popup --}}

    <script>
        function submitForm() {
            document.getElementById('assignTenant').submit();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var changeTenantBtn = document.querySelectorAll('#btn-replace-tenant');
            changeTenantBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-id');
                    var tenantName = e.getAttribute('data-tenantName');
                    var roomName = e.getAttribute('data-roomName');


                    // var serviceName = e.getAttribute('data-serviceName');
                    // var formDelete = document.querySelector('#delete-form');
                    var msg = document.querySelector('#msg-delete-confirm');

                    msg.innerHTML = "<b>Room</b>: " + roomName + ' - <b>Tenant</b>: ' + tenantName;
                    // formDelete.action = "{{ route('services.destroy', ':id') }}".replace(':id',
                    //     serviceID);

                    $('#confirm-replace-tenant-modal').modal('show');
                });
            });
        })
    </script>
@endsection
