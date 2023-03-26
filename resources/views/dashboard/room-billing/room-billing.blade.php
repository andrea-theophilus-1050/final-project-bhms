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
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('costs-incurred.add') }}" class="btn btn-success btn-sm"><i
                                class="ion-plus-round"></i> Add a new reason</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <th><a href="{{ route('export-bill') }}?invoices={{ urlencode(json_encode($data)) }}"
                            class="btn btn-primary">Export</a>

                        <a href="{{ route('export-pdf', now()->format('F Y')) }}" class="btn btn-primary">PDF</a>
                    </th>
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">House name</th>
                                <th scope="col">Room name </th>
                                <th scope="col">Tenant name</th>
                                <th scope="col">Total price</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $bill)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
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
                                        <button class="btn btn-primary btn-sm" id="view-details-btn"
                                            data-objBill="{{ json_encode($bill) }}">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

    <script src="{{ asset('vendors/scripts/handle-room-billing.js') }}"></script>
@endsection
