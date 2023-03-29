@extends('tenants-pages.layouts.tenant-layout')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="pd-20 card-box mb-30">
                <div class="modal-body text-center font-18">
                    <h4 class="mb-20">
                        @if ($secureHash == $vnp_SecureHash)
                            @if ($responseCode == '00')
                                Payment success!
                            @else
                                Payment failed!
                            @endif
                        @else
                            Payment failed!
                        @endif
                    </h4>
                    <div class="mb-30 text-center">
                        @if ($secureHash == $vnp_SecureHash)
                            @if ($responseCode == '00')
                                <img src="{{ asset('vendors/images/success.png') }}">
                            @else
                                <img src="{{ asset('vendors/images/caution-sign.png') }}">
                            @endif
                        @else
                            <img src="{{ asset('vendors/images/caution-sign.png') }}">
                        @endif

                    </div>
                </div>
                <div class="table-responsive d-flex justify-content-center align-items-center">
                    <table class="table table-bordered table-sm col-8">
                        <tbody>
                            <tr>
                                <td scope="col" class="col-5"><strong>Bill ID:</strong> {{ $billID }}</td>
                                <td scope="col" class="col-7"><strong>Total Price:</strong>
                                    {{ number_format($totalPrice, 0, ',', ',') }} </td>
                            </tr>
                            <tr>
                                <td scope="col" class="col-5"><strong>Response code:</strong> {{ $responseCode }}</td>
                                <td scope="col" class="col-7"><strong>Payment description:</strong> {{ $paymentDesc }}
                                </td>
                            </tr>
                            <tr>
                                <td scope="col" class="col-5"><strong>Transaction no:</strong> {{ $transactionNo }}</td>
                                <td scope="col" class="col-7"><strong>Pay date:</strong> {{ $paymentTime }}</td>
                            </tr>
                            <tr>
                                <td scope="col" class="col-5"><strong>Banking code:</strong> <?php echo $_GET['vnp_BankCode']; ?></td>
                                <td scope="col" class="col-7"><strong>Result:</strong>
                                    @if ($secureHash == $vnp_SecureHash)
                                        @if ($responseCode == '00')
                                            <span class="badge badge-pill badge-success"
                                                style="width: 100px; font-size: 15px">Success</span>
                                        @else
                                            <span class="badge badge-pill badge-warning"
                                                style="width: 100px; font-size: 15px">Failed</span>
                                        @endif
                                    @else
                                        <span class="badge badge-pill badge-warning"
                                            style="width: 100px; font-size: 15px">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-center">
                    @if ($secureHash == $vnp_SecureHash)
                        @if ($responseCode == '00')
                            <form id="updateStatus" method="POST" action="{{ route('payment.update-bill-status') }}">
                                @csrf
                                <input type="hidden" value="{{ $billID }}" name="billID">
                                <input type="hidden" value="{{ $totalPrice }}" name="paidAmount">
                                <button type="submit" class="btn btn-primary">Click here to complete the payment</button>
                            </form>
                        @else
                            <a href="{{ route('role.tenants.index') }}" class="btn btn-danger">Back to home</a>
                        @endif
                    @else
                        <a href="{{ route('role.tenants.index') }}" class="btn btn-danger">Back to home</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
          document.getElementById("updateStatus").submit();
        });
      </script> --}}

@endsection
