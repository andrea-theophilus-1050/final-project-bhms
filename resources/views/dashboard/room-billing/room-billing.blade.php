@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Room billing</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room billing</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Room billing - {{ $month }}</h4>
                    </div>
                    <div class="pull-right d-flex justify-content-between">
                        <button class="btn btn-success btn-sm mr-2" data-target="#room-billing-modal" data-toggle="modal"><i
                                class="ion-calculator"></i> &nbsp; Calculate</button>
                        <a href="{{ route('export-bill') }}?invoices={{ urlencode(json_encode($data)) }}"
                            class="btn btn-primary btn-sm mr-2"><i class="icon-copy fi-page-export"></i> &nbsp; Export
                            Excel</a>

                        <a href="{{ route('export-pdf', [$month, $house]) }}" class="btn btn-primary btn-sm mr-2"><i
                                class="icon-copy fi-print"></i> &nbsp; Print bills</a>

                        <form method="POST" action="{{ route('mail.send-bill', [$month, $house]) }}" id="send-email-form">
                            @csrf
                            <button class="btn btn-primary btn-sm" type="submit"><i class="icon-copy fi-mail"></i> &nbsp;
                                Send email</button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        {{-- alert --}}
                        @if (session('success'))
                            <div class="col-md-6">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @elseif (session('error'))
                            <div class="col-md-6">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th scope="col">House name</th>
                                <th scope="col">Room name </th>
                                <th scope="col">Tenant name</th>
                                <th scope="col">Total price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Details</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $bill)
                                <tr>

                                    <td>{{ $bill->house_name }}</td>
                                    <td>{{ $bill->room_name }}</td>
                                    <td>{{ $bill->tenant_name }}</td>
                                    <td class="font-weight-bold">
                                        <div
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px; width: fit-content">
                                            {{ number_format($bill->total, 0, ',', ',') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if (collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->status == 0)
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif (collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->status == 2)
                                            <span class="badge badge-pill badge-info">
                                                Still owed
                                            </span>
                                        @else
                                            <span class="badge badge-pill badge-success">Paid</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="view-details-btn"
                                            data-objBill="{{ json_encode($bill) }}">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if (collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->status != 1)
                                            <button class="btn btn-success btn-sm" id="update-status-btn" type="button"
                                                data-billID="{{ collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->id }}"
                                                @if (collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->status == 0) data-totalPrice="{{ $bill->total }}"
                                                    @else
                                                    data-totalPrice="{{ $bill->total }}"
                                                    data-paidAmount="{{ collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->paidAmount }}"
                                                    data-debt="{{ collect($roomBilling)->where('rental_room_id', $bill->rental_room_id)->where('date', $bill->billDate)->first()->debt }}" @endif>
                                                <i class="icon-copy dw dw-tick"></i> &nbsp; Change status
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="room-billing-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Calculate room billing</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('calculate.room-billing') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Month / Year</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control month-picker" placeholder="Month picker"
                                    value="{{ $month }}" name="month">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">House</label>
                            <div class="col-md-8">
                                <select class="form-control font-13" name="house">
                                    <option value="all-house" selected>All houses</option>
                                    @foreach ($houseList as $house)
                                        <option value="{{ $house->house_id }}"
                                            {{ last(request()->segments()) == $house->house_id ? 'selected' : '' }}>
                                            {{ $house->house_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="ion-calculator"></i> &nbsp;
                                Calculate</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="modal-view-details" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="invoice-wrap">
                    <div class="invoice-box">
                        <div class="invoice-header">
                            <div class="logo text-center">
                                <img src="vendors/images/deskapp-logo.png" alt="">
                            </div>
                        </div>
                        <h5 class="text-center mb-5 weight-600">INVOICE</h5>
                        <div class="row pb-30">
                            <div class="col-md-6">
                                <p class="font-14 mb-5">Full name: <strong class="weight-600" id="tenantName">Lưu Hoài
                                        Phong</strong></p>
                                <p class="font-14 mb-5">Room name: <strong class="weight-600" id="roomName">Phòng
                                        14B</strong></p>
                                <p class="font-14 mb-5">Phone number: <strong class="weight-600"
                                        id="phoneNumber">0398371050</strong></p>
                                <p class="font-14 mb-5">Email: <strong class="weight-600"
                                        id="email">luuhoaiphong147@gmail.com</strong>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right">
                                    <p class="font-14 mb-5">Belongs to the house: <strong class="weight-600"
                                            id="houseName">Trọ Hoàn Hảo
                                            2</strong></p>
                                    <p class="font-14 mb-5">House address: <strong class="weight-600"
                                            id="houseAddress">225/12/47 Hẻm 391,
                                            đường 30/4, Hưng Lợi, Ninh Kiều, Cần Thơ</strong></p>
                                    <p class="font-14 mb-5">Bill month: <strong class="weight-600" id="billDate">March
                                            2023</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-desc pb-30">
                            <div class="invoice-desc-head clearfix">
                                <div class="invoice-sub">Services</div>
                                <div class="invoice-rate text-center">Consumed</div>
                                <div class="invoice-hours text-center">Unit Price</div>
                                <div class="invoice-subtotal text-center">Subtotal</div>
                            </div>
                            <div class="invoice-desc-body">
                                <ul>
                                    <li class="clearfix">
                                        <div class="invoice-sub">Room price</div>
                                        <div class="invoice-rate"></div>
                                        <div class="invoice-hours"></div>
                                        <div class="invoice-subtotal text-center"><span class="weight-600"
                                                id="room_pirce">1000000</span></div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="invoice-sub">
                                            Water bill <br>
                                            (Old: <i id="oldWaterIndex">1234</i>,
                                            New: <i id="newWaterIndex">2345</i>)
                                        </div>
                                        <div class="invoice-rate text-center">
                                            <span id="water_consumed">333</span>
                                        </div>
                                        <div class="invoice-hours text-center">
                                            <span id="water_unit_price">333</span>
                                        </div>
                                        <div class="invoice-subtotal text-center">
                                            <span class="weight-600" id="water_totalConsumed">100000</span>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="invoice-sub">
                                            Electricity bill <br>
                                            (Old: <i id="oldElectricityIndex">1234</i>,
                                            New: <i id="newElectricityIndex">2345</i>)
                                        </div>
                                        <div class="invoice-rate text-center">
                                            <span id="electricity_consumed">333</span>
                                        </div>
                                        <div class="invoice-hours text-center">
                                            <span id="electricity_unit_price">333</span>
                                        </div>
                                        <div class="invoice-subtotal text-center">
                                            <span class="weight-600" id="electricity_totalConsumed">100000</span>
                                        </div>
                                    </li>
                                    <div id="costsIncurredSection">

                                    </div>
                                    <div id="otherServices">

                                    </div>

                                    {{-- <div class="invoice-desc-head clearfix">
                                        <div class="invoice-sub"></div>
                                        <div class="invoice-rate"></div>
                                        <div class="invoice-subtotal text-center"></div>
                                    </div> --}}
                                    <div class="invoice-desc-body">
                                        <ul>
                                            <li class="clearfix">
                                                <div class="invoice-sub">
                                                    <p class="font-14 mb-5">Account No: <strong class="weight-600">123 456
                                                            789</strong></p>
                                                    <p class="font-14 mb-5">Code: <strong class="weight-600">4556</strong>
                                                    </p>
                                                </div>
                                                <div class="invoice-rate font-20 weight-600">10 Jan 2018</div>
                                                <div class="invoice-subtotal text-center">
                                                    <span class="weight-600 font-24 text-danger"
                                                        id="totalBill">$8000</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loading-modal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        Sending...
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- SECTION-START: confirm delete popup --}}
    <div class="modal fade" id="update-status" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Please double check the
                        information before confirming!
                    </h4>
                    <form id="update-status-form" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Total price</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control form-control-sm" id="totalPrice" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Paid amount</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control form-control-sm" id="paidAmount"
                                    name="paidAmount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-3 col-form-label">Debt</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control form-control-sm" id="debt" name="debt"
                                    readonly>
                            </div>
                        </div>
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                Cancel
                            </div>
                            <div class="col-6">
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                Update
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
            var updateStatusBtn = document.querySelectorAll('#update-status-btn');
            updateStatusBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-billID');
                    var totalPrice = parseFloat(e.getAttribute('data-totalPrice'));

                    var paidAmount = parseFloat(e.getAttribute('data-paidAmount'));
                    var debt = parseFloat(e.getAttribute('data-debt'));

                    var inputTotal = document.querySelector('#totalPrice');
                    var inputPaid = document.querySelector('#paidAmount');
                    var inputDebt = document.querySelector('#debt');

                    inputTotal.value = totalPrice.toLocaleString();

                    if (paidAmount) {
                        inputPaid.value = paidAmount.toLocaleString();
                        inputDebt.value = debt.toLocaleString();
                    } else {
                        inputPaid.value = totalPrice.toLocaleString();
                        inputDebt.value = 0;
                    }

                    var form = document.querySelector('#update-status-form');
                    form.action = "{{ route('update-status-bill', ':id') }}".replace(':id', id);

                    $('#update-status').modal('show');
                });
            });
        });

        var inputTotalPrice = document.querySelector('#totalPrice');
        var inputPaidAmount = document.querySelector('#paidAmount');
        var inputDebt = document.querySelector('#debt');

        inputPaidAmount.addEventListener("input", formatNumber);

        function formatNumber() {
            if (this.value.length === 0) return;
            // Get the input value and remove any non-numeric characters except for the decimal point
            let input = this.value.replace(/[^0-9.]/g, "");

            // Parse the input as a float and format it with commas as thousands separators
            let formatted = parseFloat(input).toLocaleString();

            // Update the input value with the formatted value
            this.value = formatted;
        }

        inputPaidAmount.addEventListener('input', function() {
            var totalPrice = parseFloat(inputTotalPrice.value.replace(/,/g, ''));
            var paidAmount = parseFloat(inputPaidAmount.value.replace(/,/g, ''));

            if (paidAmount > totalPrice) {
                inputPaidAmount.value = totalPrice.toLocaleString();
                inputDebt.value = 0;
            } else {
                inputDebt.value = (totalPrice - paidAmount).toLocaleString();
            }
        });
    </script>

    <script>
        const form = document.querySelector('#send-email-form');
        form.querySelector('button[type="submit"]').addEventListener('click', function(e) {
            e.preventDefault();
            $('#loading-modal').modal('show');
            form.submit();
        });
    </script>

    <script src="{{ asset('vendors/scripts/handle-room-billing.js') }}"></script>
@endsection
