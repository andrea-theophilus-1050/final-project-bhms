//Show hide password
const togglePassword = document.querySelector('#togglePassword');
const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirmPassword');

togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('dw-hide');
});

toggleConfirmPassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPassword.setAttribute('type', type);
    // toggle the eye / eye slash icon
    this.classList.toggle('dw-hide');
});


//compare password and confirm password
const textComparePassword = document.querySelector('.textComparePassword');
const iconChecked = document.querySelector('#checkedPassword');

function comparePassword() {
    if (confirmPassword.value != "" && confirmPassword.value != password.value) {
        textComparePassword.style.display = "block";
        iconChecked.style.display = "none";
    } else {
        textComparePassword.style.display = "none";
        iconChecked.style.display = "block";
    }
}


//Password Strength Checker
const indicator = document.querySelector(".indicator");
const input = document.querySelector("#password");
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

function trigger() {
    if (input.value != "") {
        indicator.style.display = "flex";

        if (input.value.length <= 3 && (input.value.match(regExpWeak) || input.value.match(regExpMedium) || input
                .value.match(regExpStrong))) no = 1;
        if (input.value.length >= 6 && ((input.value.match(regExpWeak) && input.value.match(regExpMedium)) || (input
                .value.match(regExpMedium) && input.value.match(regExpStrong)) || (input.value.match(
                regExpWeak) && input.value.match(regExpStrong)))) no = 2;
        if (input.value.length >= 6 && input.value.match(regExpWeak) && input.value.match(regExpMedium) && input
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

//Validate input field
function validateInput() {
    if (password.value.length < 6) {
        password.setCustomValidity("Password must be at least 6 characters");
        return false;
    } else {
        password.setCustomValidity("");

        if (confirmPassword != "") {
            if (confirmPassword.value != password.value) {
                confirmPassword.setCustomValidity("Password and Confirm Password do not match");
                textComparePassword.style.display = "block";
                iconChecked.style.display = "none";
                return false;
            } else {
                confirmPassword.setCustomValidity("");
                textComparePassword.style.display = "none";
                iconChecked.style.display = "block";
                return true;
            }
        }
    }
}
