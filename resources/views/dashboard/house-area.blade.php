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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home', app()->getLocale()) }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navHouse')</li>
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
                        <div class="dropdown">
                            <label style="font-size: 15px; font-weight: bold">Area: </label>
                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                January 2018
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Export List</a>
                                <a class="dropdown-item" href="#">Policies</a>
                                <a class="dropdown-item" href="#">View Assets</a>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Contextual classes</h4>
                    </div>
                    <div class="pull-right">
                        {{-- <a href="{{ route('house.add_new_house', app()->getLocale()) }}" class="btn btn-primary btn-sm"
                            role="button"><i class="fa fa-plus"></i>Add new room</a> --}}

                        <a href="javascript:;" data-toggle="modal" data-target="#house-add"
                            class="btn btn-primary btn-sm"><i class="ion-plus-round"></i> Add new house</a>

                        {{-- <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-minus"></i> Source
                            Code</a>
                        <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-code"></i> Source
                            Code</a>
                        <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-code"></i> Source
                            Code</a> --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">House name</th>
                                <th scope="col">House address</th>
                                <th scope="col">Description</th>
                                <th scope="col">Show Details</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($houses as $house)
                                <tr class="table-light">
                                    <th style="width: 40px">{{ $house->house_id }}</th>
                                    <td>{{ $house->house_name }}</td>
                                    <td>{{ $house->house_address }}</td>
                                    <td>{{ $house->house_description }}</td>
                                    <td>
                                        <a href="{{ route('add-house.action', [app()->getLocale(), $house->house_id]) }}"
                                            class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>
                                    </td>
                                    {{-- update house  --}}
                                    <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#house-edit"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>

                                    {{-- <td><span class="badge badge-success">Success</span></td>
                                    <td><span class="badge badge-success">Success</span></td> --}}
                                </tr>
                            @endforeach

                            {{-- @for ($i = 0; $i <= 4; $i++)
                                <tr class="table-light">
                                    <th style="background-color: red; width: 30px">3</th>
                                    <td style="background-color: red">Larry</td>
                                    <td style="background-color: red">the Bird</td>
                                    <td style="background-color: red">@twitter</td>
                                    <td style="background-color: red"><span class="badge badge-success">Success</span></td>
                                </tr>
                            @endfor --}}
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
                                <form name="formAddHouse" method="post"
                                    action="{{ route('add-house.action', app()->getLocale()) }}">
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
                                <form name="formUpdateHouse" method="post"
                                    action="{{ route('update-house.action', app()->getLocale()) }}">
                                    @csrf
                                    <input type="hidden" id="house_id_edit" name="house_id">
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

    <script>
        function submit() {
            document.formAddHouse.submit();
        }

        function updateHouse() {
            document.formUpdateHouse.submit();
        }

        //Show data in edit modal
        var table = document.getElementById("house-table");
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].addEventListener("click", function() {
                document.getElementById('house_id_edit').value = this.cells[0].innerHTML;
                document.getElementById('house_name_edit').value = this.cells[1].innerHTML;
                document.getElementById('house_address_edit').value = this.cells[2].innerHTML;
                document.getElementById('house_description_edit').value = this.cells[3].innerHTML;
            });
        }
    </script>
@endsection
