<!doctype html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Verify email address</title>
    <meta name="description" content="Reset Password Email Template.">

    <style>
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid;
        }

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

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <img src="cid:logo.png" style="width: 200px">
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h4
                                            style="color:#1e1e2d; font-weight:bold; margin:0;font-family:'Rubik',sans-serif;">
                                            Room Billing - {{ $bill->billDate }}</h4>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>

                                        <table class="table" border="1">
                                            <thead>
                                                <tr style="background: #f2f3f8">
                                                    <td colspan=2 style="text-align: left">
                                                        <p>Fullname: {{ $bill->tenant_name }}</p>
                                                        <p>Phone: {{ $bill->tenant_phone }}</p>
                                                    </td>
                                                    <td colspan=2 style="text-align: left">
                                                        <p>Email: {{ $bill->tenant_email }}</p>
                                                        <p>Room: {{ $bill->room_name }}</p>
                                                    </td>
                                                </tr>
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
                                                    <td class="text-center">
                                                        {{ number_format($bill->room_price, 0, ',', ',') }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="services">Electricity <br>(Old:
                                                        {{ $bill->old_electricity_index }} - New:
                                                        {{ $bill->new_electricity_index }})</td>
                                                    <td class="text-center">{{ $bill->electricityConsume }}</td>
                                                    <td class="text-center">{{ $bill->electricityServicePrice }}</td>
                                                    <td class="text-center">
                                                        {{ number_format($bill->electricityTotalPrice, 0, ',', ',') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="services">Water <br>(Old: {{ $bill->old_water_index }} -
                                                        New:
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
                                                    <td colspan="3" class="text-center"><b>Total</b></td>
                                                    <td class="text-center font-14">
                                                        <b>{{ number_format($bill->total, 0, ',', ',') }}</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px; margin-bottom: 50px;">Please access to the system to view detail:
                                        <a style="color: blue"
                                            href="{{ url('/') . '/tenant/login' }}">{{ url('/') . '/tenant/login' }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <strong>boarding-house-management-system</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
