@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navService')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navService')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h6 class="text-blue h6">
                            @if (session('error'))
                                <div class="alert alert-danger d-flex align-items-center justify-content-center"
                                    role="alert">
                                    <strong>Error! </strong> &nbsp;&nbsp;{{ session('error') }}
                                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </h6>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:;" data-toggle="modal" data-target="#service-add"
                            class="btn btn-success btn-sm"><i class="ion-plus-round"></i> Add a new service</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th hidden scope="col">House ID</th>
                                <th scope="col">No. </th>
                                <th scope="col">Service name</th>
                                <th scope="col">Type Service</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr {{-- class="table-success" --}}>
                                    <td hidden>{{ $service->service_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->type->type_name }}</td>
                                    <td>{{ number_format($service->price, 0, ',', ',') }}</td>
                                    <td id="house-description"
                                        style=" max-width: 200px; 
                                            overflow: hidden; 
                                            text-overflow: ellipsis; 
                                            white-space: nowrap;"
                                        title="{{ $service->description }}">{{ $service->description }}</td>
                                    <td>
                                        <a id="edit-service" href="javascript:;" data-serviceID="{{ $service->service_id }}"
                                            data-serviceName="{{ $service->service_name }}"
                                            data-price="{{ $service->price }}"
                                            data-typeService="{{ $service->type->type_id }}"
                                            data-description="{{ $service->description }}" class="btn btn-primary"
                                            title="Edit service"><i class="fa fa-edit"></i></a>

                                        @if ($service->type->type_name != 'Electricity' && $service->type->type_name != 'Water')
                                            <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                                data-serviceID="{{ $service->service_id }}"
                                                data-serviceName="{{ $service->service_name }}" data-backdrop="static">
                                                <i class="fa fa-trash"></i></button>
                                        @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-START: add new service popup -->
    <div class="modal fade" id="service-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add a new service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formAddHouse" method="post" action="{{ route('services.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Service name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="service_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Type of Service</label>
                            <div class="col-md-8">
                                <select name="typeService" id="typeService" class="form-control">
                                    <option value="">-- Choose type of service --</option>
                                    @foreach ($type as $t)
                                        @if ($t->type_name != 'Electricity' && $t->type_name != 'Water')
                                            <option value="{{ $t->type_id }}">{{ $t->type_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Pirce</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" id="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i> &nbsp; Add new service</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-END: add service popup -->

    <!-- SECTION-START: update service popup -->
    <div class="modal fade" id="service-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update service</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formUpdateService" method="post" id="formUpdateService">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4">Service name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="service_name" id="service_name_edit"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Type of Service</label>
                            <div class="col-md-8">
                                <select name="typeService" id="typeService" class="form-control" disabled>
                                    <option value="">-- Choose type of service --</option>
                                    @foreach ($type as $t)
                                        <option value="{{ $t->type_id }}" id="{{ $t->type_id }}">
                                            {{ $t->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" id="price_edit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="description" id="description_edit"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i> &nbsp; Update</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-END: update service popup -->

    {{-- SECTION-START: confirm delete popup --}}
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="delete-form" method="post">
                        @csrf
                        @method('DELETE')
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
        document.addEventListener('DOMContentLoaded', function() {
            //NOTE: passing value to update house modal
            var editServiceBtn = document.querySelectorAll('#edit-service');
            editServiceBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var serviceID = e.getAttribute('data-serviceID');
                    var serviceName = e.getAttribute('data-serviceName');
                    var typeService = e.getAttribute('data-typeService');
                    var price = e.getAttribute('data-price');
                    var description = e.getAttribute('data-description');

                    var inputName = document.querySelector('#service_name_edit');
                    var inputPrice = document.querySelector('#price_edit');
                    var inputDescription = document.querySelector('#description_edit');
                    var formUpdate = document.querySelector('#formUpdateService');

                    inputName.value = serviceName;
                    document.getElementById(typeService).selected = true;
                    inputPrice.value = price;
                    inputDescription.value = description;
                    formUpdate.action = "{{ route('services.update', ':id') }}".replace(':id',
                        serviceID);

                    $('#service-edit').modal('show');
                });
            });

            //NOTE: passing value to delete house modal
            var deleteServiceBtn = document.querySelectorAll('#confirm-delete-modal-btn');
            deleteServiceBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var serviceID = e.getAttribute('data-serviceID');
                    var serviceName = e.getAttribute('data-serviceName');
                    var formDelete = document.querySelector('#delete-form');
                    var msg = document.querySelector('#msg-delete-confirm');

                    msg.innerHTML = "Are you sure to delete " + serviceName + "?";
                    formDelete.action = "{{ route('services.destroy', ':id') }}".replace(':id',
                        serviceID);

                    $('#confirm-delete-modal').modal('show');
                });
            });
        });

        const numberInput = document.querySelector("#service-add #price");
        const numberInputEdit = document.querySelector("#service-edit #price_edit");
        numberInput.addEventListener("input", formatNumber);
        numberInputEdit.addEventListener("input", formatNumber);

        function formatNumber() {

            if (this.value.length === 0) return;
            // Get the input value and remove any non-numeric characters except for the decimal point
            let input = this.value.replace(/[^0-9.]/g, "");

            // Parse the input as a float and format it with commas as thousands separators
            let formatted = parseFloat(input).toLocaleString();

            // Update the input value with the formatted value
            this.value = formatted;
        }
    </script>
@endsection
