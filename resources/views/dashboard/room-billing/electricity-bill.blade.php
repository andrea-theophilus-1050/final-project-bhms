@extends('layouts.main')
@section('content')
    <form method="POST" action="{{ route('utility.insert') }}">
        @csrf
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Electricity bill</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Electricity bill</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Electricity bill</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Electricity bill</li>
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
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('home') }}" class="btn btn-danger btn-sm">Cancel</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="house-table">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan=2># </th>
                                    <th scope="col" rowspan=2 style="width: 150px">House name</th>
                                    <th scope="col" rowspan=2 style="width: 150px">Room name</th>
                                    <th scope="col" rowspan=2 style="width: 200px">Tenant name</th>
                                    <th scope="col" colspan=3 style="text-align: center">Electricity index</th>
                                    <th scope="col" rowspan="2" style="width: 150px;text-align: center">Total amount
                                    </th>
                                </tr>
                                <tr style="text-align: center">
                                    <th scope="col">Old index</th>
                                    <th scope="col">New index</th>
                                    <th scope="col">Consume</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataList as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->house_name }}</td>
                                        <td>{{ $data->room_name }}</td>
                                        <td>{{ $data->fullname }}</td>
                                        <td>
                                            <input type="hidden" name="rentalRoomID[]" value="{{ $data->room_id }}">
                                            <input class="form-control" type="number" name="oldIndex_electric[]"
                                                id="oldIndex_electric" placeholder="0" min="0">
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="newIndex_electric[]"
                                                id="newIndex_electric" placeholder="0" min="0">
                                        </td>
                                        <td style="text-align: center">
                                            <div id="usedIndex_electric"
                                                style="background: rgb(222, 222, 222); border-radius: 5px; padding: 8px">0
                                            </div>
                                        </td>
                                        <td style="text-align: center; font-weight: bold">
                                            <input type="hidden" value="{{ $data->price_if_changed }}" id="priceUnit">
                                            <div id="totalAmount"
                                                style="background: rgb(200, 200, 200); border-radius: 5px; padding: 8px">
                                                0
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // NOTE: get all the rows in the table body
        var rows = document.querySelectorAll('#house-table tbody tr');

        // loop through each row and add an event listener to the new index electric input field
        rows.forEach(function(row) {
            var input2 = row.querySelector('input[id="newIndex_electric"]');
            var input1 = row.querySelector('input[id="oldIndex_electric"]');


            input1.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);
                var priceUnit = parseInt(row.querySelector('input[id="priceUnit"]').value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    let consume = value2 - value1;
                    let totalAmount = consume * priceUnit;

                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = consume;
                    row.querySelector('div[id="totalAmount"]').innerHTML = totalAmount;
                } else {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = "Errors";
                }
            });

            input2.addEventListener('input', function() {
                var value2 = parseInt(input2.value);
                var value1 = parseInt(input1.value);
                var priceUnit = parseInt(row.querySelector('input[id="priceUnit"]').value);

                if (!isNaN(value2) && !isNaN(value1) && value2 >= value1) {
                    let consume = value2 - value1;
                    let totalAmount = consume * priceUnit;
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = consume;
                    row.querySelector('div[id="totalAmount"]').innerHTML = totalAmount;

                } else {
                    row.querySelector('div[id="usedIndex_electric"]').innerHTML = "Errors";
                }
            });
        });
    </script>
@endsection
