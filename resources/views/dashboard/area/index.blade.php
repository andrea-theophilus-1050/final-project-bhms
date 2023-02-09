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
                        {{-- <h5 class="h4 text-blue mb-20">Default Tab</h5> --}}
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">

                                @foreach ($area as $item)
                                    <li class="nav-item">
                                        <a class="nav-link text-blue" data-toggle="tab" href="#{{ $item->area_id }}"
                                            role="tab" aria-selected="true">{{ $item->area_name }}</a>
                                    </li>
                                @endforeach
                                {{-- <li class="nav-item">
                                    <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab"
                                        aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab"
                                        aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#contact" role="tab"
                                        aria-selected="false">Contact</a>
                                </li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="pd-20">
                                        <div class="row clearfix">
                                            {{-- <div class="col-sm-12 col-md-4 mb-30">
                                                <div class="card card-box">
                                                    <h5 class="card-header weight-500">Featured</h5>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Special title treatment</h5>
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                                    </div>
                                                    <div class="card-footer text-muted">
                                                        2 days ago
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-sm-12 col-md-4 mb-30">
                                                <div class="card card-box">
                                                    <div class="card-header">
                                                        Quote
                                                    </div>
                                                    <div class="card-body">
                                                        <blockquote class="blockquote mb-0">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-sm-12 col-md-3 mb-30">
                                                <div class="card card-box">
                                                    <div class="card-header" {{-- style="background-color: #85c1e9 , #CAE6FA" --}}>
                                                        <i class="icon-copy dw dw-house"></i>
                                                        &nbsp;&nbsp;&nbsp;
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
                                                            <a href="#" class="btn btn-primary btn-sm">
                                                                <i class="icon-copy dw dw-edit"></i>
                                                            </a>
                                                            <a href="#" class="btn btn-danger btn-sm">
                                                                <i class="icon-copy dw dw-trash"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel">
                                    <div class="pd-20">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                        deserunt mollit anim id est laborum.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4">Contextual classes</h4>
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('room.add_new_room') }}" class="btn btn-primary btn-sm" role="button"><i
                                class="fa fa-plus"></i>Add new room</a>
                        <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-minus"></i>
                            Source
                            Code</a>
                        <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-code"></i>
                            Source
                            Code</a>
                        <a href="#" class="btn btn-primary btn-sm" role="button"><i class="fa fa-code"></i>
                            Source
                            Code</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Tag</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i <= 4; $i++)
                                <tr class="table-light">
                                    <th style="background-color: red; width: 30px">3</th>
                                    <td style="background-color: red">Larry</td>
                                    <td style="background-color: red">the Bird</td>
                                    <td style="background-color: red">@twitter</td>
                                    <td style="background-color: red"><span class="badge badge-success">Success</span>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
