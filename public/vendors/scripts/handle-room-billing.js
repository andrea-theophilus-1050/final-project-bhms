document.addEventListener("DOMContentLoaded", function () {
    const btnViewDetails = document.querySelectorAll("#view-details-btn");

    btnViewDetails.forEach(function (e) {
        e.addEventListener("click", function () {
            const objBill = JSON.parse(e.getAttribute("data-objBill"));

            var tenantName = document.getElementById("tenantName");
            var roomName = document.getElementById("roomName");
            var phoneNumber = document.getElementById("phoneNumber");
            var email = document.getElementById("email");
            var houseName = document.getElementById("houseName");
            var houseAddress = document.getElementById("houseAddress");
            var billDate = document.getElementById("billDate");

            var room_pirce = document.getElementById("room_pirce");
            var oldWaterIndex = document.getElementById("oldWaterIndex");
            var newWaterIndex = document.getElementById("newWaterIndex");
            var water_consumed = document.getElementById("water_consumed");
            var water_unit_price = document.getElementById("water_unit_price");
            var water_totalConsumed = document.getElementById(
                "water_totalConsumed"
            );
            var oldElectricityIndex = document.getElementById(
                "oldElectricityIndex"
            );
            var newElectricityIndex = document.getElementById(
                "newElectricityIndex"
            );
            var electricity_consumed = document.getElementById(
                "electricity_consumed"
            );
            var electricity_unit_price = document.getElementById(
                "electricity_unit_price"
            );
            var electricity_totalConsumed = document.getElementById(
                "electricity_totalConsumed"
            );
            var totalBill = document.getElementById("totalBill");

            tenantName.innerHTML = objBill.tenant_name;
            roomName.innerHTML = objBill.room_name;
            phoneNumber.innerHTML = objBill.tenant_phone;
            email.innerHTML = objBill.tenant_email;
            houseName.innerHTML = objBill.house_name;
            houseAddress.innerHTML = objBill.house_address;
            billDate.innerHTML = objBill.billDate;

            room_pirce.innerHTML = parseFloat(
                objBill.room_price
            ).toLocaleString();

            oldWaterIndex.innerHTML = objBill.old_water_index;
            newWaterIndex.innerHTML = objBill.new_water_index;
            water_consumed.innerHTML = objBill.waterConsume;
            water_unit_price.innerHTML = parseFloat(
                objBill.waterServicePrice
            ).toLocaleString();
            water_totalConsumed.innerHTML = parseFloat(
                objBill.waterTotalPrice
            ).toLocaleString();

            oldElectricityIndex.innerHTML = objBill.old_electricity_index;
            newElectricityIndex.innerHTML = objBill.new_electricity_index;
            electricity_consumed.innerHTML = objBill.electricityConsume;
            electricity_unit_price.innerHTML = parseFloat(
                objBill.electricityServicePrice
            ).toLocaleString();
            electricity_totalConsumed.innerHTML = parseFloat(
                objBill.electricityTotalPrice
            ).toLocaleString();

            const detailsServicesBill = document.getElementById(
                "costsIncurredSection"
            );
            const otherServices = document.getElementById("otherServices");

            detailsServicesBill.innerHTML = "";
            otherServices.innerHTML = "";

            for (const key in objBill.costsIncurred) {
                if (objBill.costsIncurred.hasOwnProperty(key)) {
                    const element = objBill.costsIncurred[key];
                    const li = document.createElement("li");
                    li.classList.add("clearfix");
                    li.innerHTML = `
                            <div class="invoice-sub">
                               <b class="font-14">Cost incurred</b>: ${
                                   element.reason
                               }
                            </div>
                            <div class="invoice-rate"></div>
                            <div class="invoice-hours"></div>
                            <div class="invoice-subtotal text-center">
                                <span class="weight-600">${parseFloat(
                                    element.price
                                ).toLocaleString()}</span>
                            </div>
                            `;
                    detailsServicesBill.appendChild(li);
                }
            }

            for (const key in objBill.otherServicesUsed) {
                if (objBill.otherServicesUsed.hasOwnProperty(key)) {
                    const element = objBill.otherServicesUsed[key];
                    const li = document.createElement("li");
                    li.classList.add("clearfix");
                    li.innerHTML = `
                            <div class="invoice-sub">
                               ${element.service_name}
                            </div>
                            <div class="invoice-rate"></div>
                            <div class="invoice-hours"></div>
                            <div class="invoice-subtotal text-center">
                                <span class="weight-600">${parseFloat(
                                    element.price_if_changed
                                ).toLocaleString()}</span>
                            </div>
                            `;
                    otherServices.appendChild(li);
                }
            }

            totalBill.innerHTML = objBill.total.toLocaleString();

            $("#modal-view-details").modal("show");
        });
    });
});
