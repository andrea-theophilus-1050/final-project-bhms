document.addEventListener('DOMContentLoaded', function () {

    // NOTE: passing value to delete room confirm modal
    var deleteButtons = document.querySelectorAll('#confirm-delete-modal-btn');
    deleteButtons.forEach(function (e) {
        e.addEventListener('click', function () {
            var roomID = e.getAttribute('data-id');
            var houseID = e.getAttribute('data-houseID');
            var name = e.getAttribute('data-roomName');
            var msg = document.querySelector('#msg-delete-confirm');
            var cardIDInput = document.querySelector(
                '#confirm-delete-modal input[name="id"]');
            var formDelete = document.querySelector('#delete-form');
            formDelete.action = "{{ route('room.delete', ':id') }}".replace(':id',
                houseID);

            msg.innerHTML = 'Are you sure you want to delete room ' + name + '?';
            cardIDInput.value = roomID;
            $('#confirm-delete-modal').modal('show');
        });
    });

    // NOTE: passing value to edit room modal
    var editButtons = document.querySelectorAll('#edit-room-modal-btn');
    editButtons.forEach(function (e) {
        e.addEventListener('click', function () {

            var roomID = e.getAttribute('data-id');
            var roomName = e.getAttribute('data-roomName');
            var roomDescription = e.getAttribute('data-description');
            var price = e.getAttribute('data-price');

            var formUpdate = document.querySelector(
                '#room-edit form[name="formUpdateRoom"]');
            formUpdate.action = "{{ route('room.update', ':id') }}".replace(':id',
                roomID);

            var roomNameInput = document.querySelector(
                '#room-edit input[name="room_name_edit"]');
            var roomDescriptionInput = document.querySelector(
                '#room-edit textarea[name="room_description_edit"]');
            var priceInput = document.querySelector('#room-edit input[name="price_edit"]');

            roomNameInput.value = roomName;
            roomDescriptionInput.value = roomDescription;
            priceInput.value = price;

            $('#room-edit').modal('show');
        });
    });

    // NOTE: passing value to edit house modal
    var editHouseBtn = document.querySelectorAll('#edit-house');
    editHouseBtn.forEach(function (e) {
        e.addEventListener('click', function () {
            var houseID = e.getAttribute('data-houseID');
            var houseName = e.getAttribute('data-houseName');
            var houseAddress = e.getAttribute('data-houseAddress');
            var houseDescription = e.getAttribute('data-houseDescription');

            var inputName = document.querySelector('#house_name_edit');
            var inputAddress = document.querySelector('#house_address_edit');
            var inputDescription = document.querySelector('#house_description_edit');
            var formUpdate = document.querySelector('#formUpdateHouse');

            inputName.value = houseName;
            inputAddress.value = houseAddress;
            inputDescription.value = houseDescription;
            formUpdate.action = "{{ route('house.update', ':id') }}".replace(':id',
                houseID);

            $('#house-edit').modal('show');
        });
    });

    // NOTE: pass value to show-detail-room
    var showDetailRoomBtn = document.querySelectorAll('#show-roomInfo-detail');
    showDetailRoomBtn.forEach(function (e) {
        e.addEventListener('click', function () {
            // NOTE: get from button attribute
            var roomName = e.getAttribute('data-roomName');
            var price = e.getAttribute('data-price');
            var roomStatus = e.getAttribute('data-status');
            var houseName = e.getAttribute('data-houseName');
            var houseAddress = e.getAttribute('data-houseAddress');

            var tenantID = e.getAttribute('data-mainTenantID');
            var fullname = e.getAttribute('data-tenantName');
            var idCard = e.getAttribute('data-idCard');
            var phone = e.getAttribute('data-phoneNumber');
            var email = e.getAttribute('data-email');
            var gender = e.getAttribute('data-gender');
            var dob = e.getAttribute('data-dob');
            var hometown = e.getAttribute('data-hometown');
            var idFrontPhoto = e.getAttribute('data-idFrontPhoto');
            var idBackPhoto = e.getAttribute('data-idBackPhoto');

            // var memberName = e.getAttribute('data-memberName');
            // var memberIDCard = e.getAttribute('data-memberIdCard');
            // var memberPhone = e.getAttribute('data-memberPhoneNumber');
            // var memberEmail = e.getAttribute('data-memberEmail');
            // var memberGender = e.getAttribute('data-memberGender');
            // var memberDOB = e.getAttribute('data-memberDoB');
            // var memberHometown = e.getAttribute('data-memberHometown');



            // NOTE: show members information
            var listMembers = e.getAttribute('data-list-member');
            if (typeof listMembers !== 'undefined' || listMembers !== "") {
                var jsonListMembers = JSON.parse(listMembers);

                const memberContainer = document.querySelector('#memberContainer');
                memberContainer.innerHTML = '';

                jsonListMembers.forEach((member, index) => {
                    const memberList = document.createElement('div');
                    memberList.setAttribute('id', 'membersInfo');

                    memberList.innerHTML =
                        '<div class="row" style="margin-top: 20px">' +
                        '<div class="col-md-6">' +
                        '<p class="font-15"><i class="icon-copy dw dw-list"></i>' +
                        '<strong class="weight-600"> ' +
                        '<u>Member ' +
                        (index + 1) +
                        ':</u>' +
                        '</strong>' +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row pb-30">' +
                        '<div class="col-md-6">' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-user"></i> Fullname:' +
                        '<strong class="weight-600" id="modal_members_fullname">' +
                        member.fullname +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-id-card2"></i> ID card number:' +
                        '<strong class="weight-600" id="modal_members_idCard">' +
                        member.id_card +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-phone-call"></i> Phone number:' +
                        '<strong class="weight-600">' +
                        '<a href="tel:0398371050" style="color: blue" id="modal_members_phone">' +
                        member.phone_number +
                        '</a>' +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:' +
                        '<strong class="weight-600">' +
                        '<a href="mailto:luuhoaiphong147@gmail.com" style="color: blue" id="modal_members_email">' +
                        member.email +
                        '</a>' +
                        '</strong>' +
                        '</p>' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<p class="font-15 mb-5"><i class="icon-copy ion-transgender"></i> Gender:' +
                        '<strong class="weight-600" id="modal_members_gender">' +
                        member.gender +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-calendar-5"></i> Date of birth:' +
                        '<strong class="weight-600" id="modal_members_dob">' +
                        member.dob +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-house-1"></i> Hometown:' +
                        '<strong class="weight-600" id="modal_members_hometown">' +
                        member.hometown +
                        '</strong>' +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row pb-30">' +
                        '<div class="col-md-6">' +
                        '<p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card front photo:</p>' +
                        '<img src="{{ asset(\'avatar/default-image.png \') }}" alt="" width="80%" id="modal_members_front_IDcard">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back photo:</p>' +
                        '<img src="{{ asset(\'avatar/default-image.png \') }}" alt="" width="80%" id="modal_members_back_IDcard">' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="divider" style="background-color: black; height: 1px; width: 100%"></div>' +
                        '</div>' +
                        '</div>';

                    memberContainer.appendChild(memberList);
                });

            }



            //NOTE: get element from modal to show - detail room
            var roomNameModal = document.querySelector('#modal_room_name');
            var priceModal = document.querySelector('#modal_room_price');
            var roomStatusModal = document.querySelector('#modal_room_status');
            var houseNameModal = document.querySelector('#modal_house_name');
            var houseAddressModal = document.querySelector('#modal_house_address');

            // NOTE: get element from modal to show - tenant info
            var tenantNameModal = document.querySelector('#modal_tenant_fullname');
            var tenantIDCardModal = document.querySelector('#modal_tenant_idCard');
            var tenantPhoneModal = document.querySelector('#modal_tenant_phone');
            var tenantEmailModal = document.querySelector('#modal_tenant_email');
            var tenantGenderModal = document.querySelector('#modal_tenant_gender');
            var tenantDOBModal = document.querySelector('#modal_tenant_dob');
            var tenantHometownModal = document.querySelector('#modal_tenant_hometown');
            var idFrontPhotoModal = document.querySelector('#modal_tenant_front_IDcard');
            var idBackPhotoModal = document.querySelector('#modal_tenant_back_IDcard');

            // NOTE: get element from modal to show - member info
            // var mainTenantID = document.querySelector('#main_tenant_id');
            // var memberNameModal = document.querySelector('#modal_members_fullname');
            // var memberIDCardModal = document.querySelector('#modal_members_idCard');
            // var memberPhoneModal = document.querySelector('#modal_members_phone');
            // var memberEmailModal = document.querySelector('#modal_members_email');
            // var memberGenderModal = document.querySelector('#modal_members_gender');
            // var memberDOBModal = document.querySelector('#modal_members_dob');
            // var memberHometownModal = document.querySelector('#modal_members_hometown');



            // NOTE: set value to modal
            // NOTE: set value to Room infomation
            roomNameModal.innerHTML = roomName;
            priceModal.innerHTML = price;
            if (roomStatus == 0) {
                roomStatusModal.className = "badge badge-pill badge-primary";
                roomStatusModal.innerHTML = "Available";
            } else {
                roomStatusModal.className = "badge badge-pill badge-success"
                roomStatusModal.innerHTML = "Occupied";
            }
            houseNameModal.innerHTML = houseName;
            houseAddressModal.innerHTML = houseAddress;

            // NOTE: set value to Tenant infomation
            tenantNameModal.innerHTML = fullname;
            tenantIDCardModal.innerHTML = idCard;
            tenantPhoneModal.innerHTML = phone;
            tenantEmailModal.innerHTML = email;
            tenantGenderModal.innerHTML = gender;
            tenantDOBModal.innerHTML = dob;
            tenantHometownModal.innerHTML = hometown;

            tenantPhoneModal.href = "tel:" + phone;
            tenantEmailModal.href = "mailto:" + email;

            // NOTE: set src image ID Card front to tenant infomation
            idFrontPhotoModal.src =
                `{{ asset('uploads/tenants/id_card_front/${idFrontPhoto}') }}`;
            // NOTE: set src image ID Card back to tenant infomation
            idBackPhotoModal.src =
                `{{ asset('uploads/tenants/id_card_back/${idBackPhoto}') }}`;

            // NOTE: set value to Member infomation
            // memberNameModal.innerHTML = memberName;
            // memberIDCardModal.innerHTML = memberIDCard;
            // memberPhoneModal.innerHTML = memberPhone;
            // memberEmailModal.innerHTML = memberEmail;
            // memberGenderModal.innerHTML = memberGender;
            // memberDOBModal.innerHTML = memberDOB;
            // memberHometownModal.innerHTML = memberHometown;


            // NOTE: show/hide member section if tenantID is null ot not null
            // if (tenantID == "") {
            //     document.getElementById('roomMembersSection').style.display = 'none';
            // } else {
            //     document.getElementById('roomMembersSection').style.display = '';
            //     mainTenantID.value = tenantID;
            // }

            // NOTE: show modal
            $('#show-detail-room-modal').modal('show');
        });
    });

});

