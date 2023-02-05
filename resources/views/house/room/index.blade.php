@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Room Management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('house.index') }}">@lang('messages.navHouse')</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{-- route('area.index',$id) --}}">Area
                                        management</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room management ->>>>>>> {{ $countAvailable }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card mt-30 mb-30">
                            <div class="pricing-icon">
                                <img src="{{ asset('vendors/images/icon-Cash.png') }}" alt="">
                            </div>
                            <div class="price-title">
                                Available
                            </div>
                            <div class="pricing-price">
                                10
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card mt-30 mb-30">
                            <div class="pricing-icon">
                                <img src="{{ asset('vendors/images/icon-debit.png') }}" alt="">
                            </div>
                            <div class="price-title">
                                expert
                            </div>
                            <div class="pricing-price">
                                <sup>$</sup>199<sub>/mo</sub>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card mt-30 mb-30">
                            <div class="pricing-icon">
                                <img src="{{ asset('vendors/images/icon-online-wallet.png') }}" alt="">
                            </div>
                            <div class="price-title">
                                experience
                            </div>
                            <div class="pricing-price">
                                <sup>$</sup>599<sub>/yr</sub>
                            </div>
                            
                        </div>
                    </div>
                </div>                
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:;" data-toggle="modal" data-target="#room-add" class="btn btn-success btn-sm"><i
                                class="ion-plus-round"></i> Add new area for the house</a>

                        <a href="javascript:;" data-toggle="modal" data-target="#room-add-multiple" class="btn btn-success btn-sm"><i
                                class="ion-plus-round"></i> Add multiple</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="area-table">
                        <thead>
                            <tr>
                                <th style="display: none" scope="col">Room ID</th>
                                <th scope="col">No. </th>
                                <th scope="col">Room name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $item)
                                @if ($item->status == 0)
                                    <tr>
                                        <td style="display: none">{{ $item->room_id }}</td>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->room_name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>Available</td>
                                        <td>{{ $item->room_description }}</td>
                                        <td>
                                            <form id="delete-area" action="{{ route('area.delete', $item->room_id) }}"
                                                method="Post">
                                                <a href="{{ route('room.index', $item->room_id) }}" class="btn btn-primary"
                                                    role="button" title="Show details"><i class="fa fa-eye"></i></a>
                                                <a href="javascript:;" data-toggle="modal" data-target="#room-edit"
                                                    class="btn btn-secondary" title="Edit area"><i
                                                        class="fa fa-edit"></i></a>
                                                @csrf
                                                {{-- <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="fa fa-trash"></i></button> --}}

                                                <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                                    data-toggle="modal" data-target="#confirm-delete-modal"
                                                    data-backdrop="static"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @elseif ($item->status == 1)
                                    <tr class="table-primary">
                                        <td style="display: none">{{ $item->room_id }}</td>
                                        <th><b>{{ $loop->iteration }}</b></th>
                                        <td><b>{{ $item->room_name }}</b></td>
                                        <td><b>{{ $item->price }}</b></td>
                                        <td><b>Rented out</b></td>
                                        <td>{{ $item->room_description }}</td>
                                        <td>
                                            <form id="delete-area" action="{{ route('area.delete', $item->room_id) }}"
                                                method="Post">
                                                <a href="{{ route('room.index', $item->room_id) }}" class="btn btn-primary"
                                                    role="button" title="Show details"><i class="fa fa-eye"></i></a>
                                                <a href="javascript:;" data-toggle="modal" data-target="#room-edit"
                                                    class="btn btn-secondary" title="Edit area"><i
                                                        class="fa fa-edit"></i></a>
                                                @csrf
                                                {{-- <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="fa fa-trash"></i></button> --}}

                                                <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                                    data-toggle="modal" data-target="#confirm-delete-modal"
                                                    data-backdrop="static"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add task popup start -->
    <div class="modal fade customscroll" id="room-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
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
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="submit()">Add</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add task popup End -->

    <!-- add task popup start -->
    <div class="modal fade customscroll" id="room-add-multiple" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add multiple rooms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
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
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="multipleSubmit()">Add</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add task popup End -->

    <!-- add task popup start -->
    {{-- <div class="modal fade customscroll" id="room-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update area</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
                                <form name="formUpdateArea" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-4">Area name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="area_name"
                                                id="area_name_edit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Description</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" name="area_description" id="area_description_edit"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="updateArea()">Update</button>
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- add task popup End -->

    {{-- confirm delete popup --}}
    @include('layouts.confirm-popup')

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

        //Show data in edit modal
        var table = document.getElementById("area-table");
        var id = null;
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].addEventListener("click", function() {
                document.getElementById('area_name_edit').value = this.cells[2].innerHTML;
                document.getElementById('area_description_edit').value = this.cells[3].innerHTML;

                document.getElementById('msg-delete').innerHTML = "Are you sure to delete " + this.cells[2]
                    .innerHTML + "?";

                id = this.cells[0].innerHTML;

                document.formUpdateArea.action =
                    "{{ route('area.update', ':id') }}".replace(':id', this.cells[0].innerHTML);

            });
        }

        function actionDelete() {
            document.getElementById('delete-area').action =
                "{{ route('area.delete', ':id') }}".replace(':id', id);
            document.getElementById('delete-area').submit();
        }
    </script>
@endsection
