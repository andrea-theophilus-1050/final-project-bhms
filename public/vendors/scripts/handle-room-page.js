document.addEventListener('DOMContentLoaded', function () {
    // NOTE: pass value to show-detail-room
    var showDetailRoomBtn = document.querySelectorAll('#show-roomInfo-detail');
    showDetailRoomBtn.forEach(function (e) {
        e.addEventListener('click', function () {
            //NOTE: get base url
            var baseURL = window.location.origin;

            // NOTE: get room information from button attribute
            var roomID = e.getAttribute('data-roomID');
            var roomName = e.getAttribute('data-roomName');
            var price = e.getAttribute('data-price');
            var roomStatus = e.getAttribute('data-status');
            var houseName = e.getAttribute('data-houseName');
            var houseAddress = e.getAttribute('data-houseAddress');

            //NOTE: get element from modal to show - detail room
            var roomNameModal = document.querySelector('#modal_room_name');
            var priceModal = document.querySelector('#modal_room_price');
            var roomStatusModal = document.querySelector('#modal_room_status');
            var houseNameModal = document.querySelector('#modal_house_name');
            var houseAddressModal = document.querySelector('#modal_house_address');

            // NOTE: set value to modal
            // NOTE: set value to Room infomation
            roomNameModal.innerHTML = roomName;
            priceModal.innerHTML = price;
            if (roomStatus == 0) {
                roomStatusModal.className = "badge badge-pill badge-primary";
                roomStatusModal.innerHTML = "Available";
                document.getElementById('assignTenant').style.display = "";
                document.getElementById('assignTenant').href = baseURL + "/landlords/dashboard/house/room/" + roomID + "/assignTenant";
            } else {
                roomStatusModal.className = "badge badge-pill badge-success"
                roomStatusModal.innerHTML = "Occupied";
                document.getElementById('assignTenant').style.display = "none";
            }
            houseNameModal.innerHTML = houseName;
            houseAddressModal.innerHTML = houseAddress;

            // NOTE: set default value to tenant information
            var tenantID, fullname, idCard, phone, email, gender, dob, hometown,
                idFrontPhoto, idBackPhoto;

            tenantID = fullname = idCard = phone = email = gender = dob = hometown =
                idFrontPhoto = idBackPhoto = "";

            //NOTE: if room is occupied, get tenant information
            if (roomStatus == 1) {
                // NOTE: get tenant information from button attribute
                tenantID = e.getAttribute('data-mainTenantID');
                fullname = e.getAttribute('data-tenantName');
                idCard = e.getAttribute('data-idCard');
                phone = e.getAttribute('data-phoneNumber');
                email = e.getAttribute('data-email');
                gender = e.getAttribute('data-gender');
                dob = e.getAttribute('data-dob');
                hometown = e.getAttribute('data-hometown');
                idFrontPhoto = e.getAttribute('data-idFrontPhoto');
                idBackPhoto = e.getAttribute('data-idBackPhoto');
            }

            // NOTE: get element from modal to show - tenant info
            var tenantNameModal = document.querySelector('#modal_tenant_fullname');
            var tenantIDCardModal = document.querySelector('#modal_tenant_idCard');
            var tenantPhoneModal = document.querySelector('#modal_tenant_phone');
            var tenantEmailModal = document.querySelector('#modal_tenant_email');
            var tenantGenderModal = document.querySelector('#modal_tenant_gender');
            var tenantDOBModal = document.querySelector('#modal_tenant_dob');
            var tenantHometownModal = document.querySelector('#modal_tenant_hometown');
            var idFrontPhotoModal = document.querySelector(
                '#modal_tenant_front_IDcard');
            var idBackPhotoModal = document.querySelector('#modal_tenant_back_IDcard');

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

            // NOTE: set src image ID Card front/back to tenant infomation
            idFrontPhotoModal.src = idFrontPhoto != "" ?
                baseURL + "/uploads/tenants/id_card_front/" + idFrontPhoto :
                baseURL + "/avatar/default-image.png";
            idBackPhotoModal.src = idBackPhoto != "" ?
                baseURL + "/uploads/tenants/id_card_back/" + idBackPhoto :
                baseURL + "/avatar/default-image.png";

            // NOTE: show/hide member, service used section if tenantID is null ot not null
            if (tenantID == "") {
                document.getElementById('roomMembersSection').style.display = 'none';
                document.getElementById('serviceUsed').style.display = 'none';
            } else {
                document.getElementById('roomMembersSection').style.display = '';
                document.getElementById('serviceUsed').style.display = '';

                // NOTE: section for service used
                const table = document.querySelector('#service-used-table tbody');
                table.innerHTML = '';
                var serviceUsed = e.getAttribute('data-service-used');
                const jsonServiceUsed = Object.values(JSON.parse(serviceUsed));
                jsonServiceUsed.forEach((service, index) => {
                    const newRow = table.insertRow();

                    const cell1 = newRow.insertCell(0);
                    const cell2 = newRow.insertCell(1);
                    const cell3 = newRow.insertCell(2);
                    const cell4 = newRow.insertCell(3);

                    cell1.innerHTML = index + 1;
                    cell2.innerHTML = service.type_name;
                    cell3.innerHTML = service.service_name;
                    cell4.innerHTML = service.price_if_changed;
                });


                // NOTE: section for members information
                var mainTenantID = document.querySelector('#main_tenant_id');
                mainTenantID.value = tenantID;

                const memberContainer = document.querySelector('#memberContainer');
                memberContainer.innerHTML = '';

                // NOTE: show members information
                var listMembers = e.getAttribute('data-list-member');
                var jsonListMembers = JSON.parse(listMembers);

                // console.log(jsonListMembers);

                jsonListMembers.forEach((member, index) => {
                    const memberList = document.createElement('div');
                    memberList.setAttribute('id', 'membersInfo');
                    var srcIDCardFrontPhoto = member.citizen_card_front_image != null ? baseURL + '/uploads/members/id_card_front/' + member.citizen_card_front_image : baseURL + '/avatar/default-image.png';
                    var srcIDCardBackPhoto = member.citizen_card_back_image != null ? baseURL + '/uploads/members/id_card_back/' + member.citizen_card_back_image : baseURL + '/avatar/default-image.png';

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
                        '<a href="tel:' + member.phone_number +
                        '" style="color: blue" id="modal_members_phone">' +
                        member.phone_number +
                        '</a>' +
                        '</strong>' +
                        '</p>' +
                        '<p class="font-15 mb-5"><i class="icon-copy dw dw-email1"></i> Email:' +
                        '<strong class="weight-600">' +
                        '<a href="mailto:' + member.email +
                        '" style="color: blue" id="modal_members_email">' +
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
                        '<img src="' + srcIDCardFrontPhoto + '" alt="" width="80%" id="modal_members_front_IDcard">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<p class="font-14 mb-5"><i class="icon-copy dw dw-image1"></i> ID Card back photo:</p>' +
                        '<img src="' + srcIDCardBackPhoto + '" alt="" width="80%" id="modal_members_back_IDcard">' +
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

            // NOTE: show modal
            $('#show-detail-room-modal').modal('show');
        });
    });

});

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
    cell2.innerHTML = "<input type='text' class='form-control' name='fullname[]' style='width: 200px' required>";
    cell3.innerHTML = "<input type='text' class='form-control' name='id_card[]' style='width: 200px' required>";
    cell4.innerHTML = "<input class='form-control' type='text' name='dob[]' style='width: 100px' required>";
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
    cell6.innerHTML = "<input type='text' class='form-control' name='phone[]' style='width: 200px' required>";
    cell7.innerHTML = "<input type='text' class='form-control' name='email[]' style='width: 200px'>";
    cell8.innerHTML = "<input type='text' class='form-control' name='hometown[]' style='width: 200px' required>";
    cell9.innerHTML =
        "<input type='file' class='form-control' name='idcard_front[]' style='width: 300px' accept='image/*' >";
    cell10.innerHTML =
        "<input type='file' class='form-control' name='idcard_back[]' style='width: 300px' accept='image/*' >";
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
