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
function comparePassword() {
    if (confirmPassword.value === password.value) {
        confirmPassword.setCustomValidity('');

    } else {
        confirmPassword.setCustomValidity('Password and Confirm Password do not match');
    }
}