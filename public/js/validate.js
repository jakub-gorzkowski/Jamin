const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmed-password"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            const confirmedPasswordCondition = arePasswordsSame(passwordInput.value, confirmedPasswordInput.value);

            markValidation(confirmedPasswordInput, confirmedPasswordCondition);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);
