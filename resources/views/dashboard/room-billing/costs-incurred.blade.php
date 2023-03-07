@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navCostsIncurred')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navCostsIncurred')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('costs-incurred.add') }}" class="btn btn-success btn-sm"><i
                                class="ion-plus-round"></i> Add a new reason</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">House name</th>
                                <th scope="col">Room name </th>
                                <th scope="col">Tenant name</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataList as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->house_name }}</td>
                                    <td>{{ $data->room_name }}</td>
                                    <td>{{ $data->fullname }}</td>
                                    <td>{{ $data->reason }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#service-edit"
                                            class="btn btn-primary btn-sm"><i class="dw dw-edit"></i></a>
                                        <a href="javascript:;" data-toggle="modal" data-target="#service-delete"
                                            class="btn btn-danger btn-sm"><i class="dw dw-delete"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



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

    {{-- <script>
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
    </script> --}}
@endsection
