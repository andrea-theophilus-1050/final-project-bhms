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
                                <li class="breadcrumb-item"><a href="{{ route('house.index') }}">House management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navRoom')</li>
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
                            <div class="pull-right" style="display: flex">
                                <a class="btn btn-outline-primary btn-sm" id="toggle-btn"
                                    style="display: flex; align-items: center">Hide</a>
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
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic1"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s1">{{ $countTotal }}</div>
                                <div class="weight-600 font-14">Total room</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic2"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s2">{{ $countRentedRoom }}</div>
                                <div class="weight-600 font-14">Rented room</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
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
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="statistic4"></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0" id="s4">0</div>
                                <div class="weight-600 font-14">Unknown</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                    <div class="pd-20 card-box">

                        <div class="clearfix mb-10">
                            <div class="pull-right">
                                <button data-toggle="modal" data-target="#room-add" class="btn btn-success btn-sm"><i
                                        class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                    Add a new room</button>
                                <button data-toggle="modal" data-target="#room-add-multiple" class="btn btn-info btn-sm"><i
                                        class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                    Add
                                    multiple new rooms</button>
                            </div>
                        </div>


                        <div class="tab">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row clearfix">
                                            @if (count($rooms) == 0)
                                                <h4>No data found</h4>
                                            @else
                                                @foreach ($rooms as $room)
                                                    <div class="col-sm-12 col-md-3 mb-30">
                                                        <div class="card card-box">
                                                            @if ($room->status == 0)
                                                                <div class="card-header" style="background-color: #B3DBF8">
                                                                    <i class="icon-copy dw dw-house"></i>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $room->room_name }}
                                                                </div>
                                                            @else
                                                                <div class="card-header"
                                                                    style="background-color: #1899F5">
                                                                    <i class="icon-copy dw dw-house"></i>
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $room->room_name }}
                                                                    <span class="badge badge-pill badge-success">
                                                                        Rented
                                                                    </span>
                                                                </div>
                                                            @endif

                                                            <div class="card-body">
                                                                {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                                                <p class="card-text">
                                                                    <i class="icon-copy dw dw-user-3"></i>
                                                                    @if ($room->status == 0)
                                                                        <span class="badge badge-pill badge-danger">
                                                                            Available
                                                                        </span>
                                                                    @else
                                                                        <b style="color: green">
                                                                            {{ $room->rentals->tenants->fullname }}
                                                                        </b>
                                                                    @endif
                                                                </p>
                                                                <p class="card-text"
                                                                    style="display: flex; align-items: center">
                                                                    <i class="icon-copy dw dw-money-2"
                                                                        style="font-size: 20px"></i>
                                                                    &nbsp;{{ number_format($room->price, 0, ',', ',') }}
                                                                </p>

                                                                @if ($room->status == 0)
                                                                    <div class="pull-left">
                                                                        <a href="{{ route('room.assign-tenant', $room->room_id) }}"
                                                                            class="btn btn-secondary btn-sm"><i
                                                                                class="icon-copy dw dw-add"></i></a>
                                                                    </div>
                                                                @else
                                                                    <div class="pull-left">
                                                                        <a href="#"
                                                                            class="btn btn-outline-secondary btn-sm"
                                                                            title="Return"><i
                                                                                class="icon-copy dw dw-refresh2"></i></a>
                                                                    </div>
                                                                @endif

                                                                <div class="pull-right">
                                                                    {{-- <a href="#" class="btn btn-primary btn-sm">
                                                                    <i class="icon-copy dw dw-edit"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm">
                                                                    <i class="icon-copy dw dw-trash"></i>
                                                                </a> --}}



                                                                    <a href="#" class="btn btn-primary btn-sm"
                                                                        role="button" title="Show details"
                                                                        data-toggle="modal"
                                                                        data-target="#show-detail-room"><i
                                                                            class="fa fa-eye"></i></a>


                                                                    <a href="javascript:;" data-toggle="modal"
                                                                        id="edit-room-modal-btn"
                                                                        data-id="{{ $room->room_id }}"
                                                                        data-roomName="{{ $room->room_name }}"
                                                                        data-price="{{ $room->price }}"
                                                                        data-description="{{ $room->room_description }}"
                                                                        class="btn btn-secondary btn-sm"
                                                                        title="Edit Room"><i class="fa fa-edit"></i></a>
                                                                    @csrf
                                                                    {{-- <button type="submit" class="btn btn-danger"
                                                                        onclick="return confirm('Are you sure to delete?')"><i
                                                                            class="fa fa-trash"></i></button> --}}

                                                                    <button class="btn btn-danger btn-sm" type="button"
                                                                        id="confirm-delete-modal-btn"
                                                                        data-id="{{ $room->room_id }}"
                                                                        data-roomName="{{ $room->room_name }}"
                                                                        data-houseID="{{ $id }}"><i
                                                                            class="fa fa-trash"></i></button>

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
                                <input type="text" class="form-control" name="room_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">Price</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="price" id="price">
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
                                <input type="text" class="form-control" name="price" id="price">
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
    <!-- SECTION-END: update room popup -->

    <!-- SECTION-START: Detail room modal -->
    <div class="modal fade bs-example-modal-lg" id="show-detail-room" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        5,000,000
                                    </strong>
                                </p>
                                <p class="font-14 mb-5">Status:
                                    <span class="badge badge-pill badge-danger" id="modal_room_status">
                                        Available
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="font-14 mb-5">Belongs to the house:
                                    <strong class="weight-600" id="modal_house_name">
                                        Trọ Hoàn Hảo 2
                                    </strong>
                                </p>
                                <p class="font-14 mb-5">House address:
                                    <strong class="weight-600" id="modal_house_address">
                                        123 Nguyễn Văn Linh, Phường 7, Quận Gò Vấp, TP Hồ Chí Minh
                                    </strong>
                                </p>
                            </div>
                        </div>
                        {{-- SECTION-END: room information --}}

                        {{-- SECTION-START: Main tenant information --}}
                        <div class="invoice-desc pb-30">
                            <h5 class="text-left mb-20 weight-600"><i class="icon-copy dw dw-user-2"></i> Main tenant</h5>
                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-user"></i> Fullname:
                                        <strong class="weight-600" id="modal_tenant_fullname">
                                            Luu Hoai Phong
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-id-card2"></i> ID card number:
                                        <strong class="weight-600" id="modal_tenant_idCard">
                                            082201003811
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-phone-call"></i> Phone number:
                                        <strong class="weight-600" id="modal_tenant_phone">
                                            <a href="tel:0398371050" style="color: blue">0398371050</a>
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:
                                        <strong class="weight-600" id="modal_tenant_email">
                                            <a href="mailto:luuhoaiphong147@gmail.com"
                                                style="color: blue">luuhoaiphong147@gmail.com</a>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">

                                    <p class="font-15 mb-5"><i class="icon-copy ion-transgender"></i> Gender:
                                        <strong class="weight-600" id="modal_tenant_gender">
                                            Male
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-calendar-5"></i> Date of birth:
                                        <strong class="weight-600" id="modal_tenant_dob">
                                            March 1, 2001
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-house-1"></i> Hometown:
                                        <strong class="weight-600" id="modal_tenant_hometown">
                                            Quý Thành, Nhị Quý, Cai Lậy, Tiền Giang
                                        </strong>
                                    </p>

                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card front photo:
                                    </p>
                                    <img src="{{ asset('avatar/default-image.png') }}" alt="" width="80%"
                                        id="modal_tenant_front_IDcard">
                                </div>
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back photo:
                                    </p>
                                    <img src="{{ asset('avatar/default-image.png') }}" alt="" width="80%"
                                        id="modal_tenant_back_IDcard">
                                </div>
                            </div>
                        </div>
                        {{-- SECTION-END: Main tenant information --}}

                        {{-- SECTION-START: Room members --}}
                        <div class="invoice-desc pb-30">
                            <h5 class="text-left weight-600 mb-10">
                                <i class="icon-copy fa fa-group" aria-hidden="true"></i> Room members &nbsp;&nbsp;&nbsp;

                                {{-- NOTE: Button for show/hide table add new members --}}
                                <button class="btn btn-info btn-sm" id="showHideAddMember"><i
                                        class="icon-copy dw dw-add"></i>
                                    Add new members
                                </button>
                            </h5>

                            {{-- NOTE: table for add new members start --}}
                            <div class="table-responsive" id="addMemebersTable">
                                <form id="room-members" action="" method="POST">
                                    <div class="pull-right mb-10">
                                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                    @csrf
                                    <table class="table table-striped" id="tenant-member-table">
                                        <thead style="white-space: nowrap;">
                                            <tr>
                                                <th scope="col">Full name </th>
                                                <th scope="col">ID Card</th>
                                                <th scope="col">Data of birth</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Hometown</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            <tr>
                                                
                                                <td>
                                                    <input type='text' class='form-control' name='fullname[]'>
                                                </td>
                                                <td>
                                                    <input type='text' class='form-control' name='id_card[]'>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="dob[]">
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
                                                    <input type='text' class='form-control' name='phone[]'>
                                                </td>
                                                <td>
                                                    <input type='text' class='form-control' name='email[]'>
                                                </td>
                                                <td>
                                                    <input type='text' class='form-control' name='hometown[]'>
                                                </td>
                                                <td>
                                                    <button type='button' class='btn btn-danger btn-sm'
                                                        onclick='deleteRow(this)'><i class='icon-copy fa fa-minus-circle'
                                                            aria-hidden='true'></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7"></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" type="button"
                                                        id="add-new-row">
                                                        <i class="icon-copy fa fa-plus-circle" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                            {{-- NOTE: table for add new members end --}}

                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-user"></i> Fullname:
                                        <strong class="weight-600" id="modal_members_fullname">
                                            Luu Hoai Phong
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-id-card2"></i> ID card number:
                                        <strong class="weight-600" id="modal_members_idCard">
                                            082201003811
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-phone-call"></i> Phone number:
                                        <strong class="weight-600" id="modal_members_phone">
                                            <a href="tel:0398371050" style="color: blue">0398371050</a>
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:
                                        <strong class="weight-600" id="modal_members_email">
                                            <a href="mailto:luuhoaiphong147@gmail.com"
                                                style="color: blue">luuhoaiphong147@gmail.com</a>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-md-6">

                                    <p class="font-15 mb-5"><i class="icon-copy ion-transgender"></i> Gender:
                                        <strong class="weight-600" id="modal_members_gender">
                                            Male
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-calendar-5"></i> Date of birth:
                                        <strong class="weight-600" id="modal_members_dob">
                                            March 1, 2001
                                        </strong>
                                    </p>
                                    <p class="font-15 mb-5"><i class="icon-copy dw dw-house-1"></i> Hometown:
                                        <strong class="weight-600" id="modal_members_hometown">
                                            Quý Thành, Nhị Quý, Cai Lậy, Tiền Giang
                                        </strong>
                                    </p>

                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card front photo:
                                    </p>
                                    <img src="{{ asset('avatar/default-image.png') }}" alt="" width="80%"
                                        id="modal_members_front_IDcard">
                                </div>
                                <div class="col-md-6">
                                    <p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back photo:
                                    </p>
                                    <img src="{{ asset('avatar/default-image.png') }}" alt="" width="80%"
                                        id="modal_members_back_IDcard">
                                </div>
                            </div>

                            {{-- line divider --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="divider" style="background-color: black; height: 2px; width: 100%"></div>
                                </div>
                            </div>

                            {{--     <ul>
                                    <li class="clearfix">
                                        <div class="invoice-sub">Website Design</div>
                                        <div class="invoice-rate">$20</div>
                                        <div class="invoice-hours">100</div>
                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="invoice-sub">Logo Design</div>
                                        <div class="invoice-rate">$20</div>
                                        <div class="invoice-hours">100</div>
                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="invoice-sub">Website Design</div>
                                        <div class="invoice-rate">$20</div>
                                        <div class="invoice-hours">100</div>
                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <div class="invoice-sub">Logo Design</div>
                                        <div class="invoice-rate">$20</div>
                                        <div class="invoice-hours">100</div>
                                        <div class="invoice-subtotal"><span class="weight-600">$2000</span>
                                        </div>
                                    </li>
                                </ul>
                            </div> --}}
                            {{-- <div class="invoice-desc-footer">
                                <div class="invoice-desc-head clearfix">
                                    <div class="invoice-sub">Bank Info</div>
                                    <div class="invoice-rate">Due By</div>
                                    <div class="invoice-subtotal">Total Due</div>
                                </div>
                                <div class="invoice-desc-body">
                                    <ul>
                                        <li class="clearfix">
                                            <div class="invoice-sub">
                                                <p class="font-14 mb-5">Account No: <strong class="weight-600">123 456
                                                        789</strong></p>
                                                <p class="font-14 mb-5">Code: <strong class="weight-600">4556</strong></p>
                                            </div>
                                            <div class="invoice-rate font-20 weight-600">10 Jan 2018</div>
                                            <div class="invoice-subtotal"><span
                                                    class="weight-600 font-24 text-danger">$8000</span></div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
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
            toggleBtn.innerHTML = '<i class="icon-copy dw dw-add"></i> Add new';

            let isHidden = true;

            toggleBtn.addEventListener('click', () => {
                if (isHidden) {
                    content.style.display = 'block';
                    toggleBtn.innerHTML = 'Hide';
                } else {
                    content.style.display = 'none';
                    toggleBtn.innerHTML = '<i class="icon-copy dw dw-add"></i> Add new';
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
        });

        // function assignTenantSubmit() {
        //     const tenantForm = document.querySelector('#room-assign-tenant');
        //     tenantForm.submit();
        // }

        // Format number input with commas as thousands separators
        const numberInput = document.querySelector("#room-add #price");
        const numberInputMultiple = document.querySelector("#room-add-multiple #price");
        const numberInputEdit = document.querySelector("#room-edit #price_edit");


        // Add event listener for when input value changes
        numberInput.addEventListener("input", formatNumber);
        numberInputMultiple.addEventListener("input", formatNumber);
        numberInputEdit.addEventListener("input", formatNumber);

        function formatNumber() {

            if (this.value.length === 0) return;
            // Get the input value and remove any non-numeric characters except for the decimal point
            let input = this.value.replace(/[^0-9.]/g, "");

            // Parse the input as a float and format it with commas as thousands separators
            let formatted = parseFloat(input).toLocaleString();

            // Update the input value with the formatted value
            this.value = formatted;
        }




        //NOTE: add new row to table button
        const addRowButton = document.getElementById("add-new-row");
        const tableBody = document.getElementById("table-body");
        let clickCount = 0;

        addRowButton.addEventListener("click", function() {
            clickCount++;
            // NOTE: Create a new row
            const newRow = document.createElement("tr");

            // NOTE: Create the cells for the new row
            const cell1 = document.createElement("td");
            const cell2 = document.createElement("td");
            const cell3 = document.createElement("td");
            const cell4 = document.createElement("td");
            const cell5 = document.createElement("td");
            const cell6 = document.createElement("td");
            const cell7 = document.createElement("td");
            const cell8 = document.createElement("td");


            // NOTE: Add content to the cells
            cell1.innerHTML =
                "<input type='text' class='form-control' name='fullname[]'>";
            cell2.innerHTML =
                "<input type='text' class='form-control' name='id_card[]'>";
            cell3.innerHTML =
                "<input class='form-control' type='text' name='dob[]'>";
            cell4.innerHTML =
                "<div class='custom-control custom-radio mb-5 mr-20'>" +
                "<input type='radio' id='male" + clickCount +
                "' name='gender[" + clickCount + "]' class='custom-control-input' value='Male' checked>" +
                "<label class='custom-control-label weight-400' for='male" + clickCount + "'>Male</label>" +
                "</div> <div class='custom-control custom-radio mb-5'>" +
                "<input type='radio' id='female" + clickCount +
                "' name='gender[" + clickCount + "]' class='custom-control-input' value='Female'>" +
                "<label class='custom-control-label weight-400' for='female" + clickCount +
                "'>Female</label> </div>";
            cell5.innerHTML =
                "<input type='text' class='form-control' name='phone[]'>";
            cell6.innerHTML =
                "<input type='text' class='form-control' name='email[]'>";
            cell7.innerHTML =
                "<input type='text' class='form-control' name='hometown[]'>";
            cell8.innerHTML =
                "<button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'><i class='icon-copy fa fa-minus-circle' aria-hidden='true'></i></button>";

            // NOTE: Append the cells to the new row
            newRow.appendChild(cell1);
            newRow.appendChild(cell2);
            newRow.appendChild(cell3);
            newRow.appendChild(cell4);
            newRow.appendChild(cell5);
            newRow.appendChild(cell6);
            newRow.appendChild(cell7);
            newRow.appendChild(cell8);

            // NOTE: Append the new row to the table body
            tableBody.appendChild(newRow);

        });

        // NOTE: delete row in table
        function deleteRow(btn) {
            const row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
@endsection
