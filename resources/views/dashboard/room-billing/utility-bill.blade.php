@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navUtility')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navUtility')</li>
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
                    {{-- <div class="pull-right">
                        <a href="javascript:;" data-toggle="modal" data-target="#service-add"
                            class="btn btn-success btn-sm"><i class="ion-plus-round"></i> Add a new service</a>
                    </div> --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col" rowspan=2># </th>
                                <th scope="col" rowspan=2 style="width: 150px">Room name</th>
                                <th scope="col" rowspan=2 style="width: 200px">Tenant name</th>
                                <th scope="col" colspan=3 style="text-align: center">Electricity index</th>
                                <th scope="col" colspan=3 style="text-align: center">Water index</th>
                            </tr>
                            <tr>
                                <th scope="col">Old index</th>
                                <th scope="col">New index</th>
                                <th scope="col">Consume</th>
                                <th scope="col">Old index</th>
                                <th scope="col">New index</th>
                                <th scope="col">Consume</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form method="POST" action="{{ route('utility.insert') }}">
                                @csrf
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $room->room_name }}</td>
                                        <td>{{ $room->rentals->tenants->fullname }}</td>
                                        <td>

                                            <input type="hidden" name="rentalRoomID[]"
                                                value="{{ $room->rentals->rental_room_id }}">

                                            <input class="form-control" type="number" name="oldIndex_electric[]"
                                                id="oldIndex_electric" placeholder="0" min="0">
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="newIndex_electric[]"
                                                id="newIndex_electric" placeholder="0" min="0">
                                        </td>
                                        <td style="text-align: center">
                                            <div id="usedIndex_electric"
                                                style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px">0</div>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="oldIndex_water[]"
                                                id="oldIndex_water" placeholder="0" min="0">
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="newIndex_water[]"
                                                id="newIndex_water" placeholder="0" min="0">
                                        </td>
                                        <td style="text-align: center">
                                            <div id="usedIndex_water"
                                                style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px">0</div>
                                        </td>
                                    </tr>
                                @endforeach

                                <button type="submit">submit</button>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // NOTE: get all the rows in the table body
        var rows = document.querySelectorAll('#house-table tbody tr');

        // loop through each row and add an event listener to the new index electric input field
        rows.forEach(function(row) {
            var input2 = row.querySelector('input[id="newIndex_electric"]');
            var input1 = row.querySelector('input[id="oldIndex_electric"]');
            var input4 = row.querySelector('input[id="newIndex_water"]');
            var input3 = row.querySelector('input[id="oldIndex_water"]');

            input1.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = (value2 - value1);
                } else {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = "Errors";
                }
            });

            input2.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = (value2 - value1);
                } else {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = "Errors";
                }
            });

            input3.addEventListener('input', function() {
                var value4 = parseInt(input4.value);
                var value3 = parseInt(input3.value);

                if (!isNaN(value4) && !isNaN(value3) && value4 >= value3) {
                    row.querySelector('div[id="usedIndex_water"]').innerHTML = (value4 - value3);
                } else {
                    row.querySelector('div[id="usedIndex_water"]').innerHTML = "Errors";
                }
            });

            input4.addEventListener('input', function() {
                var value4 = parseInt(input4.value);
                var value3 = parseInt(input3.value);

                if (!isNaN(value4) && !isNaN(value3) && value4 >= value3) {
                    row.querySelector('div[id="usedIndex_water"]').innerHTML = (value4 - value3);
                } else {
                    row.querySelector('div[id="usedIndex_water"]').innerHTML = "Errors";
                }
            });
        });
    </script>
@endsection
