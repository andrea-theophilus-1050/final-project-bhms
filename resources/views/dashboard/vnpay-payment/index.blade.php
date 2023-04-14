@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Config VNPay payment</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Config VNPay payment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
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
                    </div>
                    @if (auth()->user()->paymentVNPay == null)
                        <div class="pull-right">
                            <a href="javascript:;" data-toggle="modal" data-target="#payment-add"
                                class="btn btn-success btn-sm"><i class="ion-plus-round"></i> Add new method</a>
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="house-table">
                        <thead>
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Payment method</th>
                                <th scope="col">TmnCode</th>
                                <th scope="col">HashSecret</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>VNPay</td>
                                    <td>{{ $payment->vnp_TmnCode }}</td>
                                    <td>{{ $payment->vnp_HashSecret }}</td>
                                    <td>
                                        <button id="edit-payment" data-id="{{ $payment->payment_id }}"
                                            data-vnp_TmnCode="{{ $payment->vnp_TmnCode }}"
                                            data-vnp_HashSecret="{{ $payment->vnp_HashSecret }}" class="btn btn-primary"
                                            role="button" title="Edit"><i class="fa fa-edit"></i></button>

                                        <button id="delete-payment" data-id={{ $payment->payment_id }} type="button"
                                            class="btn btn-danger" role="button" title="Delete">
                                            <i class="fa fa-trash"></i></button>
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

    <!-- SECTION-START: add house popup -->
    <div class="modal fade" id="payment-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add a new payment method</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('payment.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4">vnp_TmnCode</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="vnp_TmnCode" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">vnp_HashSecret</label>
                            <div class="col-md-8">
                                <input class="form-control" name="vnp_HashSecret" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i> &nbsp;
                                Add payment method</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-END: add house popup -->

    <!-- SECTION-START: add house popup -->
    <div class="modal fade" id="payment-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update payment method</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="updatePayment" method="post" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="col-md-4">vnp_TmnCode</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="vnp_TmnCode" id="vnp_TmnCode_edit"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4">vnp_HashSecret</label>
                            <div class="col-md-8">
                                <input class="form-control" name="vnp_HashSecret" id="vnp_HashSecret_edit" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-diskette2"></i>
                                &nbsp; Update payment method</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION-END: add house popup -->

    {{-- SECTION-START: confirm delete popup start --}}
    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center font-18">
                    <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                    </h4>
                    <form id="delete-form" method="post">
                        @csrf
                        @method('DELETE')
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
            // NOTE: passing value to update house modal
            var editPaymentBtn = document.querySelectorAll('#edit-payment');
            editPaymentBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-id');
                    var vnp_TmnCode = e.getAttribute('data-vnp_TmnCode');
                    var vnp_HashSecret = e.getAttribute('data-vnp_HashSecret');

                    var input_vnp_TmnCode = document.querySelector('#vnp_TmnCode_edit');
                    var input_vnp_HashSecret = document.querySelector('#vnp_HashSecret_edit');

                    var formUpdate = document.querySelector('#updatePayment');

                    input_vnp_TmnCode.value = vnp_TmnCode;
                    input_vnp_HashSecret.value = vnp_HashSecret;

                    formUpdate.action = "{{ route('payment.update', ':id') }}".replace(':id',
                        id);

                    $('#payment-edit').modal('show');
                });
            });

            var deletePaymentBtn = document.querySelectorAll('#delete-payment');
            deletePaymentBtn.forEach(function(e) {
                e.addEventListener('click', function() {
                    var id = e.getAttribute('data-id');
                    var formDelete = document.querySelector('#delete-form');
                    formDelete.action = "{{ route('payment.destroy', ':id') }}".replace(':id',
                        id);

                    $('#confirm-delete-modal').modal('show');
                });
            });
        });
    </script>
@endsection
