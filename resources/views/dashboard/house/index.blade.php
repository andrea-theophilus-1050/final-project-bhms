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
                                <th style="display: none" scope="col">House ID</th>
                                <th scope="col">No. </th>
                                <th scope="col">House name</th>
                                <th scope="col">House address</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($houses as $house)
                                <tr {{-- class="table-success" --}}>
                                    <td style="display: none">{{ $house->house_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $house->house_name }}</td>
                                    <td>{{ $house->house_address }}</td>
                                    <td>{{ $house->house_description }}</td>
                                    <td>
                                        <form id="delete-house" action="{{ route('house.destroy', $house->house_id) }}"
                                            method="Post">
                                            <a href="{{ route('room.index', $house->house_id) }}" class="btn btn-primary"
                                                role="button" title="Show details"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#house-edit"
                                                class="btn btn-secondary" title="Edit house"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="fa fa-trash"></i></button> --}}
                                            <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                                data-toggle="modal" data-target="#confirm-delete-modal"
                                                data-backdrop="static"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add task popup start -->
    <div class="modal fade customscroll" id="house-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new house</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
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

    {{-- confirm delete popup --}}
    @include('layouts.confirm-popup')

    <script>
        function submit() {
            document.formAddHouse.submit();
        }

        function updateHouse() {
            document.formUpdateHouse.submit();
        }

        //Show data in edit modal
        var table = document.getElementById("house-table");
        var id = null;

        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].addEventListener("click", function() {
                document.getElementById('house_name_edit').value = this.cells[2].innerHTML;
                document.getElementById('house_address_edit').value = this.cells[3].innerHTML;
                document.getElementById('house_description_edit').value = this.cells[4].innerHTML;
                document.formUpdateHouse.action =
                    "{{ route('house.update', ':id') }}".replace(':id', this.cells[0].innerHTML);

                document.getElementById('msg-delete').innerHTML = "Are you sure to delete " + this.cells[2]
                    .innerHTML + "?";
                id = this.cells[0].innerHTML;
            });
        }

        function actionDelete() {
            document.getElementById('delete-house').action =
                "{{ route('house.destroy', ':id') }}".replace(':id', id);
            document.getElementById('delete-house').submit();
        }
    </script>
@endsection
