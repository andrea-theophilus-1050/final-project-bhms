//for show password function
const currentPass = document.getElementById("currentPassword");
const newPass = document.getElementById("newPassword");
const confirmNewPass = document.getElementById("confirmNewPassword");
const showPass = document.getElementById("showPass");

//password strength checker
const indicator = document.querySelector(".indicator");
/* const newPass = document.querySelector("#newPassword"); */
const weak = document.querySelector(".weak");
const medium = document.querySelector(".medium");
const strong = document.querySelector(".strong");
const text = document.querySelector(".text");
const textWeak = document.querySelector("#weak");
const textMedium = document.querySelector("#medium");
const textStrong = document.querySelector("#strong");

let regExpWeak = /[a-z]/;
let regExpMedium = /\d+/;
let regExpStrong = /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/;

//compare password
const compareNotMatchText = document.querySelector('#notMatch');
const compareMatchText = document.querySelector('#match');


// show all password
function showPassword() {
    if (currentPass.type === "password" && newPass.type === "password" && confirmNewPass.type === "password" && showPass.checked === true) {
        currentPass.type = "text";
        newPass.type = "text";
        confirmNewPass.type = "text";
    } else {
        currentPass.type = "password";
        newPass.type = "password";
        confirmNewPass.type = "password";
    }
}

//Password Strength Checker
function trigger() {
    if (newPass.value != "") {
        indicator.style.display = "flex";

        if (newPass.value.length <= 3 && (newPass.value.match(regExpWeak) || newPass.value.match(regExpMedium) || newPass
                .value.match(regExpStrong))) no = 1;
        if (newPass.value.length >= 6 && ((newPass.value.match(regExpWeak) && newPass.value.match(regExpMedium)) || (newPass
                .value.match(regExpMedium) && newPass.value.match(regExpStrong)) || (newPass.value.match(
                regExpWeak) && newPass.value.match(regExpStrong)))) no = 2;
        if (newPass.value.length >= 6 && newPass.value.match(regExpWeak) && newPass.value.match(regExpMedium) && newPass
            .value.match(regExpStrong)) no = 3;
        if (no == 1) {
            weak.classList.add("active");
            text.style.display = "block";
            // text.textContent = "Your password is too week";
            textWeak.style.display = "block";
            textMedium.style.display = "none";
            textStrong.style.display = "none";
            textWeak.classList.add("weak");
        }
        if (no == 2) {
            medium.classList.add("active");
            // text.textContent = "Your password is medium";
            textWeak.style.display = "none";
            textMedium.style.display = "block";
            textStrong.style.display = "none";
            textMedium.classList.add("medium");
        } else {
            medium.classList.remove("active");
            text.classList.remove("medium");
        }
        if (no == 3) {
            weak.classList.add("active");
            medium.classList.add("active");
            strong.classList.add("active");
            // text.textContent = "Your password is strong";
            textWeak.style.display = "none";
            textMedium.style.display = "none";
            textStrong.style.display = "block";
            textStrong.classList.add("strong");
        } else {
            strong.classList.remove("active");
            text.classList.remove("strong");
        }

    } else {
        indicator.style.display = "none";
        text.style.display = "none";
        textWeak.style.display = "none";
        textMedium.style.display = "none";
        textStrong.style.display = "none";
    }
}


function comparePassword() {
    if (confirmNewPass.value != "" && confirmNewPass.value != newPass.value) {
        compareNotMatchText.style.display = "block";
        compareMatchText.style.display = "none";
    } else {
        compareNotMatchText.style.display = "none";
        compareMatchText.style.display = "block";
    }
}


function validate() {
    if (currentPass.value === "") {
        currentPass.setCustomValidity('Current password is required');
        return false;
    } else {
        currentPass.setCustomValidity('');
    }
    if (newPass.value === "") {
        newPass.setCustomValidity('New password is required');
        return false;
    } else {
        newPass.setCustomValidity('');
    }
    if (confirmNewPass.value === "") {
        confirmNewPass.setCustomValidity('Confirm password is required');
        return false;
    } else {
        confirmNewPass.setCustomValidity('');
    }

    if (newPass.value.length < 6) {
        newPass.setCustomValidity('Password must be at least 6 characters');
        return false;
    } else {
        newPass.setCustomValidity('');
        if (confirmNewPass.value === newPass.value) {
            confirmNewPass.setCustomValidity('');
            return true;
        } else {
            confirmNewPass.setCustomValidity('Password and Confirm password do not match');
            return false;
        }
    }
}

currentPass.addEventListener("keypress", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
        document.getElementById("btnSubmitChangePassword").click();
    }
});

newPass.addEventListener("keypress", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
        document.getElementById("btnSubmitChangePassword").click();
    }
});

confirmNewPass.addEventListener("keypress", function (event) {
    if (event.key == "Enter") {
        event.preventDefault();
        document.getElementById("btnSubmitChangePassword").click();
    }
});