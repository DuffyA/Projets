const emailInput = document.getElementById('register_user_type_form_user_email');
let user_email= false

emailInput.addEventListener('input', function () {
    const emailValue = emailInput.value;
    const emailRegex = new RegExp("\\S+@\\S+\\.\\S+")

    if (emailRegex.test(emailValue)) {
        emailInput.style.color = 'green';
        user_email = true;
    }
    else {
        emailInput.style.color = 'red';
    }
})

const passwordInput = document.getElementById('register_user_type_form_plainPassword_first');
let user_password= false

passwordInput.addEventListener('input', function() {
    const pass = passwordInput.value;
    const hasUppercase = /[A-Z]/.test(pass);
    const hasSpecialCharacters = /[!@#$%^&*(),.?":{}|<>]/.test(pass);
    const hasNumber = /\d/.test(pass);

    if (hasUppercase && hasNumber && hasSpecialCharacters) {
        passwordInput.style.color = 'green';
        user_password = true;
    }
    else {
        passwordInput.style.color = 'red';
    }
})

const pseudoInput = document.getElementById('register_user_type_form_user_pseudo');
let user_pseudo= false

pseudoInput.addEventListener('input', function () {
    const pseudoLength = pseudoInput.value.length;

    if (4 < pseudoLength && pseudoLength < 20) {
        pseudoInput.style.color = 'green';
        user_pseudo = true;

    } else {
        pseudoInput.style.color = 'red';
    }
})