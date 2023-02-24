@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Electricity Calculation</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Electricity Calculation</li>
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
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Room name</th>
                                <th scope="col" style="width: 200px">Old</th>
                                <th scope="col" style="width: 200px">New</th>
                                <th scope="col">Used</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $room->room_name }}</td>
                                    <td>
                                        <input type="number" class="form-control" name="oldIndex[]"
                                            id="oldIndex" placeholder="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="newIndex[]"
                                            id="newIndex" placeholder="0">
                                    </td>
                                    <td>
                                        <span name="usedIndex" id="usedIndex"></span>
                                        {{-- <input type="number" class="form-control" value="0" name="usedIndex"
                                            id="usedIndex"> --}}
                                            {{ $service->price  }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const oldIndex = document.getElementById('oldIndex');
        const newIndex = document.getElementById('newIndex');
        const usedIndex = document.getElementById('usedIndex');

        newIndex.addEventListener('keyup', () => {
            usedIndex.innerHTML = newIndex.value - oldIndex.value;
        });
    </script>
@endsection
