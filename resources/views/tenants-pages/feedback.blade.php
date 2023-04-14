@extends('tenants-pages.layouts.tenant-layout')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Your feedback management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Your feedback management</li>
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
                    <div class="pull-right">
                        <a href="javascript:;" data-toggle="modal" data-target="#send-feedback-modal"
                            class="btn btn-success btn-sm"><i class="dw dw-paper-plane"></i> Send feedback</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        {{-- alert --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show col-md-7" role="alert">
                                <ul style="list-style-type:circle">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Your feedback</th>
                                <th scope="col" class="text-center">Date sent</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col">Response</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td style="max-width: 400px">{{ $feedback->content }}</td>
                                    <td class="text-center">{{ $feedback->created_at->format('F d, Y - h:i a') }}</td>
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
                                        {{ $feedback->response }}
                                    </td>
                                    <td>
                                        <button id="delete-feedback-btn" type="button"
                                            data-ID="{{ $feedback->feedback_id }}" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></button>
                                        @if ($feedback->status == 0)
                                            <button id="edit-feedback-btn" type="button"
                                                data-ID="{{ $feedback->feedback_id }}"
                                                data-content="{{ $feedback->content }}" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-edit"></i></button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-START: add new service popup -->
    <div class="modal fade" id="send-feedback-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Send feedback</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('role.tenants.send.feedback') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Your feedback</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="contentFeedback" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="icon-copy dw dw-paper-plane"></i>&nbsp;&nbsp;Send</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-END: add service popup -->


    <!-- SECTION-START: add new service popup -->
    <div class="modal fade" id="update-feedback-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update feedback</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('role.tenants.send.feedback') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">Your feedback</label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="contentFeedback" id="contentFeedback_edit" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i
                                    class="icon-copy dw dw-paper-plane"></i>&nbsp;&nbsp;Send</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-END: add service popup -->

    {{-- SECTION-START: confirm delete popup --}}
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
    {{-- SECTION-END: confirm delete popup --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //NOTE: passing value to update house modal
            var editFeedbackBtn = document.querySelectorAll('#edit-feedback-btn');
            editFeedbackBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-ID');
                    var content = e.getAttribute('data-content');

                    var contentInput = document.querySelector('#contentFeedback_edit');
                    var formUpdate = document.querySelector('#update-feedback-modal form');

                    contentInput.value = content;

                    formUpdate.action = "{{ route('role.tenants.update.feedback', ':id') }}"
                        .replace(':id', id);

                    $('#update-feedback-modal').modal('show');
                });
            });

            var deleteFeedbackBtn = document.querySelectorAll('#delete-feedback-btn');
            deleteFeedbackBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-ID');
                    var formDelete = document.querySelector('#confirm-delete-modal form');
                    formDelete.action = "{{ route('role.tenants.delete.feedback', ':id') }}"
                        .replace(':id', id);
                    $('#confirm-delete-modal').modal('show');
                });
            });
        });
    </script>
@endsection
