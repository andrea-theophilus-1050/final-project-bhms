@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Tenants management</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tenants management</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4"></h4>
                    </div>
                    <div class="pull-right">
                        {{-- <a id="test" href="javascript:;" data-toggle="modal" data-target="#tenant-add"
                            class="btn btn-success btn-sm"><i class="ion-plus-round"></i> Add new tenant</a> --}}
                        <a href="{{ route('tenant.create') }}" class="btn btn-success btn-sm"><i class="ion-plus-round"></i>
                            Add new tenant</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped hover" id="tenant-table">
                        <thead style="white-space: nowrap;">
                            <tr>
                                <th scope="col"></th>
                                <th hidden scope="col">Tenant ID</th>
                                <th scope="col">No. </th>
                                <th scope="col">Full name</th>
                                <th scope="col">ID Card</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Date of Birth</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Hometown</th>
                                <th scope="col">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr style="white-space: nowrap">
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a href="#" class="dropdown-item"><i class="dw dw-eye"></i>
                                                    View</a>
                                                <a href="{{ route('tenant.edit', $tenant->tenant_id) }}"
                                                    class="dropdown-item" title="Edit tenant"><i class="dw dw-edit2"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" type="button" id="confirm-delete-modal-btn"
                                                    data-toggle="modal" data-target="#confirm-delete-modal"
                                                    data-tenantID="{{ $tenant->tenant_id }}"
                                                    data-tenantName="{{ $tenant->fullname }}" data-backdrop="static"><i
                                                        class="dw dw-delete-3"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td hidden>{{ $tenant->tenant_id }}</td>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $tenant->fullname }}</td>
                                    <td>{{ $tenant->id_card }}</td>
                                    <td>{{ $tenant->gender }}</td>
                                    <td>{{ $tenant->dob }}</td>
                                    <td style="white-space: nowrap;"><a href="tel:{{ $tenant->phone_number }}"><i
                                                class="icon-copy dw dw-phone-call"></i> {{ $tenant->phone_number }}</a>
                                    </td>
                                    <td style="white-space: nowrap;"><a href="mailto:{{ $tenant->email }}"><i
                                                class="icon-copy dw dw-email1"></i> {{ $tenant->email }}</a></td>
                                    <td>{{ $tenant->hometown }}</td>
                                    <td>
                                        @if ($tenant->status != 0)
                                            <span class="badge badge-pill badge-success">Rented</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Not Rented</span>
                                        @endif
                                    </td>

                                    {{-- <td>
                                        <form id="delete-area" 
                                            method="Post">
                                            <a href=""
                                                class="btn btn-primary" role="button" title="Show details"><i
                                                    class="fa fa-eye"></i></a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#area-edit"
                                                class="btn btn-secondary" title="Edit area"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete?')"><i
                                                    class="fa fa-trash"></i></button>

                                            <button class="btn btn-danger" type="button" id="confirm-delete-modal-btn"
                                                data-toggle="modal" data-target="#confirm-delete-modal"
                                                data-backdrop="static"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pull-right">
                        {{-- pagination --}}
                        {{ $tenants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- add task popup start -->
    <div class="modal fade bs-example-modal-lg" id="tenant-add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add new tenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="task-list-form">
                        <form name="formAddTenant" method="post" action="{{ route('tenant.add') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4">Full name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="fullname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Gender</label>
                                <div class="col-md-8">
                                    <div class="d-flex">
                                        <div class="custom-control custom-radio mb-5 mr-20">
                                            <input type="radio" id="gender1" name="gender"
                                                class="custom-control-input" value="Male" checked>
                                            <label class="custom-control-label weight-400" for="gender1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="gender2" name="gender"
                                                class="custom-control-input" value="Female">
                                            <label class="custom-control-label weight-400" for="gender2">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Date of birth</label>
                                <div class="col-md-8">
                                    <input class="form-control date-picker" name="dob" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">ID Card Number</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="id_card">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Phone number</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Hometown</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="hometown">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- add task popup End --> --}}

    {{-- <!-- add task popup start -->
    <div class="modal fade" id="tenant-edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update tenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip"
                        data-placement="bottom" title="" data-original-title="Close Modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="task-list-form">

                        <form name="formUpdateTenant" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4">Full name</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tenant_name" id="tenant_name_edit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">ID Card</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tenant_name" id="tenant_name_edit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Gender</label>
                                <div class="col-sm-12 col-md-8">
                                    <div class="d-flex">
                                        <div class="custom-control custom-radio mb-5 mr-20">
                                            <input type="radio" id="gender1" name="gender"
                                                class="custom-control-input" value="Male" checked>
                                            <label class="custom-control-label weight-400" for="gender1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-5">
                                            <input type="radio" id="gender2" name="gender"
                                                class="custom-control-input" value="Female">
                                            <label class="custom-control-label weight-400" for="gender2">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Date of birth</label>
                                <div class="col-sm-12 col-md-8">
                                    <input class="form-control date-picker" type="text" name="dob">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Phone number</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tenant_name" id="tenant_name_edit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Email</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="tenant_name" id="tenant_name_edit">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4">Hometown</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="tenant_description" id="tenant_description_edit"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" onclick="updateTenant()">Update</button>
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- add task popup End --> --}}

    {{-- SECTION-START: confirm delete popup --}}
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
    {{-- SECTION-END: confirm delete popup --}}

    <script>
        //NOTE: passing value to delete room confirm modal
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('#confirm-delete-modal-btn');
            deleteButtons.forEach(function(e) {
                e.addEventListener('click', function() {
                    var tenantID = e.getAttribute('data-tenantID');
                    var name = e.getAttribute('data-tenantName');
                    var msg = document.querySelector('#msg-delete-confirm');

                    var formDelete = document.querySelector('#delete-form');
                    formDelete.action = "{{ route('tenant.destroy', ':id') }}".replace(':id',
                        tenantID);

                    msg.innerHTML = 'Are you sure you want to delete "' + name + '"?';

                    $('#confirm-delete-modal').modal('show');
                });
            });
        });
    </script>
@endsection
