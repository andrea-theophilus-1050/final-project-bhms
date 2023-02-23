@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navHouse')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navHouse')</li>
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
                        <a href="javascript:;" data-toggle="modal" data-target="#house-add"
                            class="btn btn-success btn-sm"><i class="ion-plus-round"></i> Add new house</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th hidden scope="col">House ID</th>
                                <th scope="col">No. </th>
                                <th scope="col">House name</th>
                                <th scope="col">House address</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($houses as $house)
                                <tr {{-- class="table-success" --}} data-href="{{ route('room.index', $house->house_id) }}">
                                    <td hidden>{{ $house->house_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $house->house_name }}</td>
                                    <td>{{ $house->house_address }}</td>
                                    <td id="house-description"
                                        style=" max-width: 200px; 
                                                overflow: hidden; 
                                                text-overflow: ellipsis; 
                                                white-space: nowrap;"
                                        title="{{ $house->house_description }}">{{ $house->house_description }}</td>
                                    <td>
                                        <a href="{{ route('room.index', $house->house_id) }}" class="btn btn-primary"
                                            role="button" title="Show details"><i class="fa fa-eye"></i></a>
                                        <button id="edit-house" data-houseID="{{ $house->house_id }}"
                                            data-houseName="{{ $house->house_name }}"
                                            data-houseAddress="{{ $house->house_address }}"
                                            data-houseDescription="{{ $house->house_description }}"
                                            class="btn btn-secondary" title="Edit house"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                            data-houseID="{{ $house->house_id }}"
                                            data-houseName="{{ $house->house_name }}" data-backdrop="static"
                                            title="Detele house">
                                            <i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- @foreach ($houses as $house)
                                @if ($loop->iteration % 2 == 0)
                                    <tr style="background: white">
                                        <td rowspan="2">asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td rowspan="2">asdasdfafdfadfdfadf</td>
                                    </tr>
                                    <tr>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                    </tr>
                                @else
                                    <tr style="background: #f2f2f2">
                                        <td rowspan="2">asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td rowspan="2">asdasdfafdfadfdfadf</td>
                                    </tr>
                                    <tr style="background: #f2f2f2">
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                        <td>asdfafdfadfd</td>
                                    </tr>
                                @endif
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-START: add house popup -->
    <div class="modal fade" id="house-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add a new house</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formAddHouse" method="post" action="{{ route('house.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">House name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="house_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">House address</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="house_address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="house_description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-END: add house popup -->

    <!-- SECTION-START: update house popup -->
    <div class="modal fade" id="house-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update house</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formUpdateHouse" method="post" id="formUpdateHouse">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4">House name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="house_name" id="house_name_edit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">House address</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="house_address" id="house_address_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="house_description" id="house_description_edit"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-START: update house popup -->

    {{-- SECTION-START: confirm delete popup start --}}
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="delete-form" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="button"
                                    class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                    data-dismiss="modal"><i class="fa fa-times"></i></button>
                                NO
                            </div>
                            <div class="col-6">
                                <button type="submit"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                YES
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- SECTION-END: confirm delete popup end --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // NOTE: passing value to update house modal
            var editHouseBtn = document.querySelectorAll('#edit-house');
            editHouseBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var houseID = e.getAttribute('data-houseID');
                    var houseName = e.getAttribute('data-houseName');
                    var houseAddress = e.getAttribute('data-houseAddress');
                    var houseDescription = e.getAttribute('data-houseDescription');

                    var inputName = document.querySelector('#house_name_edit');
                    var inputAddress = document.querySelector('#house_address_edit');
                    var inputDescription = document.querySelector('#house_description_edit');
                    var formUpdate = document.querySelector('#formUpdateHouse');

                    inputName.value = houseName;
                    inputAddress.value = houseAddress;
                    inputDescription.value = houseDescription;
                    formUpdate.action = "{{ route('house.update', ':id') }}".replace(':id',
                        houseID);

                    $('#house-edit').modal('show');
                });
            });

            // NOTE: passing value to delete house modal
            var deleteHouseBtn = document.querySelectorAll('#confirm-delete-modal-btn');
            deleteHouseBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var houseID = e.getAttribute('data-houseID');
                    var houseName = e.getAttribute('data-houseName');

                    var msg = document.querySelector('#msg-delete-confirm');
                    var formDelete = document.querySelector('#delete-form');

                    msg.innerHTML = "Are you sure to delete " + houseName + "?";

                    formDelete.action = "{{ route('house.destroy', ':id') }}".replace(':id',
                        houseID);

                    $('#confirm-delete-modal').modal('show');
                });
            });
        });

        var rows = document.querySelectorAll('#house-table tbody tr');
        rows.forEach(function(row) {
            // NOTE: Add a mouseover event listener to change the background color and cursor style
            row.addEventListener('mouseover', function() {
                row.style.backgroundColor = '#f2f2f2';
                row.style.cursor = 'pointer';
            });

            // NOTE: Add a mouseout event listener to reset the background color
            row.addEventListener('mouseout', function() {
                row.style.backgroundColor = '';
            });

            // NOTE: Add a click event listener to redirect to the URL in the data-href attribute
            var cells = row.querySelectorAll('td');
            var href = row.getAttribute('data-href');

            cells.forEach(function(cell) {
                if (!cell.querySelector('button')) {
                    cell.addEventListener('click', function() {
                        window.location.href = href;
                    });
                }
            });
        });
    </script>
@endsection
