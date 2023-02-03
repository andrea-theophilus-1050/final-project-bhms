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
                                        href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('room') }}">@lang('messages.navRoom')</a></li>
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
                        <a href="javascript:;" data-toggle="modal" data-target="#task-add"
                            class="btn btn-primary btn-sm"><i class="ion-plus-round"></i> @lang('messages.btnQuickAdd')</a>
                    </div>
                </div>

                <form>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Room Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="Johnny Brown">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Which area?</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Renting Price</label>
                        <div class=" col-sm-12 col-md-3">
                            <input class="form-control" value="" type="email">
                        </div>
                        <label class="col-sm-12 col-md-2 col-form-label">Renting Price</label>
                        <div class=" col-sm-12 col-md-3">
                            <input class="form-control" value="" type="email">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">URL</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="" type="url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Telephone</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="" type="tel">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="password" type="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-datetime-local-input" class="col-sm-12 col-md-2 col-form-label">Date and
                            time</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control datetimepicker" placeholder="Choose Date anf time" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control date-picker" placeholder="Select Date" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Month</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control month-picker" placeholder="Select Month" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Time</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control time-picker" placeholder="Select time" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Select</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Color</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="#563d7c" type="color">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Input Range</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" value="50" type="range">
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

    <!-- add task popup start -->
    <div class="modal fade customscroll" id="task-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tasks
                        Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-0">
                    <div class="task-list-form">
                        <ul>
                            <li>
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4">Task
                                            Type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Task
                                            Message</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Assigned
                                            to</label>
                                        <div class="col-md-8">
                                            <select class="selectpicker form-control" data-style="btn-outline-primary"
                                                title="Not Chosen" multiple="" data-selected-text-format="count"
                                                data-count-selected-text="{0} people selected">
                                                <option>Ferdinand M.</option>
                                                <option>Don H. Rabon</option>
                                                <option>Ann P. Harris</option>
                                                <option>Katie D. Verdin</option>
                                                <option>Christopher S. Fulghum
                                                </option>
                                                <option>Matthew C. Porter
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-md-4">Due
                                            Date</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control date-picker">
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <a href="javascript:;" class="remove-task" data-toggle="tooltip" data-placement="bottom"
                                    title="" data-original-title="Remove Task"><i
                                        class="ion-minus-circled"></i></a>
                                <form>
                                    <div class="form-group row">
                                        <label class="col-md-4">Task
                                            Type</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Task
                                            Message</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Assigned
                                            to</label>
                                        <div class="col-md-8">
                                            <select class="selectpicker form-control" data-style="btn-outline-primary"
                                                title="Not Chosen" multiple="" data-selected-text-format="count"
                                                data-count-selected-text="{0} people selected">
                                                <option>Ferdinand M.</option>
                                                <option>Don H. Rabon</option>
                                                <option>Ann P. Harris</option>
                                                <option>Katie D. Verdin</option>
                                                <option>Christopher S. Fulghum
                                                </option>
                                                <option>Matthew C. Porter
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-md-4">Due
                                            Date</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control date-picker">
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="add-more-task">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title=""
                            data-original-title="Add Task"><i class="ion-plus-circled"></i> Add More Task</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- add task popup End -->
@endsection
