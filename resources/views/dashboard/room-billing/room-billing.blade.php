@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Room billing</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Room billing</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <form method="POST" action="">
                @csrf
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="dropdown d-flex justify-content-space-between align-items-center">
                                <input type="text" class="form-control month-picker mr-3 col-md-3"
                                    placeholder="Month picker" value="{{ now()->format('F Y') }}" name="month-filter">
                                <select class="form-control font-13 mr-3 col-md-3" name="house-filter">
                                    <option value="0" selected>All houses</option>
                                    @foreach ($houseList as $house)
                                        <option value="{{ $house->house_id }}">{{ $house->house_name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary col-md-3">
                                    <i class="fa fa-calculator mr-2"></i>Calculate Room Billing
                                </button>

                            </div>
                            {{-- <div class="dropdown">
                                <label style="font-size: 15px; font-weight: bold">Area: </label>
                                <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown">
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
            </form>
        </div>
    </div>
@endsection
