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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                <th scope="col">Your response</th>
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
                                    <td style="max-width: 400px">{{ $feedback->response }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-id="{{ $feedback->feedback_id }}"
                                            data-content="{{ $feedback->content }}" id="solve-btn">
                                            <i class="fa fa-info"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-id="{{ $feedback->feedback_id }}"
                                            data-content="{{ $feedback->feedback_id }}" id="delete-fb-btn">
                                            <i class="fa fa-trash"></i>
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

    {{-- SECTION-START: confirm delete popup --}}
    <div class="modal fade" id="solve-feedback-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body font-18">

                    <form id="solve-form" method="post">
                        @csrf
                        <input type="hidden" name="id" id="idFeedback">
                        <div class="form-group mb-3">
                            <label for="feedbackContent">Feedback content</label>
                            <textarea class="form-control mb-10" id="feedbackContent" cols="30" rows="10" readonly></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Type your response</label>
                            <input type="text" class="form-control" name="response">
                        </div>

                        <div class="padding-bottom-30 row text-center" style="max-width: 300px; margin: 0 auto;">
                            <div class="col-6">
                                <button type="submit" name="btnSolve" value="reject"
                                    class="btn btn-danger border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-times"></i></button>
                                Reject
                            </div>
                            <div class="col-6">
                                <button type="submit" name="btnSolve" value="accept"
                                    class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                        class="fa fa-check"></i></button>
                                Accept
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- SECTION-END: confirm delete popup --}}

    {{-- SECTION-START: confirm delete popup start --}}
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="delete-form" method="post">
                        @csrf
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
    {{-- SECTION-END: confirm delete popup end --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //NOTE: passing value to update house modal
            var solveBtn = document.querySelectorAll('#solve-btn');
            solveBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-id');
                    var content = e.getAttribute('data-content');

                    var feedbackContent = document.querySelector('#feedbackContent');
                    feedbackContent.value = content;

                    var idInput = document.querySelector('#idFeedback');
                    idInput.value = id;

                    var form = document.querySelector('#solve-form');
                    form.action = "{{ route('feedback.solve') }}";

                    $('#solve-feedback-modal').modal('show');
                });
            });

            //NOTE: passing value to delete house modal
            var deleteBtn = document.querySelectorAll('#delete-fb-btn');

            deleteBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-id');
                    var content = e.getAttribute('data-content');

                    var msgDeleteConfirm = document.querySelector('#msg-delete-confirm');
                    msgDeleteConfirm.innerHTML = "Are you sure you want to delete this feedback?";

                    var idInput = document.querySelector('#idFeedback');
                    idInput.value = id;

                    var form = document.querySelector('#delete-form');
                    form.action = "{{ route('landlords.feedback.delete', ':id') }}".replace(':id', id);

                    $('#confirm-delete-modal').modal('show');
                });
            });
        });
    </script>
@endsection
