@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.titleAddRoom')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('home', app()->getLocale()) }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('room', app()->getLocale()) }}">@lang('messages.navRoom')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.titleAddRoom')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix" style="margin-bottom: 2%">
                    <div class="pull-right">
                        {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('messages.btnQuickAdd')</a> --}}
                        <a href="javascript:;" data-toggle="modal" data-target="#task-add" class="btn btn-primary btn-sm"><i
                                class="ion-plus-round"></i> @lang('messages.btnQuickAdd')</a>
                    </div>
                </div>

                <form method="post" action="{{ route('add-house.action', app()->getLocale()) }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">House name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="House name" name="house_name"
                                id="house_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Address</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" placeholder="House address" name="house_address" id="house_address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Description</label>
                        <div class="col-sm-12 col-md-10">
                            <textarea class="form-control" placeholder="House address" name="house_description" id="house_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2"></div>
                        <div class="col-sm-12 col-md-10">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-danger" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
@endsection
