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
                                        <input type="checkbox" class="form-control" id="checkboxTenant" name="tenant_id"
                                            value="{{ $tenant->tenant_id }}">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-copy fa fa-close"
                        aria-hidden="true"></i> &nbsp; Close</button>
                <button type="button" class="btn btn-primary" onclick="getTenant()"><i
                        class="icon-copy dw dw-tick"></i> &nbsp; Assign Tenant</button>
            </div>
        </div>
    </div>
</div>
<!-- SECTION-END: tenant list modal -->


<script>
    /*NOTE: handle click on row in table of List of Tenants - checked => hide other row - unchecked => show all row */
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
</script>
