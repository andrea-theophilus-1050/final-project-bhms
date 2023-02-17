@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>@lang('messages.navRoom')</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('messages.navHome')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('house.index') }}">House management</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('room.index', $room->house_id) }}">@lang('messages.navRoom')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign tenant</li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="col-md-6 col-sm-12">
                    <div class="dropdown">
                        <form action="" style="display: flex; justify-content: space-between">
                            <input type="text" name="search" placeholder="Room number" class="form-control"
                                style="margin-right: 5%; font-size: 13px">
                            <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                <option value="">Room status</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                            <select class="form-control" name="" style="margin-right: 5%; font-size: 13px">
                                <option value="">Room billed</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                                <option value="">1</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-30">
                <div class="pd-20 card-box">

                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#home" role="tab"
                                    aria-selected="true">Tenant information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#profile" role="tab"
                                    aria-selected="false">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#contact" role="tab"
                                    aria-selected="false">Members</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                <div class="pd-20">
                                    <a href="javascript:;" class="btn btn-primary btn-sm mb-20" data-target="#tenant-list"
                                        data-toggle="modal">Get tenants</a>
                                    <form method="post" action="{{ route('room.assign-tenant-action', $room->room_id) }}">
                                        @csrf

                                        <div class="form-group row">
                                            <input type="hidden" id="tenant_id" name="tenant_id">

                                            <label class="col-sm-12 col-md-2 col-form-label">Full name</label>
                                            <div class="col-sm-6 col-md-4">
                                                <input class="form-control" type="text" placeholder="Full name"
                                                    name="fullname" id="tenant_name">
                                            </div>

                                            <label class="col-sm-12 col-md-2 col-form-label">ID Card Number</label>
                                            <div class="col-sm-6 col-md-4">
                                                <input class="form-control" placeholder="ID Card number" type="text"
                                                    name="id_card" id="tenant_id_card">
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
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control date-picker" placeholder="Date of birth"
                                                    type="text" name="dob" id="dob">
                                            </div>

                                            <label class="col-sm-12 col-md-2 col-form-label">Gender</label>
                                            <div class="col-sm-12 col-md-4">
                                                <div class="d-flex">
                                                    <div class="custom-control custom-radio mb-5 mr-20">
                                                        <input type="radio" id="gender1" name="gender"
                                                            class="custom-control-input" value="Male" checked>
                                                        <label class="custom-control-label weight-400"
                                                            for="gender1">Male</label>
                                                    </div>
                                                    <div class="custom-control custom-radio mb-5">
                                                        <input type="radio" id="gender2" name="gender"
                                                            class="custom-control-input" value="Female">
                                                        <label class="custom-control-label weight-400"
                                                            for="gender2">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control" placeholder="Phone number" type="text"
                                                    name="phone" id="phone_number">
                                            </div>

                                            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control" placeholder="Email" type="text"
                                                    name="email" id="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Hometown</label>
                                            <div class="col-sm-12 col-md-10">
                                                <input class="form-control" placeholder="Hometown address" type="text"
                                                    name="hometown" id="hometown">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Rental room</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control" value="{{ $room->room_name }}" type="text"
                                                    name="room_rental" readonly>
                                            </div>

                                            <label class="col-sm-12 col-md-2 col-form-label">Room price</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control" value="{{ $room->price }}" type="text"
                                                    name="room_price" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-2 col-form-label">Start date</label>
                                            <div class="col-sm-12 col-md-4">
                                                <input class="form-control date-picker" placeholder="Start date"
                                                    type="text" name="start_date">
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
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
                                            </div> --}}
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
                            <div class="tab-pane fade" id="profile" role="tabpanel">
                                <div class="pd-20">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                    in
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel">
                                <div class="pd-20">
                                    <div class="table-responsive">
                                        <div class="pull-right mb-20">
                                            <button class="btn btn-primary" onclick="saveMember()">Save</button>
                                            <button class="btn btn-danger">Cancel</button>
                                        </div>
                                        <form id="room-members" action="{{ route('assign-members') }}" method="POST">
                                            @csrf
                                            <table class="table table-striped" id="tenant-member-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Full name </th>
                                                        <th scope="col">ID Card</th>
                                                        <th scope="col">Data of birth</th>
                                                        <th scope="col">Gender</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Hometown</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    <tr>
                                                        <td>
                                                            <input type='text' class='form-control' name='fullname[]'>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='id_card[]'>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="dob[]">
                                                        </td>
                                                        <td>
                                                            <div class="custom-control custom-radio mb-5 mr-20">
                                                                <input type="radio" id="male" name="gender[0]"
                                                                    class="custom-control-input" value="Male" checked>
                                                                <label class="custom-control-label weight-400"
                                                                    for="male">Male</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mb-5">
                                                                <input type="radio" id="female" name="gender[0]"
                                                                    class="custom-control-input" value="Female">
                                                                <label class="custom-control-label weight-400"
                                                                    for="female">Female</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='phone[]'>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='email[]'>
                                                        </td>
                                                        <td>
                                                            <input type='text' class='form-control' name='hometown[]'>
                                                        </td>
                                                        <td>
                                                            <button type='button' class='btn btn-danger btn-sm'
                                                                onclick='deleteRow(this)'><i
                                                                    class='icon-copy fa fa-minus-circle'
                                                                    aria-hidden='true'></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="7"></td>
                                                        <td>
                                                            <button class="btn btn-success btn-sm" type="button"
                                                                id="add-new-row">
                                                                <i class="icon-copy fa fa-plus-circle"
                                                                    aria-hidden="true"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" id="tenant-list" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">List of Tenants</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="col-md-12 mb-10"
                        style="display: flex; justify-content: space-between; align-items:center">
                        <input type="text" class="form-control col-md-10" placeholder="Search tenant"
                            id="search-tenant">
                        <button class="btn btn-primary btn-sm"><i class="icon-copy dw dw-search">
                            </i> &nbsp;&nbsp;Search
                        </button>
                    </form>

                    {{-- <div class="mb-20">
                        <a href="{{ route('tenant.view.add') }}" class="btn btn-success btn-sm">Add a new tenant</a>
                    </div> --}}
                    {{-- error alert --}}
                    <div class="alert alert-success alert-dismissible fade show" id="alert-error" role="alert"
                        style="display: none">
                        Please select a person
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tenant-list-table">
                            <thead style="white-space: nowrap;">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" hidden>Tenant ID</th>
                                    <th scope="col">Full name </th>
                                    <th scope="col">ID card </th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Hometown</th>
                                    <th scope="col" hidden>Date of birth</th>
                                    <th scope="col" hidden>Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr style="white-space: nowrap;">
                                        <th scope="row">
                                            <form id="room-assign-tenant" action="" method="POST">
                                                @csrf
                                                <input type="checkbox" class="form-control" id="checkboxTenant"
                                                    name="tenant_id" value="{{ $tenant->tenant_id }}">
                                            </form>
                                        </th>
                                        <td hidden>{{ $tenant->tenant_id }}</td>
                                        <td>{{ $tenant->fullname }}</td>
                                        <td>{{ $tenant->id_card }}</td>
                                        <td>{{ $tenant->phone_number }}</td>
                                        <td>{{ $tenant->email }}</td>
                                        <td>{{ $tenant->hometown }}</td>
                                        <td hidden>{{ $tenant->dob }}</td>
                                        <td hidden>{{ $tenant->gender }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="getTenant()">Assign Tenant</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Large modal end-->

    <script>
        // handle click on row in table of List of Tenants
        // checked => hide other row
        // unchecked => show all row
        const tbody = document.querySelector('#tenant-list tbody');
        const rows = tbody.querySelectorAll('#tenant-list tr');
        rows.forEach((row) => {
            row.addEventListener('mouseenter', (event) => {
                event.currentTarget.style.backgroundColor = '#f2f2f2';
                event.currentTarget.style.cursor = 'pointer';
            });

            row.addEventListener('mouseleave', (event) => {
                event.currentTarget.style.backgroundColor = '';
            });

            row.addEventListener('click', (event) => {
                const tableRow = event.currentTarget;
                const checkbox = row.querySelector('#tenant-list #checkboxTenant');

                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    rows.forEach((otherRow) => {
                        if (otherRow !== tableRow) {
                            otherRow.style.display = 'none';
                        }
                    });
                } else {
                    rows.forEach((otherRow) => {
                        otherRow.style.display = '';
                    });
                }
            });
        });

        //Search tenants in table of List of Tenants
        const searchInput = document.querySelector('#tenant-list #search-tenant');
        searchInput.addEventListener('input', (event) => {
            const searchTerm = event.target.value.toLowerCase();

            rows.forEach((row) => {
                const cells = row.querySelectorAll('td');
                let match = false;

                cells.forEach((cell) => {
                    if (cell.textContent.toLowerCase().indexOf(searchTerm) !== -1) {
                        match = true;
                    }
                });

                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            });
        });

        //Get tenant info from table of List of Tenants and assign to form
        function getTenant() {
            const checkbox = document.querySelector('table #checkboxTenant:checked');
            if (checkbox) {

                const row = checkbox.closest('tr');
                const tenantId = row.cells[1].textContent;
                const name = row.cells[2].textContent;
                const idCard = row.cells[3].textContent;
                const phoneNumber = row.cells[4].textContent;
                const email = row.cells[5].textContent;
                const hometown = row.cells[6].textContent;
                const dob = row.cells[7].textContent;
                const gender = row.cells[8].textContent;

                document.getElementById('alert-error').style.display = 'none';

                document.getElementById('tenant_id').value = tenantId;
                document.getElementById('tenant_name').value = name;
                document.getElementById('tenant_id_card').value = idCard;
                document.getElementById('phone_number').value = phoneNumber;
                document.getElementById('dob').value = dob;
                document.getElementById('email').value = email;
                document.getElementById('hometown').value = hometown;

                if (gender === "Male") {
                    document.getElementById('gender1').checked = true;
                } else {
                    document.getElementById('gender2').checked = true;
                }

                $('#tenant-list').modal('hide');
            } else {
                document.getElementById('alert-error').style.display = '';
            }
        }

        //add new row to table button
        const addRowButton = document.getElementById("add-new-row");
        const tableBody = document.getElementById("table-body");
        let clickCount = 0;

        addRowButton.addEventListener("click", function() {
            clickCount++;
            // Create a new row
            const newRow = document.createElement("tr");

            // Create the cells for the new row
            const cell1 = document.createElement("td");
            const cell2 = document.createElement("td");
            const cell3 = document.createElement("td");
            const cell4 = document.createElement("td");
            const cell5 = document.createElement("td");
            const cell6 = document.createElement("td");
            const cell7 = document.createElement("td");
            const cell8 = document.createElement("td");


            // Add content to the cells
            cell1.innerHTML =
                "<input type='text' class='form-control' name='fullname[]'>";
            cell2.innerHTML =
                "<input type='text' class='form-control' name='id_card[]'>";
            cell3.innerHTML =
                "<input class='form-control' type='text' name='dob[]'>";
            cell4.innerHTML =
                "<div class='custom-control custom-radio mb-5 mr-20'>" +
                "<input type='radio' id='male" + clickCount +
                "' name='gender[" + clickCount + "]' class='custom-control-input' value='Male' checked>" +
                "<label class='custom-control-label weight-400' for='male" + clickCount + "'>Male</label>" +
                "</div> <div class='custom-control custom-radio mb-5'>" +
                "<input type='radio' id='female" + clickCount +
                "' name='gender[" + clickCount + "]' class='custom-control-input' value='Female'>" +
                "<label class='custom-control-label weight-400' for='female" + clickCount +
                "'>Female</label> </div>";
            cell5.innerHTML =
                "<input type='text' class='form-control' name='phone[]'>";
            cell6.innerHTML =
                "<input type='text' class='form-control' name='email[]'>";
            cell7.innerHTML =
                "<input type='text' class='form-control' name='hometown[]'>";
            cell8.innerHTML =
                "<button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'><i class='icon-copy fa fa-minus-circle' aria-hidden='true'></i></button>";

            // Append the cells to the new row
            newRow.appendChild(cell1);
            newRow.appendChild(cell2);
            newRow.appendChild(cell3);
            newRow.appendChild(cell4);
            newRow.appendChild(cell5);
            newRow.appendChild(cell6);
            newRow.appendChild(cell7);
            newRow.appendChild(cell8);

            // Append the new row to the table body
            tableBody.appendChild(newRow);

        });

        //delete row in table
        function deleteRow(btn) {
            const row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        function saveMember() {
            const form = document.getElementById('room-members');
            form.submit();
        }
    </script>
@endsection
