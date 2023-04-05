@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <img src="{{ asset('vendors/images/banner-img.png') }}" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Welcome back <div class="weight-600 font-30 text-blue">
                            @auth
                                {{ Auth::user()->name }}
                            @endauth </div>
                    </h4>
                </div>
                {{-- NOTE: button go to edit profile page --}}
                <div class="col-md-2">
                    <a href="{{ route('profile') }}" class="btn btn-outline-primary"><i class="dw dw-edit-2"></i> Edit
                        profile</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 mb-20">Total Revenue in {{ date('Y') }}</h2>
                    <div id="totalStatistic" hidden>
                        @foreach ($revenueByMonth as $index => $rev)
                            {{ $rev->total_price }}
                            @if ($index != count($revenueByMonth) - 1)
                                ,
                            @endif
                        @endforeach
                    </div>
                    <div id="month" hidden>
                        @foreach ($revenueByMonth as $index => $rev)
                            {{ $rev->month }}
                            @if ($index != count($revenueByMonth) - 1)
                                ,
                            @endif
                        @endforeach
                    </div>
                    <div id="chart5"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h2 class="h4 pd-20">List of unpaid tenants</h2>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Room</th>
                                <th>Date</th>
                                <th>Total price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unpaidBill as $bill)
                                <tr>
                                    <td>{{ $bill->rentalRoom->tenants->fullname }}</td>
                                    <td>{{ $bill->rentalRoom->rooms->room_name }}</td>
                                    <td>{{ $bill->date }}</td>
                                    <td>{{ number_format($bill->total_price, 0, ',', ',') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <div class="card-box height-100-p pd-20">
                    <h4 class="h4 mb-20">Room status</h4>
                    <div id="percentRoomStatus" hidden>{{ $percentOccupiedRooms }}</div>
                    <div id="chart6"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