// function assignTenantSubmit() {
//     const tenantForm = document.querySelector('#room-assign-tenant');
//     tenantForm.submit();
// }

// Format number input with commas as thousands separators
const numberInput = document.querySelector("#room-add #price");
const numberInputMultiple = document.querySelector("#room-add-multiple #price");
const numberInputEdit = document.querySelector("#room-edit #price_edit");


// Add event listener for when input value changes
numberInput.addEventListener("input", formatNumber);
numberInputMultiple.addEventListener("input", formatNumber);
numberInputEdit.addEventListener("input", formatNumber);

function formatNumber() {

    if (this.value.length === 0) return;
    // Get the input value and remove any non-numeric characters except for the decimal point
    let input = this.value.replace(/[^0-9.]/g, "");

    // Parse the input as a float and format it with commas as thousands separators
    let formatted = parseFloat(input).toLocaleString();

    // Update the input value with the formatted value
    this.value = formatted;
}




//NOTE: add new row to table button
const addRowButton = document.getElementById("add-new-row");
const tableBody = document.getElementById("table-body");
let clickCount = 0;

addRowButton.addEventListener("click", function () {
    clickCount++;
    // NOTE: Create a new row
    const newRow = document.createElement("tr");

    // NOTE: Create the cells for the new row
    const cell1 = document.createElement("td");
    const cell2 = document.createElement("td");
    const cell3 = document.createElement("td");
    const cell4 = document.createElement("td");
    const cell5 = document.createElement("td");
    const cell6 = document.createElement("td");
    const cell7 = document.createElement("td");
    const cell8 = document.createElement("td");
    const cell9 = document.createElement("td");
    const cell10 = document.createElement("td");

    cell1.style.position = "sticky";
    cell1.style.left = "0";
    cell1.style.backgroundColor = "white";
    cell1.style.zIndex = "1";


    // NOTE: Add content to the cells
    cell1.innerHTML =
        "<button type='button' class='btn btn-danger btn-sm' onclick='deleteRow(this)'><i class='icon-copy fa fa-minus-circle' aria-hidden='true'></i></button>";
    cell2.innerHTML = "<input type='text' class='form-control' name='fullname[]' style='width: 200px'>";
    cell3.innerHTML = "<input type='text' class='form-control' name='id_card[]' style='width: 200px'>";
    cell4.innerHTML = "<input class='form-control' type='text' name='dob[]' style='width: 100px'>";
    cell5.innerHTML =
        "<div class='custom-control custom-radio mb-5 mr-20'>" +
        "<input type='radio' id='male" + clickCount +
        "' name='gender[" + clickCount + "]' class='custom-control-input' value='Male' checked>" +
        "<label class='custom-control-label weight-400' for='male" + clickCount + "'>Male</label>" +
        "</div> <div class='custom-control custom-radio mb-5'>" +
        "<input type='radio' id='female" + clickCount +
        "' name='gender[" + clickCount + "]' class='custom-control-input' value='Female'>" +
        "<label class='custom-control-label weight-400' for='female" + clickCount +
        "'>Female</label> </div>";
    cell6.innerHTML = "<input type='text' class='form-control' name='phone[]' style='width: 200px'>";
    cell7.innerHTML = "<input type='text' class='form-control' name='email[]' style='width: 200px'>";
    cell8.innerHTML = "<input type='text' class='form-control' name='hometown[]' style='width: 200px'>";
    cell9.innerHTML = "<input type='file' class='form-control' name='idcard_front[]' style='width: 200px'>";
    cell10.innerHTML = "<input type='file' class='form-control' name='idcard_back[]' style='width: 200px'>";
    // NOTE: Append the cells to the new row
    newRow.appendChild(cell1);
    newRow.appendChild(cell2);
    newRow.appendChild(cell3);
    newRow.appendChild(cell4);
    newRow.appendChild(cell5);
    newRow.appendChild(cell6);
    newRow.appendChild(cell7);
    newRow.appendChild(cell8);
    newRow.appendChild(cell9);
    newRow.appendChild(cell10);

    // NOTE: Append the new row to the table body
    tableBody.appendChild(newRow);

});

// NOTE: delete row in table
function deleteRow(btn) {
    const row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function submitForm() {
    document.getElementById("room-members").submit();
}
