
const loginForm = document.getElementById('login-form');
const emailEl = loginForm.querySelector('[name = email]');
const passwordEl = loginForm.querySelector('[name = password]');

const registerForm = document.getElementById('register-form');
const emailRegEl = registerForm.querySelector('[name = email]');
const passwordRegEl = registerForm.querySelector('[name = password]');
const confirmPasswordEl = registerForm.querySelector('[name = pass-conf]');

loginForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let isFormValid = true;

    isFormValid &&= validateEmail(emailEl);
    isFormValid &&= validatePassword(passwordEl);

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

registerForm.addEventListener('submit', (e) => {
    e.preventDefault();

    let isFormValid = true;

    isFormValid &&= validateEmail(emailRegEl);
    isFormValid &&= validatePassword(passwordRegEl);
    isFormValid &&= validateConfirmPassword(confirmPasswordEl);

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