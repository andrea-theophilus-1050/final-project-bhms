@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Room management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('house.index') }}">House management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room management</li>
                            </ol>
                        </nav>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12">
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
                    </div> --}}
                </div>
            </div>

            {{-- NOTE: if the landlords have only house, this appears for the user if they wanna add another new house --}}
            @if (session('hasOneHouse') && count($rooms) > 0)
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <i>
                                    <h6>{{ $rooms[0]->houses->house_name }}</h6>
                                    {{ $rooms[0]->houses->house_address }}
                                </i>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="pull-right d-flex">
                                <a class="btn btn-outline-primary btn-sm d-flex align-items-center" id="toggle-btn">Hide</a>
                                <div id="content">
                                    &nbsp;&nbsp;&nbsp;You have another house?
                                    <button class="btn btn-success btn-sm" data-toggle="modal"data-target="#house-add"><i
                                            class="ion-plus-round"></i> Add new</button>&nbsp;&nbsp;OR&nbsp;&nbsp;

                                    <button id="edit-house" data-houseID="{{ $rooms[0]->houses->house_id }}"
                                        data-houseName="{{ $rooms[0]->houses->house_name }}"
                                        data-houseAddress="{{ $rooms[0]->houses->house_address }}"
                                        data-houseDescription="{{ $rooms[0]->houses->house_description }}"
                                        class="btn btn-secondary btn-sm" title="Edit house"><i class="fa fa-edit"></i>
                                        Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- NOTE: script handle show hide above element --}}
                <script>
                    const toggleBtn = document.querySelector('#toggle-btn');
                    const content = document.querySelector('#content');

                    content.style.display = 'none';
                    toggleBtn.innerHTML = 'Show';

                    let isHidden = true;

                    toggleBtn.addEventListener('click', () => {
                        if (isHidden) {
                            content.style.display = 'block';
                            toggleBtn.innerHTML = 'Hide';
                        } else {
                            content.style.display = 'none';
                            toggleBtn.innerHTML = 'Show';
                        }
                        isHidden = !isHidden;
                    });
                </script>


                {{-- SECTION-START: add & update house popup --}}

                @include('dashboard.house.modal-add-update')

                <!-- SECTION-END: add & update house popup -->
            @endif

            {{-- <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="dropdown">
                            <form action="" style="display: flex; justify-content: space-between">
                                <input type="text" name="search" placeholder="Room number" class="form-control"
                                    style="margin-right: 5%; font-size: 13px">
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px"> --}}

            {{-- @foreach ($house as $item)
                                        <option value="{{ $item->house_id }}">{{ $item->house_name }}</option>
                                    @endforeach --}}
            {{-- <option value="">Room status</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option> --}}
            {{-- </select>
                                <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                    <option value="">Room billed</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                    <option value="">1</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </form>
                        </div> --}}
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
            {{-- </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic1"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s1">{{ $countTotal }}</div>
                                <div class="weight-600 font-14">Total rooms</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic2"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s2">{{ $countRentedRoom }}</div>
                                <div class="weight-600 font-14">Occupied room</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic3"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s3">{{ $countAvailableRoom }}</div>
                                <div class="weight-600 font-14">Available</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">

                        <div class="clearfix mb-10">
                            <div class="pull-left">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                        <ul style="list-style-type:circle">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('errorPrice'))
                                    <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                        <ul style="list-style-type:circle">
                                            <li>{{ session('errorPrice') }}</li>
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
                                        <ul style="list-style-type:circle">
                                            <li>{{ session('success') }}</li>
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="pull-right">
                                @if ($rooms->count() > 0)
                                    <a href="{{ route('export-rooms', $rooms[0]->houses->house_id) }}"
                                        class="btn btn-info btn-sm"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                        Export rooms excel</a>
                                @endif
                                <button data-toggle="modal" data-target="#room-add" class="btn btn-success btn-sm"><i
                                        class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                    Add a new room</button>
                                <button data-toggle="modal" data-target="#room-add-multiple"
                                    class="btn btn-primary btn-sm"><i class="icon-copy fa fa-plus"
                                        aria-hidden="true"></i>
                                    Add
                                    multiple new rooms</button>

                                <button data-toggle="modal" data-target="#multiple-delete" class="btn btn-danger btn-sm"
                                    id="multiple-delete-btn" disabled><i class="icon-copy fa fa-trash"
                                        aria-hidden="true"></i>
                                    Delete selected rooms</button>
                            </div>
                        </div>


                        <div class="tab">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row clearfix" id="card-rooms">
                                            @if (count($rooms) == 0)
                                                <div class="col-sm-12 col-md-3 mb-30">
                                                    <div class="text-center">
                                                        <h4>No room to show</h4>
                                                    </div>
                                                </div>
                                            @else
                                                @foreach ($rooms as $room)
                                                    <div class="col-sm-12 col-md-3 mb-30">
                                                        <div class="card card-box">
                                                            @if ($room->status == 0)
                                                                <div class="card-header d-flex justify-content-between"
                                                                    style="background-color: #B3DBF8">
                                                                    <div>
                                                                        <input type="checkbox" id="room-checkbox"
                                                                            name="selectedRooms[]"
                                                                            style="width: 15px; height: 15px; margin-right: 8px; cursor: pointer"
                                                                            value="{{ $room->room_id }}">
                                                                        <i class="icon-copy dw dw-house"></i>
                                                                        &nbsp;&nbsp;{{ $room->room_name }}
                                                                    </div>
                                                                    <div class="dropdown">
                                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown">
                                                                            <i class="icon-copy fa fa-ellipsis-v"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                        <div
                                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                            <a href="javacript:;" data-toggle="modal"
                                                                                id="edit-room-modal-btn"
                                                                                data-id="{{ $room->room_id }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-price="{{ $room->price }}"
                                                                                data-description="{{ $room->room_description }}"
                                                                                class="dropdown-item" title="Edit Room"><i
                                                                                    class="dw dw-edit2"></i> Edit</a>
                                                                            <a href="javacript:;" class="dropdown-item"
                                                                                id="confirm-delete-modal-btn"
                                                                                data-id="{{ $room->room_id }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-houseID="{{ $id }}"
                                                                                title="Delete Room"
                                                                                style="color: red; font-weight: bold"><i
                                                                                    class="dw dw-delete-3"></i>
                                                                                Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="card-header d-flex justify-content-between"
                                                                    style="background-color: #1899F5">
                                                                    <div>
                                                                        <i class="icon-copy dw dw-house"></i>
                                                                        &nbsp;&nbsp;<strong>{{ $room->room_name }}</strong>
                                                                        @if ($room->rentals->status == 1)
                                                                            <span class="badge badge-pill badge-warning"
                                                                                style="font-size: 10px">Pending
                                                                                return</span>
                                                                        @endif
                                                                    </div>

                                                                    <div class="dropdown">
                                                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                            href="#" role="button"
                                                                            data-toggle="dropdown">
                                                                            <i class="icon-copy fa fa-ellipsis-v"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                        <div
                                                                            class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                                            <a href="javacript:;" data-toggle="modal"
                                                                                id="edit-room-modal-btn"
                                                                                data-id="{{ $room->room_id }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-price="{{ $room->price }}"
                                                                                data-description="{{ $room->room_description }}"
                                                                                class="dropdown-item" title="Edit Room"><i
                                                                                    class="dw dw-edit2"></i> Edit</a>
                                                                            <a href="javacript:;" class="dropdown-item"
                                                                                id="confirm-delete-modal-btn"
                                                                                data-id="{{ $room->room_id }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-houseID="{{ $id }}"
                                                                                title="Delete Room"
                                                                                style="color: red; font-weight: bold"><i
                                                                                    class="dw dw-delete-3"></i>
                                                                                Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif

                                                            <div class="card-body">
                                                                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                                                <p class="card-text">
                                                                    <i class="icon-copy dw dw-user-3"></i>
                                                                    @if ($room->status == 0)
                                                                        <span class="badge badge-pill badge-primary">
                                                                            Available
                                                                        </span>
                                                                    @else
                                                                        <b style="color: green">
                                                                            {{ $room->rentals->tenants->fullname }}
                                                                        </b>
                                                                    @endif
                                                                </p>
                                                                <p class="card-text d-flex align-items-center">
                                                                    <i class="icon-copy dw dw-money-2"
                                                                        style="font-size: 20px"></i>
                                                                    &nbsp;{{ number_format($room->price, 0, ',', ',') }}
                                                                </p>

                                                                @if ($room->status == 0)
                                                                    <div class="pull-left">
                                                                        <a href="{{ route('room.assign-tenant', $room->room_id) }}"
                                                                            class="btn btn-secondary btn-sm"
                                                                            title="Assign tenant"><i
                                                                                class="icon-copy dw dw-add"></i></a>
                                                                    </div>
                                                                @else
                                                                    <div class="pull-left">
                                                                        @if ($room->rentals->status == 0)
                                                                            <button type="button" id="return-room-btn"
                                                                                class="btn btn-outline-secondary btn-sm"
                                                                                title="Return"
                                                                                data-roomID="{{ $room->room_id }}"
                                                                                data-tenantID="{{ $room->rentals->tenant_id }}"
                                                                                data-tenantName="{{ $room->rentals->tenants->fullname }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-rentalID="{{ $room->rentals->rental_room_id }}">
                                                                                <i class="icon-copy dw dw-refresh2"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button"
                                                                                id="cancel-return-room-btn"
                                                                                class="btn btn-outline-danger btn-sm"
                                                                                title="Cancel return"
                                                                                data-roomID="{{ $room->room_id }}"
                                                                                data-tenantID="{{ $room->rentals->tenant_id }}"
                                                                                data-tenantName="{{ $room->rentals->tenants->fullname }}"
                                                                                data-roomName="{{ $room->room_name }}"
                                                                                data-rentalID="{{ $room->rentals->rental_room_id }}">
                                                                                <i class="icon-copy fi-x-circle"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                @endif

                                                                <div class="pull-right">
                                                                    {{-- <a href="#" class="btn btn-primary btn-sm">
                                                                    <i class="icon-copy dw dw-edit"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm">
                                                                    <i class="icon-copy dw dw-trash"></i>
                                                                </a> --}}


                                                                    <button id="show-roomInfo-detail"
                                                                        title="Room information"
                                                                        class="btn btn-primary btn-sm" role="button"
                                                                        title="Show details" data-toggle="modal"
                                                                        data-roomID="{{ $room->room_id }}"
                                                                        data-roomName="{{ $room->room_name }}"
                                                                        data-price="{{ $room->price }}"
                                                                        data-status="{{ $room->status }}"
                                                                        data-houseName="{{ $room->houses->house_name }}"
                                                                        data-houseAddress="{{ $room->houses->house_address }}"
                                                                        @if ($room->status == 1) data-mainTenantID="{{ $room->rentals->tenants->tenant_id }}"
                                                                            data-tenantName="{{ $room->rentals->tenants->fullname }}"
                                                                            data-idCard="{{ $room->rentals->tenants->id_card }}"
                                                                            data-phoneNumber="{{ $room->rentals->tenants->phone_number }}"
                                                                            data-email="{{ $room->rentals->tenants->email }}"
                                                                            data-gender="{{ $room->rentals->tenants->gender }}"
                                                                            data-dob="{{ $room->rentals->tenants->dob }}"
                                                                            data-hometown="{{ $room->rentals->tenants->hometown }}"
                                                                            data-idFrontPhoto="{{ $room->rentals->tenants->citizen_card_front_image }}"
                                                                            data-idBackPhoto="{{ $room->rentals->tenants->citizen_card_back_image }}"
                                                                            data-list-member="{{ $room->rentals->tenants->members }}" 
                                                                            data-service-used = "{{ collect($serviceUsed)->where('room_id', $room->room_id) }}" @endif>
                                                                        <i class="icon-copy fa fa-info-circle"
                                                                            aria-hidden="true"></i>
                                                                    </button>

                                                                    @if ($room->status != 0)
                                                                        <a href="{{ route('room.edit-tenant', [$room->room_id, $room->rentals->rental_room_id]) }}"
                                                                            class="btn btn-secondary btn-sm">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                        {{-- <button class="btn btn-danger btn-sm"
                                                                            type="button">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button> --}}
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
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


    <!-- SECTION-START: add room popup -->
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
                                <input type="text" class="form-control" name="room_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" id="price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i>
                                &nbsp; Add</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-END: add room popup -->

    <!-- SECTION-START: add multiple rooms popup -->
    <div class="modal fade bs-example-modal-lg" id="room-add-multiple" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                                <input type="number" class="form-control" name="quantity" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Room name</label>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between">
                                    <input type="text" placeholder="Name" class="form-control col-md-6"
                                        name="room_name" required>
                                    <input type="number" placeholder="Start from" class="form-control col-md-5"
                                        name="start_from" required min="1">
                                </div>
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Room name will be saved as: start with your room name followed by a count from the
                                    number you enter. For example: "Room 1, Room 2, ..."
                                </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" id="price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i>
                                &nbsp; Add</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-END: add multiple rooms popup -->

    {{-- SECTION-START: update room popup --}}
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
                                <input type="text" class="form-control" name="room_name_edit" id="room_name_edit"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price_edit" id="price_edit" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Description</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="room_description_edit" id="room_description_edit"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i>
                                &nbsp; Update</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- SECTION-END: update room popup -->

    <!-- SECTION-START: Detail room modal -->
    <div class="modal fade bs-example-modal-lg" id="show-detail-room-modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="invoice-wrap">
                    <div class="invoice-box">
                        {{-- SECTION-START: room information --}}
                        <h5 class="text-left mb-20 weight-600"><i class="icon-copy dw dw-house"></i> Room information</h5>
                        <div class="row pb-30">

                            <div class="col-md-6">
                                <p class="font-14 mb-5">Room:
                                    <strong class="font-16 weight-600" id="modal_room_name">
                                        Room name 1
                                    </strong>
                                </p>
                                <p class="font-14 mb-5">Price:
                                    <strong class="font-16 weight-600" id="modal_room_price">
                                        Room price
                                    </strong>
                                </p>
                                <p class="font-14 mb-5">Status:
                                    <span class="badge badge-pill badge-danger" id="modal_room_status">
                                        Room status
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-14 mb-5">Belongs to the house:
                                    <strong class="weight-600" id="modal_house_name">
                                        Boarding House name
                                    </strong>
                                </p>
                                <p class="font-14 mb-5">House address:
                                    <strong class="weight-600" id="modal_house_address">
                                        House address
                                    </strong>
                                </p>
                            </div>
                        </div>
                        {{-- SECTION-END: room information --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="divider" style="background-color: black; height: 2px; width: 100%">
                                </div>
                            </div>
                        </div>

                        {{-- SECTION-START: services used --}}

                        <div class="invoice-desc pb-30" id="serviceUsed" style="margin-top: 20px">
                            <h5 class="text-left mb-20 weight-600"><i class="icon-copy dw dw-suitcase-11"></i> Services
                                current used
                            </h5>
                            <div class="table-responsive">
                                <table class="table " id="service-used-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"># </th>
                                            <th scope="col">Type service</th>
                                            <th scope="col">Service name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- SECTION-END: services used --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="divider" style="background-color: black; height: 2px; width: 100%"></div>
                            </div>
                        </div>

                        {{-- SECTION-START: Main tenant information --}}
                        <div class="invoice-desc pb-30" style="margin-top: 20px">
                            <h5 class="text-left mb-20 weight-600"><i class="icon-copy dw dw-user-2"></i> Main tenant
                                &nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-info btn-sm" id="assignTenant"><i
                                        class="icon-copy dw dw-add"></i>
                                    Assign tenant
                                </a>
                            </h5>

                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-user"></i> Fullname:
                                        <strong class="weight-600" id="modal_tenant_fullname">
                                            Tenant name
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-id-card2"></i> ID card number:
                                        <strong class="weight-600" id="modal_tenant_idCard">
                                            Tenant ID Card
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-phone-call"></i> Phone number:
                                        <strong class="weight-600">
                                            <a href="tel:0398371050" style="color: blue" id="modal_tenant_phone">Tenant
                                                phone number</a>
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:
                                        <strong class="weight-600">
                                            <a href="mailto:luuhoaiphong147@gmail.com" style="color: blue"
                                                id="modal_tenant_email">Tenant email address</a>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">

                                    <p class="font-15 mb-5"><i class="icon-copy ion-transgender"></i> Gender:
                                        <strong class="weight-600" id="modal_tenant_gender">
                                            Tenant gender
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-calendar-5"></i> Date of birth:
                                        <strong class="weight-600" id="modal_tenant_dob">
                                            Tenant Date of birth
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-house-1"></i> Hometown:
                                        <strong class="weight-600" id="modal_tenant_hometown">
                                            Tenant hometown
                                        </strong>
                                    </p>

                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card front photo:
                                    </p>
                                    <img src="" alt="" width="80%" id="modal_tenant_front_IDcard">
                                </div>
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back photo:
                                    </p>
                                    <img src="" alt="" width="80%" id="modal_tenant_back_IDcard">
                                </div>
                            </div>
                        </div>
                        {{-- SECTION-END: Main tenant information --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="divider" style="background-color: black; height: 2px; width: 100%">
                                </div>
                            </div>
                        </div>

                        {{-- SECTION-START: Room members --}}
                        <div class="invoice-desc pb-30" id="roomMembersSection" style="margin-top: 20px">
                            <h5 class="text-left weight-600 mb-10">
                                <i class="icon-copy fa fa-group" aria-hidden="true"></i> Room members &nbsp;&nbsp;&nbsp;

                                {{-- NOTE: Button for show/hide table add new members --}}
                                <button class="btn btn-info btn-sm" id="showHideAddMember"><i
                                        class="icon-copy dw dw-add"></i>
                                    Add new members
                                </button>
                            </h5>

                            {{-- NOTE: table for add new members start --}}
                            <div id="addMemebersTable">
                                <div class="table-responsive">
                                    <form id="room-members" action="{{ route('assign-members') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="main_tenant_id" id="main_tenant_id">
                                        @csrf
                                        <table class="table table-striped" id="tenant-member-table">
                                            <thead style="white-space: nowrap;">
                                                <tr>
                                                    <th scope="col"
                                                        style="position: sticky; left: 0; z-index: 1; background: white">
                                                        <button class="btn btn-primary btn-sm" type="submit"><i
                                                                class="icon-copy dw dw-diskette2"></i> &nbsp;
                                                            Submit</button>
                                                    </th>
                                                    <th scope="col">Full name </th>
                                                    <th scope="col">ID Card</th>
                                                    <th scope="col">Data of birth</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Hometown</th>
                                                    <th scope="col">ID Card front photo</th>
                                                    <th scope="col">ID Card back photo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body">
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1; background: white;">
                                                        <button type='button' class='btn btn-danger btn-sm'
                                                            onclick='deleteRow(this)'><i
                                                                class='icon-copy fa fa-minus-circle'
                                                                aria-hidden='true'></i></button>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' name='fullname[]'
                                                            style="width: 200px" required>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' name='id_card[]'
                                                            style="width: 200px" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="dob[]"
                                                            style="width: 100px" required>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-radio mb-5 mr-20">
                                                            <input type="radio" id="male" name="gender[0]"
                                                                class="custom-control-input" value="Male" checked>
                                                            <label class="custom-control-label weight-400"
                                                                for="male">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" id="female" name="gender[0]"
                                                                class="custom-control-input" value="Female">
                                                            <label class="custom-control-label weight-400"
                                                                for="female">Female</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' name='phone[]'
                                                            style="width: 200px" required>
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' name='email[]'
                                                            style="width: 200px">
                                                    </td>
                                                    <td>
                                                        <input type='text' class='form-control' name='hometown[]'
                                                            style="width: 200px" required>
                                                    </td>
                                                    <td>
                                                        <input type='file' class='form-control'
                                                            name='idcard_front[]'style="width: 300px" accept="image/*">
                                                    </td>
                                                    <td>
                                                        <input type='file' class='form-control'
                                                            name='idcard_back[]'style="width: 300px" accept="image/*">
                                                    </td>

                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td style="position: sticky; left: 0; z-index: 1">
                                                        <button class="btn btn-success btn-sm" type="button"
                                                            id="add-new-row">
                                                            <i class="icon-copy fa fa-plus-circle" aria-hidden="true"></i>
                                                        </button>
                                                    </td>
                                                    <td colspan="9"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            {{-- NOTE: table for add new members end --}}
                            <div id="memberContainer">
                                <div id="membersInfo">
                                    <div class="row pb-30" style="margin-top: 20px">
                                        <div class="col-md-6">
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-user"></i> Fullname:
                                                <strong class="weight-600" id="modal_members_fullname">
                                                    Members full name
                                                </strong>
                                            </p>
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-id-card2"></i> ID card
                                                number:
                                                <strong class="weight-600" id="modal_members_idCard">
                                                    Members ID card number
                                                </strong>
                                            </p>
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-phone-call"></i> Phone
                                                number:
                                                <strong class="weight-600">
                                                    <a href="tel:0398371050" style="color: blue"
                                                        id="modal_members_phone">Members
                                                        phone number</a>
                                                </strong>
                                            </p>
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:
                                                <strong class="weight-600">
                                                    <a href="mailto:luuhoaiphong147@gmail.com" style="color: blue"
                                                        id="modal_members_email">Members email address</a>
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="font-15 mb-5"><i class="icon-copy ion-transgender"></i> Gender:
                                                <strong class="weight-600" id="modal_members_gender">
                                                    Members Gender
                                                </strong>
                                            </p>
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-calendar-5"></i> Date of
                                                birth:
                                                <strong class="weight-600" id="modal_members_dob">
                                                    Members date of birth
                                                </strong>
                                            </p>
                                            <p class="font-15 mb-5"><i class="icon-copy dw dw-house-1"></i> Hometown:
                                                <strong class="weight-600" id="modal_members_hometown">
                                                    Members hometown
                                                </strong>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="row pb-30">
                                        <div class="col-md-6">
                                            <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card front
                                                photo:
                                            </p>
                                            <img src="{{ asset('avatar/default-image.png') }}" alt=""
                                                width="80%" id="modal_members_front_IDcard">
                                        </div>
                                        <div class="col-md-6">
                                            <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back
                                                photo:
                                            </p>
                                            <img src="{{ asset('avatar/default-image.png') }}" alt=""
                                                width="80%" id="modal_members_back_IDcard">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="divider"
                                                style="background-color: black; height: 2px; width: 100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- SECTION-END: room members --}}
                    </div>
                </div>
            </div>
        </div>

        <script>
            // NOTE: script for show/hide add new members modal popup
            const toggleBtn = document.querySelector('#showHideAddMember');
            const content = document.querySelector('#addMemebersTable');

            content.style.display = 'none';
            toggleBtn.innerHTML = '<i class="icon-copy dw dw-add"></i> Add new members';

            let isHidden = true;

            toggleBtn.addEventListener('click', () => {
                if (isHidden) {
                    content.style.display = 'block';
                    toggleBtn.innerHTML = 'Hide';
                } else {
                    content.style.display = 'none';
                    toggleBtn.innerHTML = '<i class="icon-copy dw dw-add"></i> Add new members';
                }
                isHidden = !isHidden;
            });
        </script>
    </div>
    <!-- SECTION-END: Detail room modal -->

    {{-- SECTION-START: confirm delete popup --}}
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="delete-form" method="post">
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
    </div>
    {{-- SECTION-END: confirm delete popup --}}

    {{-- SECTION-START: confirm return room popup --}}
    <div class="modal fade" id="return-room-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="return-room-form" method="post">
                        @csrf
                        <input type="hidden" name="roomID" id="roomID">
                        <input type="hidden" name="tenantID" id="tenantID">
                        <input type="hidden" name="rentalID" id="rentalID">

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
    {{-- SECTION-END: confirm return room popup --}}

    {{-- SECTION-START: confirm return room popup --}}
    <div class="modal fade" id="cancel-return-room-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="cancel-return-room-form" method="post">
                        @csrf
                        <input type="hidden" name="roomID" id="roomID">
                        <input type="hidden" name="tenantID" id="tenantID">
                        <input type="hidden" name="rentalID" id="rentalID">

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
    {{-- SECTION-END: confirm return room popup --}}

    {{-- SECTION-START: confirm return room popup --}}
    <div class="modal fade" id="multiple-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="multiple-delete-form" method="post" action="{{ route('room.delete.multiple') }}">
                        @csrf
                        <div id="selectedRoom-section">

                        </div>

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
    {{-- SECTION-END: confirm return room popup --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // NOTE: passing value to delete room confirm modal
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

            // NOTE: passing value to edit room modal
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

            // NOTE: passing value to edit house modal
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

            var returnRoomBtn = document.querySelectorAll('#return-room-btn');
            returnRoomBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var roomID = e.getAttribute('data-roomID');
                    var roomName = e.getAttribute('data-roomName');
                    var tenantID = e.getAttribute('data-tenantID');
                    var tenantName = e.getAttribute('data-tenantName');
                    var rentalID = e.getAttribute('data-rentalID');

                    var roomIDInput = document.querySelector('#return-room-modal #roomID');
                    var tenantIDInput = document.querySelector('#return-room-modal #tenantID');
                    var rentalIDInput = document.querySelector('#return-room-modal #rentalID');

                    roomIDInput.value = roomID;
                    tenantIDInput.value = tenantID;
                    rentalIDInput.value = rentalID;

                    var msg = document.querySelector('#return-room-modal #msg-confirm');
                    msg.innerHTML = " \"" + roomName + " - " + tenantName +
                        "\" <br>put on the return room waiting list?"

                    var formReturnRoom = document.querySelector('#return-room-form');
                    formReturnRoom.action = "{{ route('room.return') }}";


                    $('#return-room-modal').modal('show');
                });
            });

            var cancelReturnRoomBtn = document.querySelectorAll('#cancel-return-room-btn');
            cancelReturnRoomBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var roomID = e.getAttribute('data-roomID');
                    var roomName = e.getAttribute('data-roomName');
                    var tenantID = e.getAttribute('data-tenantID');
                    var tenantName = e.getAttribute('data-tenantName');
                    var rentalID = e.getAttribute('data-rentalID');

                    var roomIDInput = document.querySelector('#cancel-return-room-modal #roomID');
                    var tenantIDInput = document.querySelector(
                        '#cancel-return-room-modal #tenantID');
                    var rentalIDInput = document.querySelector(
                        '#cancel-return-room-modal #rentalID');

                    roomIDInput.value = roomID;
                    tenantIDInput.value = tenantID;
                    rentalIDInput.value = rentalID;

                    var msg = document.querySelector('#cancel-return-room-modal #msg-confirm');
                    msg.innerHTML = " \"" + roomName + " - " + tenantName +
                        "\" <br>cancel return room?"

                    var formCancelReturnRoom = document.querySelector('#cancel-return-room-form');
                    formCancelReturnRoom.action = "{{ route('room.cancelReturn') }}";

                    $('#cancel-return-room-modal').modal('show');
                });

            });
        });
    </script>

    <script>
        const checkboxes = document.querySelectorAll('#card-rooms input[type="checkbox"]');
        const deleteBtn = document.querySelector('#multiple-delete-btn');

        function checkboxDeleteButton() {
            const checked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteBtn.disabled = !checked;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', checkboxDeleteButton);
        });

        deleteBtn.addEventListener('click', () => {
            const deleteIDSection = document.getElementById('selectedRoom-section');
            deleteIDSection.innerHTML = '';

            Array.from(checkboxes).forEach(checkbox => {
                if (checkbox.checked) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selectedRoom[]';
                    input.value = checkbox.value;
                    deleteIDSection.appendChild(input);
                }
            });
        });
    </script>

    <script src="{{ asset('vendors/scripts/handle-room-page.js') }}"></script>
@endsection
