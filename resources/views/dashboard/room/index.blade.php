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
                                            @foreach ($rooms as $room)
                                                <div class="col-sm-12 col-md-3 mb-30">
                                                    <div class="card card-box">
                                                        <div class="card-header" style="background-color: #B3DBF8">
                                                            <i class="icon-copy dw dw-house"></i>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $room->room_name }}
                                                        </div>
                                                        <div class="card-body">
                                                            {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                                            <p class="card-text">
                                                                <i class="icon-copy dw dw-user-3"></i>
                                                                Luu Hoai Phong
                                                            </p>
                                                            <p class="card-text">
                                                                <i class="icon-copy dw dw-money-1"></i>
                                                                2000000
                                                            </p>

                                                            <div class="pull-left">
                                                                <a href="#" class="btn btn-secondary btn-sm"><i
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
                                                                        data-target="#house-edit"
                                                                        class="btn btn-secondary btn-sm"
                                                                        title="Edit house"><i class="fa fa-edit"></i></a>
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
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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

    <!-- add task popup start -->
    <div class="modal fade customscroll" id="house-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update house</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
                                <form name="formUpdateHouse" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-md-4">House name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="house_name"
                                                id="house_name_edit">
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
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="updateHouse()">Update</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add task popup End -->

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
        // script handle delete room modal
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
                    formDelete.action = "{{ route('room.delete', ':id') }}".replace(':id', houseID);

                    msg.innerHTML = 'Are you sure you want to delete room ' + name + '?';
                    cardIDInput.value = roomID;
                    $('#confirm-delete-modal').modal('show');
                });
            });
        });
    </script>

    <script>
        function submit() {
            document.formAddRoom.submit();
        }

        function multipleSubmit() {
            document.formAddMultipleRoom.submit();
        }

        function updateArea() {
            document.formUpdateArea.submit();
        }

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
