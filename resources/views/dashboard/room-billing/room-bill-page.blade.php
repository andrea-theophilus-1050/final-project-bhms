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
                        <button class="btn btn-success btn-sm" data-target="#room-billing-modal" data-toggle="modal"><i
                                class="ion-calculator"></i> Calculate</button>
                    </div>
                </div>
                <div class="table-responsive">
                    {{-- <th><a href="{{ route('export-bill') }}?invoices={{ urlencode(json_encode($data)) }}"
                            class="btn btn-primary">Export</a> --}}

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
                                {{-- <th scope="col">Paid amout</th>
                                <th scope="col">Debt</th> --}}
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roomBilling as $bill)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bill->rentalRoom->rooms->houses->house_name }}</td>
                                    <td>{{ $bill->rentalRoom->rooms->room_name }}</td>
                                    <td>{{ $bill->rentalRoom->tenants->fullname }}</td>
                                    <td class="font-weight-bold">
                                        <div
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px; width: fit-content">
                                            {{ number_format($bill->total_price, 0, ',', ',') }}
                                        </div>
                                    </td>
                                    {{-- <td class="font-weight-bold">
                                        <div
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px; width: fit-content">
                                            {{ number_format($bill->paid_amount, 0, ',', ',') }}
                                        </div>
                                    </td>
                                    <td class="font-weight-bold">
                                        <div
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px; width: fit-content">
                                            {{ number_format($bill->debt, 0, ',', ',') }}
                                        </div>
                                    </td> --}}
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="view-details-btn">
                                            <i class="fa fa-info-circle"></i>
                                        </button>
                                    </td>
                                    {{-- <td>{{ $bill->room_name }}</td>
                                    <td>{{ $bill->tenant_name }}</td>
                                    <td>{{ $bill->total_price }}</td>
                                    <td>
                                        <a href="{{ route('room-billing-detail', $bill->room_id) }}"
                                            class="btn btn-primary btn-sm">Details</a>
                                    </td> --}}
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
                                    value="{{ now()->format('F Y') }}" name="month">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">House</label>
                            <div class="col-md-8">
                                <select class="form-control font-13" name="house">
                                    <option value="0" selected>All houses</option>
                                    @foreach ($houseList as $house)
                                        <option value="{{ $house->house_id }}">{{ $house->house_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Calculate</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
