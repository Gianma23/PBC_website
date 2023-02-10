
const loginForm = document.getElementById('login-form');
const emailEl = loginForm.querySelector('[name = email]');
const passwordEl = loginForm.querySelector('[name = password]');

const registerForm = document.getElementById('register-form');
const emailRegEl = registerForm.querySelector('[name = email]');
const passwordRegEl = registerForm.querySelector('[name = password]');
const confirmPasswordEl = registerForm.querySelector('[name = pass-conf]');

/* =========== LOGIN FORM =========== */

loginForm.addEventListener('submit', e => {
    e.preventDefault();

    const validEmail = validateEmail(emailEl);
    const validPass = validatePassword(passwordEl);

    const isFormValid = validEmail && validPass;

    if(isFormValid) {
        fetch('auth/login', {
            method: 'POST',
            body: new FormData(loginForm),
        })
            .then(res => res.json())
            .then(data => {
                if(!data['success']) {
                    const errorText = document.getElementById('error-login');
                    errorText.textContent = data['text'];
                }
                else {
                    window.location.replace(data['text']);
                }
            })
    }
});

loginForm.addEventListener("blur", e => {

    switch (e.target.name) {
        case 'email':
            validateEmail(emailEl);
            break;
        case 'password':
            validatePassword(passwordEl);
            break;
    }
}, true);

/* =========== REGISTER FORM =========== */

registerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const validEmail = validateEmail(emailRegEl);
    const validPass = validatePassword(passwordRegEl);
    const validConfPass = validateConfirmPassword(confirmPasswordEl);

    const isFormValid = validEmail && validPass && validConfPass;

    if(isFormValid) {
        fetch('auth/register', {
            method: 'POST',
            body: new FormData(registerForm),
        })
            .then(res => res.json())
            .then(data => {
                if(!data['success']) {
                    const errorText = document.getElementById('error-register');
                    errorText.textContent = data['text'];
                }
                else {
                    window.location.replace(data['text']);
                }
            })
    }
});

registerForm.addEventListener("blur", e => {

    switch (e.target.name) {
        case 'email':
            validateEmail(emailRegEl);
            break;
        case 'password':
            validatePassword(passwordRegEl);
            break;
        case 'pass-conf':
            validateConfirmPassword(passwordRegEl, confirmPasswordEl);
            break;
    }
}, true);