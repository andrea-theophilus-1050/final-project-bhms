@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navRoom')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navRoom')</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="dropdown">
                            <form action="" style="display: flex; justify-content: space-between">
                                <input type="text" name="search" placeholder="Room number" class="form-control"
                                    style="margin-right: 5%; font-size: 13px">
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                    <option value="">Room status</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                    <option value="">Room billed</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="dropdown">
                            <form action="" style="display: flex; justify-content: space-between">
                                <input type="text" name="search" placeholder="Room number" class="form-control"
                                    style="margin-right: 5%; font-size: 13px">
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">

                                    {{-- @foreach ($house as $item)
                                        <option value="{{ $item->house_id }}">{{ $item->house_name }}</option>
                                    @endforeach --}}
                                    {{-- <option value="">Room status</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option> --}}
                                </select>
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                    <option value="">Room billed</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </form>
                        </div>
                        {{-- <div class="dropdown">
                            <label style="font-size: 15px; font-weight: bold">Area: </label>
                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">

                        <div class="clearfix mb-10">
                            <div class="pull-right">
                                <a href="javascript:;" data-toggle="modal" data-target="#room-add"
                                    class="btn btn-success btn-sm" style="width: fix-content"><i
                                        class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                    Add a new room</a>
                                <a href="javascript:;" data-toggle="modal" data-target="#room-add-multiple"
                                    class="btn btn-info btn-sm"><i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                    Add
                                    multiple new rooms</a>
                            </div>
                        </div>


                        <div class="tab">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row clearfix">
                                            @if (count($rooms) == 0)
                                                <div>No data found</div>
                                            @else
                                                @foreach ($rooms as $room)
                                                    <div class="col-sm-12 col-md-3 mb-30">
                                                        <div class="card card-box">
                                                            <div class="card-header"
                                                                @if ($room->status == 0) style="background-color: #B3DBF8"
                                                                @else style="background-color: #1899F5" @endif>
                                                                <i class="icon-copy dw dw-house"></i>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $room->room_name }}
                                                            </div>
                                                            <div class="card-body">
                                                                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                                                <p class="card-text">
                                                                    <i class="icon-copy dw dw-user-3"></i>
                                                                    @if ($room->status == 0)
                                                                        <span style="color: red">Not yet rented</span>
                                                                    @else
                                                                        <span
                                                                            style="color: green">{{ $room->rentals->tenants->fullname }}</span>
                                                                    @endif
                                                                </p>
                                                                <p class="card-text">
                                                                    <i class="icon-copy dw dw-money-1"></i>
                                                                    {{ $room->price }}
                                                                </p>

                                                                <div class="pull-left">
                                                                    <a href="javascript:;" data-toggle="modal"
                                                                        data-target="#tenant-list" type="button"
                                                                        class="btn btn-secondary btn-sm"><i
                                                                            class="icon-copy dw dw-add"></i></a>
                                                                </div>
                                                                <div class="pull-right">
                                                                    {{-- <a href="#" class="btn btn-primary btn-sm">
                                                                    <i class="icon-copy dw dw-edit"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm">
                                                                    <i class="icon-copy dw dw-trash"></i>
                                                                </a> --}}

                                                                    <form id="delete-room"
                                                                        action="{{ route('room.delete', $room->room_id) }}"
                                                                        method="Post">
                                                                        <a href="#" class="btn btn-primary btn-sm"
                                                                            role="button" title="Show details"><i
                                                                                class="fa fa-eye"></i></a>
                                                                        <a href="javascript:;" data-toggle="modal"
                                                                            id="edit-room-modal-btn"
                                                                            data-id="{{ $room->room_id }}"
                                                                            data-roomName="{{ $room->room_name }}"
                                                                            data-price="{{ $room->price }}"
                                                                            data-description="{{ $room->room_description }}"
                                                                            class="btn btn-secondary btn-sm"
                                                                            title="Edit Room"><i
                                                                                class="fa fa-edit"></i></a>
                                                                        @csrf
                                                                        {{-- <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure to delete?')"><i
                                                                            class="fa fa-trash"></i></button> --}}

                                                                        <button class="btn btn-danger btn-sm"
                                                                            type="button" id="confirm-delete-modal-btn"
                                                                            data-id="{{ $room->room_id }}"
                                                                            data-roomName="{{ $room->room_name }}"
                                                                            data-houseID="{{ $id }}"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div style="display: flex;justify-content: center;align-items: center;">
                                            {{ $rooms->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add task popup start -->
    <div class="modal fade" id="room-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add a new room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formAddRoom" method="post" action="{{ route('room.add', $id) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Room name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="room_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description"></textarea>
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
    <!-- add task popup end -->

    <!-- add task popup start -->
    <div class="modal fade bs-example-modal-lg" id="room-add-multiple" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add multiple new rooms</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formAddMultipleRoom" method="post" action="{{ route('room.add.multiple', $id) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">How many rooms do you want to create?</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Room name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="room_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description"></textarea>
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
    <!-- add task popup end -->

    <div class="modal fade" id="room-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update room</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form name="formUpdateRoom" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Room name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="room_name_edit" id="room_name_edit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price_edit" id="price_edit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description_edit" id="room_description_edit"></textarea>
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
    <!-- add task popup End -->
    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" id="tenant-list" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">List of Tenants</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="col-md-12 mb-20"
                        style="display: flex; justify-content: space-between; align-items:center">
                        <input type="text" class="form-control col-md-10" placeholder="Search tenant">
                        <button class="btn btn-primary btn-sm"><i class="icon-copy dw dw-search">
                            </i> &nbsp;&nbsp;Search
                        </button>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped" id="house-table">
                            <thead>
                                <tr>

                                    <th scope="col"></th>
                                    <th scope="col">Full name </th>
                                    <th scope="col">ID card </th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Hometown</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" class="form-control" id="checkbox">
                                        </th>
                                        <td>{{ $tenant->fullname }}</td>
                                        <td>{{ $tenant->id_card }}</td>
                                        <td>{{ $tenant->phone_number }}</td>
                                        <td>{{ $tenant->email }}</td>
                                        <td>{{ $tenant->hometown }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Large modal end-->


    {{-- <!-- Confirmation modal -->

    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?</h4>
                    <form method="post" action="{{ route('room.delete', $id) }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
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
    </div> --}}

    @include('layouts.confirm-popup')


    <script>
        // passing value to delete room confirm modal
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('#confirm-delete-modal-btn');
            deleteButtons.forEach(function(e) {
                e.addEventListener('click', function() {
                    var roomID = e.getAttribute('data-id');
                    var houseID = e.getAttribute('data-houseID');
                    var name = e.getAttribute('data-roomName');
                    var msg = document.querySelector('#msg-delete-confirm');
                    var cardIDInput = document.querySelector(
                        '#confirm-delete-modal input[name="id"]');
                    var formDelete = document.querySelector('#delete-form');
                    formDelete.action = "{{ route('room.delete', ':id') }}".replace(':id',
                        houseID);

                    msg.innerHTML = 'Are you sure you want to delete room ' + name + '?';
                    cardIDInput.value = roomID;
                    $('#confirm-delete-modal').modal('show');
                });
            });
        });

        // passing value to edit room modal
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('#edit-room-modal-btn');
            editButtons.forEach(function(e) {
                e.addEventListener('click', function() {

                    var roomID = e.getAttribute('data-id');
                    var roomName = e.getAttribute('data-roomName');
                    var roomDescription = e.getAttribute('data-description');
                    var price = e.getAttribute('data-price');

                    var formUpdate = document.querySelector(
                        '#room-edit form[name="formUpdateRoom"]');
                    formUpdate.action = "{{ route('room.update', ':id') }}".replace(':id',
                        roomID);


                    var roomNameInput = document.querySelector(
                        '#room-edit input[name="room_name_edit"]');
                    var roomDescriptionInput = document.querySelector(
                        '#room-edit textarea[name="room_description_edit"]');
                    var priceInput = document.querySelector('#room-edit input[name="price_edit"]');

                    roomNameInput.value = roomName;
                    roomDescriptionInput.value = roomDescription;
                    priceInput.value = price;

                    $('#room-edit').modal('show');
                });
            });
        });

        // handle click on row in table of List of Tenants
        // checked => hide other row
        // unchecked => show all row
        const tbody = document.querySelector('#tenant-list tbody');
        const rows = tbody.querySelectorAll('#tenant-list tr');
        rows.forEach((row) => {
            row.addEventListener('mouseenter', (event) => {
                event.currentTarget.style.backgroundColor = '#f2f2f2';
                event.currentTarget.style.cursor = 'pointer';
            });

            row.addEventListener('mouseleave', (event) => {
                event.currentTarget.style.backgroundColor = '';
            });

            row.addEventListener('click', (event) => {
                const tableRow = event.currentTarget;
                const checkbox = row.querySelector('#tenant-list #checkbox');

                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    rows.forEach((otherRow) => {
                        if (otherRow !== tableRow) {
                            otherRow.style.display = 'none';
                        }
                    });
                } else {
                    rows.forEach((otherRow) => {
                        otherRow.style.display = '';
                    });
                }
            });
        });
    </script>

    <script>
        // function submit() {
        //     document.formAddRoom.submit();
        // }

        // function multipleSubmit() {
        //     document.formAddMultipleRoom.submit();
        // }

        // function updateRoom() {
        //     document.formUpdateRoom.submit();
        // }

        // //Show data in edit modal
        // // var table = document.getElementById("area-table");
        // // var id = null;
        // // for (var i = 1; i < table.rows.length; i++) {
        // //     table.rows[i].addEventListener("click", function() {
        // //         document.getElementById('area_name_edit').value = this.cells[2].innerHTML;
        // //         document.getElementById('area_description_edit').value = this.cells[3].innerHTML;

        // //         document.getElementById('msg-delete').innerHTML = "Are you sure to delete " + this.cells[2]
        // //             .innerHTML + "?";

        // //         id = this.cells[0].innerHTML;

        // //         document.formUpdateArea.action = null;

        // //     });
        // // }

        // function actionDelete() {
        //     // document.getElementById('delete-room').action =
        //     //     "{{ route('room.delete', ':id') }}".replace(':id', id);
        //     document.getElementById('delete-room').submit();
        // }
    </script>
@endsection
