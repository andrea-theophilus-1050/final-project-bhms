<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .table td,
        .table th {
            padding: 2px 5px;
            /* adjust the padding as needed */
        }

        .table .services {
            max-width: 120px;
            word-wrap: break-word;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @foreach ($data as $index => $bill)
        @if ($index % 3 == 0 && $index != 0)
            <div class="page-break"></div>
        @endif
        <div class="main-container" style="border-top: 1px solid; border-bottom: 1px solid; font-size: 12px">
            <div class="pd-ltr-20 xs-pd-20-10">
                <div class="min-height-200px">
                    <!-- basic table  Start -->
                    <div class="pd-20 card-box mb-30">
                        <div class="clearfix mb-10">
                            <div class="float-left" style="font-size: 9px">
                                <strong>{{ $bill->house_name }}</strong>
                                <p><strong>Address: </strong> {{ $bill->house_address }}
                                </p>
                            </div>
                            <div class="float-right">
                                <strong style="font-size: 14px">Room billing</strong>
                            </div>
                        </div>

                        <div class="clearfix mb-20">
                            <div class="float-left">
                                <span><strong>Name: </strong>{{ $bill->tenant_name }}</span><br>
                                <span><strong>Phone: </strong>{{ $bill->tenant_phone }}</span><br>
                                <span><strong>Email: </strong>{{ $bill->tenant_email }}</span>
                            </div>
                            <div class="float-right">
                                <span><strong>Room: </strong>{{ $bill->room_name }}</span><br>
                                <span><strong>Billing date: </strong>{{ $bill->billDate }}</span><br>
                            </div>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" class="text-center">Consumed</th>
                                    <th scope="col" class="text-center">Unit price</th>
                                    <th scope="col" class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="services">Room price</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">{{ number_format($bill->room_price, 0, ',', ',') }}</td>
                                </tr>
                                <tr>
                                    <td class="services">Electricity (Old: {{ $bill->old_electricity_index }} - New:
                                        {{ $bill->new_electricity_index }})</td>
                                    <td class="text-center">{{ $bill->electricityConsume }}</td>
                                    <td class="text-center">{{ $bill->electricityServicePrice }}</td>
                                    <td class="text-center">
                                        {{ number_format($bill->electricityTotalPrice, 0, ',', ',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="services">Water (Old: {{ $bill->old_water_index }} - New:
                                        {{ $bill->new_water_index }})</td>
                                    <td class="text-center">{{ $bill->waterConsume }}</td>
                                    <td class="text-center">{{ $bill->waterServicePrice }}</td>
                                    <td class="text-center">
                                        {{ number_format($bill->waterTotalPrice, 0, ',', ',') }}
                                    </td>
                                </tr>

                                @if ($bill->costsIncurred)
                                    @foreach ($bill->costsIncurred as $cost)
                                        <tr>
                                            <td class="services">{{ $cost->reason }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                {{ number_format($cost->price, 0, ',', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if ($bill->otherServicesUsed)
                                    @foreach ($bill->otherServicesUsed as $service)
                                        <tr>
                                            <td class="services">{{ $service->service_name }}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                {{ number_format($service->price_if_changed, 0, ',', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center font-weight-bold">Total</td>
                                    <td class="text-center font-weight-bold font-14">
                                        {{ number_format($bill->total, 0, ',', ',') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- basic table  End -->
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>


{{-- <div style="border: 1px solid; width: 100%; padding: 10px">
    <div style="font-size: 10px">
        <span>
            <strong>Can Ho Mini Hoan Hao 2</strong>
        </span>
        <span style="float: right">225/12/47 duong 30/4 Hung Loi, Ninh Kieu, Can Tho</span>
    </div>
    <div style="margin-top: -10px">
        <h5 style="text-align:center"><strong>Hoa don tien nha - Thang 3 nam 2023</strong></h5>
    </div>
    <div style="font-size: 12px; margin-top: -30px">
        <div>
            <span><strong>Name: </strong>Luu Hoai Phong</span>
            <span style="float: right"><strong>Phone: </strong>0123456789</span>
        </div>
        <div>
            <span><strong>Address: </strong>225/12/47 duong 30/4 Hung Loi, Ninh Kieu, Can Tho</span>
            <span style="float: right"><strong>Room: </strong>101</span>
        </div>
    </div>
    <div style="border-bottom: 2px solid black; border-top: 2px solid black">
        <table width="100%" style="border: 1px solid;">
            <thead>
                <tr>

                    <th></th>
                    <th>Consumed</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Electricity (Old: 12345 - New: 12345)</td>
                    <td style="text-align: center">100</td>
                    <td style="text-align: center">1000</td>
                    <td style="text-align: center">100000</td>
                </tr>
                <tr>
                    <td>Electricity</td>
                    <td style="text-align: center">100</td>
                    <td style="text-align: center">1000</td>
                    <td style="text-align: center">100000</td>
                </tr>
                <tr>
                    <td>Electricity</td>
                    <td style="text-align: center">100</td>
                    <td style="text-align: center">1000</td>
                    <td style="text-align: center">100000</td>
                </tr>
                <tr>
                    <td>Electricity</td>
                    <td style="text-align: center">100</td>
                    <td style="text-align: center">1000</td>
                    <td style="text-align: center">100000</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="border-bottom: 2px solid black">
        <h3><strong>TỔNG CỘNG</strong><strong style="float:right">@SumAmount</strong></h3>
    </div>
    <div>
        <span style="float:left" name="textKyTen">
            <strong>Người thanh toán</strong></span><span style="float:right" name="textKyTen"><strong>Người nhận
                TT</strong>
        </span>
    </div>
    <br>
</div> --}}
