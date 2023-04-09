@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Handle return room</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Handle return room</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('return.service-bill.insert') }}">
                @csrf
                {{-- <input type="hidden" name="date" value="{{ $date }}"> --}}
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4"> <i class="dw dw-calendar-11"></i>
                                Services bill - {{ now()->format('F Y') }}</h4>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="icon-copy dw dw-diskette2"></i>
                                &nbsp; Save</button>
                            <a href="{{ route('home') }}" class="btn btn-danger btn-sm"><i class="icon-copy fa fa-close"
                                    aria-hidden="true"></i> &nbsp; Cancel</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="house-table">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan=2># </th>
                                    <th scope="col" rowspan=2 style="width: 150px">Service name</th>
                                    <th scope="col" rowspan=2 style="width: 150px">Room name</th>
                                    <th scope="col" rowspan=2 style="width: 200px">Tenant name</th>
                                    <th scope="col" colspan=3 style="text-align: center">Index</th>
                                    <th scope="col" rowspan="2" style="width: 150px;text-align: center">
                                        Total amount
                                    </th>
                                </tr>
                                <tr style="text-align: center">
                                    <th scope="col">Old index</th>
                                    <th scope="col">New index</th>
                                    <th scope="col">Consume</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><b>Electricity</b></td>
                                    <td>{{ $electricity->room_name }}</td>
                                    <td>{{ $electricity->fullname }}</td>
                                    <td>
                                        <input type="hidden" name="rentalRoomID"
                                            value="{{ $electricity->rental_room_id }}">

                                        @if (collect($oldIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->where('new_electricity_index', '!=', 0)->isNotEmpty())
                                            <input class="form-control form-control-sm" type="number"
                                                name="oldIndex_electric" id="oldIndex" placeholder="0" min="0"
                                                value="{{ collect($oldIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->pluck('new_electricity_index')->first() }}">
                                        @else
                                            @if (collect($currentIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->isNotEmpty())
                                                <input class="form-control form-control-sm" type="number"
                                                    name="oldIndex_electric" id="oldIndex" placeholder="0" min="0"
                                                    value="{{ collect($currentIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->pluck('old_electricity_index')->first() }}">
                                            @else
                                                <input class="form-control form-control-sm" type="number"
                                                    name="oldIndex_electric" id="oldIndex" placeholder="0" min="0">
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if (collect($currentIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->isNotEmpty())
                                            <input class="form-control form-control-sm" type="number"
                                                name="newIndex_electric" id="newIndex" placeholder="0" min="0"
                                                value="{{ collect($currentIndexes_electricity)->where('rental_room_id', $electricity->rental_room_id)->pluck('new_electricity_index')->first() }}">
                                        @else
                                            <input class="form-control form-control-sm" type="number"
                                                name="newIndex_electric" id="newIndex" placeholder="0" min="0">
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <div id="usedIndex"
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px">0
                                        </div>
                                    </td>
                                    <td style="text-align: center; font-weight: bold">
                                        <input type="hidden" value="{{ $electricity->price_if_changed }}" id="priceUnit">
                                        <div id="totalAmount"
                                            style="background: rgb(200, 200, 200); border-radius: 5px; padding: 8px">
                                            0
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td><b>Water</b></td>
                                    <td>{{ $water->room_name }}</td>
                                    <td>{{ $water->fullname }}</td>
                                    <td>
                                        @if (collect($oldIndexes_water)->where('rental_room_id', $water->rental_room_id)->where('new_water_index', '!=', 0)->isNotEmpty())
                                            <input class="form-control form-control-sm" type="number" name="oldIndex_water"
                                                id="oldIndex" placeholder="0" min="0"
                                                value="{{ collect($oldIndexes_water)->where('rental_room_id', $water->rental_room_id)->pluck('new_water_index')->first() }}">
                                        @else
                                            @if (collect($currentIndexes_water)->where('rental_room_id', $water->rental_room_id)->isNotEmpty())
                                                <input class="form-control form-control-sm" type="number"
                                                    name="oldIndex_water" id="oldIndex" placeholder="0" min="0"
                                                    value="{{ collect($currentIndexes_water)->where('rental_room_id', $water->rental_room_id)->pluck('old_water_index')->first() }}">
                                            @else
                                                <input class="form-control form-control-sm" type="number"
                                                    name="oldIndex_water" id="oldIndex" placeholder="0" min="0">
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if (collect($currentIndexes_water)->where('rental_room_id', $water->rental_room_id)->isNotEmpty())
                                            <input class="form-control form-control-sm" type="number"
                                                name="newIndex_water" id="newIndex" placeholder="0" min="0"
                                                value="{{ collect($currentIndexes_water)->where('rental_room_id', $water->rental_room_id)->pluck('new_water_index')->first() }}">
                                        @else
                                            <input class="form-control form-control-sm" type="number"
                                                name="newIndex_water" id="newIndex" placeholder="0" min="0">
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <div id="usedIndex"
                                            style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px">0
                                        </div>
                                    </td>
                                    <td style="text-align: center; font-weight: bold">
                                        <input type="hidden" value="{{ $water->price_if_changed }}" id="priceUnit">
                                        <div id="totalAmount"
                                            style="background: rgb(200, 200, 200); border-radius: 5px; padding: 8px">
                                            0
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // NOTE: get all the rows in the table body
        var rows = document.querySelectorAll('#house-table tbody tr');

        // loop through each row and add an event listener to the new index electric input field
        rows.forEach(function(row) {
            var input2 = row.querySelector('input[id="newIndex"]');
            var input1 = row.querySelector('input[id="oldIndex"]');

            input1.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);
                var priceUnit = parseInt(row.querySelector('input[id="priceUnit"]').value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    let consume = value2 - value1;
                    let totalAmount = consume * priceUnit;

                    row.querySelector('div[id="usedIndex"]').innerHTML = consume;
                    row.querySelector('div[id="totalAmount"]').innerHTML = totalAmount;

                    input1.classList.remove('form-control-warning');
                    input2.classList.remove('form-control-warning');
                } else {
                    row.querySelector('div[id="usedIndex"]').innerHTML = "Errors";
                    input1.classList.add('form-control-warning');
                    input2.classList.add('form-control-warning');
                }
            });

            input2.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);
                var priceUnit = parseInt(row.querySelector('input[id="priceUnit"]').value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    let consume = value2 - value1;
                    let totalAmount = consume * priceUnit;
                    row.querySelector('div[id="usedIndex"]').innerHTML = consume;
                    row.querySelector('div[id="totalAmount"]').innerHTML = totalAmount;

                    input1.classList.remove('form-control-warning');
                    input2.classList.remove('form-control-warning');

                } else {
                    row.querySelector('div[id="usedIndex"]').innerHTML = "Errors";
                    input1.classList.add('form-control-warning');
                    input2.classList.add('form-control-warning');
                }
            });

            // perform the subtraction on page load if there are values in the input fields
            if (input1.value && input2.value) {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);
                var priceUnit = parseInt(row.querySelector('input[id="priceUnit"]').value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    let consume = value2 - value1;
                    let totalAmount = consume * priceUnit;

                    row.querySelector('div[id="usedIndex"]').innerHTML = consume;
                    row.querySelector('div[id="totalAmount"]').innerHTML = totalAmount;

                    input1.classList.remove('form-control-warning');
                    input2.classList.remove('form-control-warning');
                } else {
                    row.querySelector('div[id="usedIndex"]').innerHTML = "Errors";
                    input1.classList.add('form-control-warning');
                    input2.classList.add('form-control-warning');
                }
            }

        });
    </script>
@endsection
