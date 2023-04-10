@extends('tenants-pages.layouts.tenant-layout')
@section('content')
    <style>
        .table td,
        .table th {
            padding: 5px;
        }
    </style>

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-6 d-flex justify-content-between">
                        <div class="col-12">
                            <p><b>Your name: </b>{{ $data->tenant_name }}</p>
                            <p><b>Phone number: </b>{{ $data->tenant_phone }}</p>
                            <p><b>Email: </b>{{ $data->tenant_email }}</p>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-between">
                        <div class="col-12">
                            <p><b>House name: </b>{{ $data->house_name }}</p>
                            <p><b>House address: </b>{{ $data->house_address }}</p>
                            <p><b>Your room: </b>{{ $data->room_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($data->roomBills as $bill)
                <div class="pd-20 card-box mb-30" @if ($bill->status != 0) style="background-color: #F7F7F7" @endif id="notify-{{ $bill->id }}">
                    <div class="clearfix">
                        <div class="table-responsive">
                            <div class="pull-right mb-10">
                                @if ($bill->status == 0 && auth('tenants')->user()->user->paymentVNPay != null)
                                    <form action="{{ route('payment-vnpay') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="billID" value="{{ $bill->id }}">
                                        <input type="hidden" name="totalPrice" value="{{ $bill->total_price }}">
                                        <input type="hidden" name="paymentDesc"
                                            value="{{ 'Room payment for the month of ' . $bill->date . ' - Room: ' . $data->room_name . ' - ' . $data->tenant_name }}">
                                        <button type="submit" name="redirect" class="btn btn-primary btn-sm">
                                            <i class="icon-copy dw dw-wallet1"></i> Payment via VNPay
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="background: #e6eaee"
                                            class="d-flex justify-center-start align-items-center">
                                            <div>
                                                @if ($bill->status == 0)
                                                    <span class="badge badge-danger">Unpaid</span>
                                                @elseif($bill->status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @elseif ($bill->status == 2)
                                                    <span class="badge badge-warning">Still owed</span>
                                                @endif
                                            </div>
                                            <div class="ml-2">
                                                Bill date: {{ $bill->date }}
                                            </div>
                                        </th>
                                        <th scope="col" class="text-center">Consumed</th>
                                        <th scope="col" class="text-center">Unit Price</th>
                                        <th scope="col" class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Room price</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">{{ number_format($data->room_price, 0, ',', ',') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Water consumed
                                            (Old index:
                                            {{ collect($data->waterBills)->where('date', $bill->date)->first()->old_water_index }}
                                            - New index:
                                            {{ collect($data->waterBills)->where('date', $bill->date)->first()->new_water_index }})
                                        </td>
                                        <td class="text-center">
                                            {{ collect($data->waterBills)->where('date', $bill->date)->first()->waterConsumed }}
                                        </td>
                                        <td class="text-center">{{ $data->waterServicePrice }}</td>
                                        <td class="text-center">
                                            {{ number_format(collect($data->waterBills)->where('date', $bill->date)->first()->waterTotalPrice,0,',',',') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Electricity consumed
                                            (Old index:
                                            {{ collect($data->electricityBills)->where('date', $bill->date)->first()->old_electricity_index }}
                                            - New index:
                                            {{ collect($data->electricityBills)->where('date', $bill->date)->first()->new_electricity_index }})
                                        </td>
                                        <td class="text-center">
                                            {{ collect($data->electricityBills)->where('date', $bill->date)->first()->electricityConsumed }}
                                        </td>
                                        <td class="text-center">{{ $data->electricityServicePrice }}</td>
                                        <td class="text-center">
                                            {{ number_format(collect($data->electricityBills)->where('date', $bill->date)->first()->electricityTotalPrice,0,',',',') }}
                                        </td>
                                    </tr>

                                    @if (collect($data->servicesUsed)->count() > 0)
                                        @foreach ($data->servicesUsed as $service)
                                            <tr>
                                                <td>{{ $service->service_name }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    {{ number_format($service->price, 0, ',', ',') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if (collect($data->costIncurred)->where('date', $bill->date)->count() > 0)
                                        @foreach (collect($data->costIncurred)->where('date', $bill->date) as $cost)
                                            <tr>
                                                <td><b>Cost incurred:</b> {{ $cost->reason }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center">{{ number_format($cost->price, 0, ',', ',') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-center font-weight-bold" style="font-size: 18px">
                                            Total
                                        </td>
                                        <td class="text-center font-weight-bold" style="font-size: 18px">
                                            {{ number_format($bill->total_price, 0, ',', ',') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
