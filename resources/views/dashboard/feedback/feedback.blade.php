@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Feedback management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Feedback management</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h6 class="text-blue h6">
                            @if (session('error'))
                                <div class="alert alert-danger d-flex align-items-center justify-content-center"
                                    role="alert">
                                    <strong>Error! </strong>{{ session('error') }}
                                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Your feedback</th>
                                <th scope="col" class="text-center">Date sent</th>
                                <th scope="col" class="text-center">Sent by</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td style="max-width: 400px">{{ $feedback->content }}</td>
                                    <td class="text-center">{{ $feedback->created_at->format('F d, Y - h:i a') }}</td>
                                    <td class="text-center">
                                        {{ $feedback->tenant->fullname }} -
                                        {{ $feedback->tenant->rentals->rooms->room_name }} 
                                        ({{ $feedback->tenant->rentals->rooms->houses->house_name }})
                                    </td>
                                    <td class="text-center">
                                        @if ($feedback->status == 0)
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                        @elseif($feedback->status == 1)
                                            <span class="badge badge-pill badge-primary">Resolved</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <button id="delete-feedback-btn" type="button"
                                            data-ID="{{ $feedback->feedback_id }}" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></button>
                                        @if ($feedback->status == 0)
                                            <button id="edit-feedback-btn" type="button"
                                                data-ID="{{ $feedback->feedback_id }}"
                                                data-content="{{ $feedback->content }}"
                                                data-anonymous="{{ $feedback->anonymous }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                        @endif --}}
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-info"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
