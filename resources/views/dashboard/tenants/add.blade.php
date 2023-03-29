@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>@lang('messages.navAddTenant')</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        href="{{ route('tenant.index') }}">@lang('messages.navTenant')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('messages.navAddTenant')</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <form method="post" action="{{ route('tenant.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" placeholder="Full name" name="fullname"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Full name'">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Which area?</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12">
                                <option selected="">Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Date of birth</label>
                        <div class="col-sm-12 col-md-5">
                            <input class="form-control date-picker" placeholder="Date of birth" type="text"
                                name="dob" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of birth'">
                        </div>

                        <label class="col-sm-12 col-md-1 col-form-label">Gender</label>
                        <div class="col-sm-12 col-md-3">
                            <div class="d-flex">
                                <div class="custom-control custom-radio mb-5 mr-20">
                                    <input type="radio" id="gender1" name="gender" class="custom-control-input"
                                        value="Male" checked>
                                    <label class="custom-control-label weight-400" for="gender1">Male</label>
                                </div>
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="gender2" name="gender" class="custom-control-input"
                                        value="Female">
                                    <label class="custom-control-label weight-400" for="gender2">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="ID Card number" type="text" name="id_card"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'ID Card number'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Phone number" type="text" name="phone"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Email address" type="text" name="email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" placeholder="Hometown" type="text" name="hometown"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Hometowm'">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">ID Card front photo</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="file" name="id_card_front" id="id_card_front"
                                onchange="previewImage(id_card_front, preview_id_card_front)" accept="image/*">
                            <img src="" id="preview_id_card_front" alt=""
                                width="40%" style="margin-top: 10px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">ID Card front photo</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="file" name="id_card_back" id="id_card_back"
                                onchange="previewImage(id_card_back, preview_id_card_back)" accept="image/*">
                            <img src="" id="preview_id_card_back" alt=""
                                width="40%" style="margin-top: 10px">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-2"></div>
                        <div class="col-sm-12 col-md-10">
                            <button class="btn btn-primary" type="submit"><i class="icon-copy dw dw-diskette2"></i> &nbsp; Submit</button>
                            <a href="{{ route('tenant.index') }}" class="btn btn-danger"><i class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <script>
        // NOTE: Preview image before upload (id_card_front, id_card_back)
        function previewImage(input, preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
