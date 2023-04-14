@extends('layouts.main')
@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Add costs incurred</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('costs-incurred') }}">Add costs incurred</a></li>
                            <li class="breadcrumb-item active">Add costs incurred</li>
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
                    <button class="btn btn-secondary btn-sm mb-20" data-target="#tenant-list" data-toggle="modal"><i
                            class="icon-copy dw dw-list"></i> &nbsp; Get
                        information</button>
                </div>
            </div>
            <form id="Form_CostsIncurred" method="post" action="{{ route('add.costs-incurred.action') }}">
                @csrf
                {{-- alert --}}
                @if ($errors->any())
                    <div class="form-group row ml-1">
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
                    </div>
                @endif

                <input type="hidden" name="rental_room_id" id="rental_room_id">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Month/Year</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control month-picker" placeholder="Month/Year" type="text" id="month_year"
                            name="month_year" required>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">House name</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" type="text" id="house_name" name="house_name" readonly required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Price</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="price" id="price" placeholder="Price"
                            required>
                    </div>
                    <label class="col-sm-12 col-md-2 col-form-label">Room name</label>
                    <div class="col-sm-12 col-md-4">
                        <input class="form-control" type="text" id="room_name" name="room_name" readonly required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Reason for this cost incurred</label>
                    <div class="col-sm-6 col-md-4">
                        <textarea class="form-control" name="reason" id="reason" placeholder="Reason for this cost incurred" required></textarea>
                    </div>

                    <label class="col-sm-12 col-md-2 col-form-label">Tenant name</label>
                    <div class="col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="tenant_name" id="tenant_name" readonly required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-2"></div>
                    <div class="col-sm-12 col-md-10">
                        <button class="btn btn-primary" type="submit"><i class="icon-copy dw dw-diskette2"></i> &nbsp;
                            Save</button>
                        <a href="{{ route('costs-incurred', ['month' => now()->format('F Y')]) }}" class="btn btn-danger"><i
                                class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- SECTION-START: tenant list modal -->
    <div class="modal fade bs-example-modal-lg" id="tenant-list" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">List of Tenants</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <input type="text" class="form-control col-md-12" placeholder="Search tenant" id="search-tenant">
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
                                    <th scope="col" hidden>Rental room ID</th>
                                    <th scope="col">House name </th>
                                    <th scope="col">Room name </th>
                                    <th scope="col">Tenant name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataList as $data)
                                    <tr style="white-space: nowrap;">
                                        <th scope="row">
                                            <input type="checkbox" class="form-control" id="checkboxTenant"
                                                name="tenant_id" value="{{ $data->tenant_id }}" style="width: 20px">
                                        </th>
                                        <td hidden>{{ $data->rental_room_id }}</td>
                                        <td>{{ $data->house_name }}</td>
                                        <td>{{ $data->room_name }}</td>
                                        <td>{{ $data->fullname }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="icon-copy fa fa-close" aria-hidden="true"></i> &nbsp; Close</button>
                    <button type="button" class="btn btn-primary" onclick="getTenant()"><i
                            class="icon-copy dw dw-tick"></i> &nbsp; Assign Tenant</button>
                </div>
            </div>
        </div>
    </div>
    <!-- SECTION-END: tenant list modal -->

    <script>
        //NOTE: handle click on row in table of List of Tenants
        //- checked => hide other row
        //- unchecked => show all row 
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

        //NOTE: Search tenants in table of List of Tenants
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

        //NOTE: Get tenant info from table of List of Tenants and assign to form
        function getTenant() {
            const checkbox = document.querySelector('table #checkboxTenant:checked');
            if (checkbox) {
                const row = checkbox.closest('tr');

                const rentalID = row.cells[1].textContent;
                const houseName = row.cells[2].textContent;
                const roomName = row.cells[3].textContent;
                const tenantName = row.cells[4].textContent;

                document.getElementById('alert-error').style.display = 'none';

                // document.getElementById('tenant_id').value = tenantId;
                document.getElementById('rental_room_id').value = rentalID;
                document.getElementById('tenant_name').value = tenantName;
                document.getElementById('house_name').value = houseName;
                document.getElementById('room_name').value = roomName;

                $('#tenant-list').modal('hide');
            } else {
                document.getElementById('alert-error').style.display = '';
            }
        }

        function submitForm() {
            document.getElementById('Form_CostsIncurred').submit();
        }

        // Format number input with commas as thousands separators
        const numberInput = document.querySelector("#price");
        // Add event listener for when input value changes
        numberInput.addEventListener("input", formatNumber);

        function formatNumber() {

            if (this.value.length === 0) return;
            // Get the input value and remove any non-numeric characters except for the decimal point
            let input = this.value.replace(/[^0-9.]/g, "");

            // Parse the input as a float and format it with commas as thousands separators
            let formatted = parseFloat(input).toLocaleString();

            // Update the input value with the formatted value
            this.value = formatted;
        }
    </script>
@endsection
