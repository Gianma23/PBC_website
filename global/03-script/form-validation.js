/* ========================================== */
/* =====        FORM VALIDATION         ===== */
/* ========================================== */


const formList = document.querySelectorAll("form");

/* Listener for input in every form in the page */
formList.forEach(form => {
    form.addEventListener("input", event => {

        const emailEl = form.querySelector('[name = email]');
        const nameSurnameEl = form.querySelector('[name = nome-cognome]');
        const messageEl = form.querySelector('[name = messaggio]');
        const passwordEl = form.querySelector('[name = password]');
        const confirmPasswordEl = form.querySelector('[name = pass-conf]');

        switch (event.target.name) {
            case 'nome-cognome':
                validateNameSurname(nameSurnameEl);
                break;
            case 'email':
                validateEmail(emailEl);
                break;
            case 'messaggio':
                validateMessage(messageEl);
                break;
            case 'password':
                validatePassword(passwordEl);
                break;
            case 'pass-conf':
                validateConfirmPassword(passwordEl, confirmPasswordEl);
                break;
        }
    });
});

formList.forEach(form => {
    form.addEventListener('submit', e => {

        e.preventDefault()

        let isFormValid =  validateEmail();
        if(!isFormValid) {

        }
    });
});

/* Validation functions for every input */
const validateNameSurname = nameSurnameEl => {

    let valid = false;
    const nameSurname = nameSurnameEl.value;

    if (nameSurnameEl.validity.valueMissing) {
        showError(nameSurnameEl, 'Nome e cognome richiesti.')
    } else if (!isNameSurnameValid(nameSurname)) {
        showError(nameSurnameEl, 'Inserire un nome e uno o più cognomi.');
    } else {
        showSuccess(nameSurnameEl);
        valid = true;
    }
    return valid;
}

const validateEmail = emailEl => {

    let valid = false;
    const email = emailEl.value.trim();

    if (emailEl.validity.valueMissing) {
        showError(emailEl, 'Email richiesta.')
    } else if (!isEmailValid(email)) {
        showError(emailEl, 'Il formato è esempio@email.com.');
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
}

const validateMessage = messageEl => {

    let valid = false;
    const message = messageEl.value.trim();

    if (messageEl.validity.valueMissing) {
        showError(messageEl, 'Messaggio richiesto.')
    } else if (message.length < 20) {
        showError(messageEl, 'Il messaggio deve avere almeno 20 caratteri.');
    } else {
        showSuccess(messageEl);
        valid = true;
    }
    return valid;
}

const validatePassword = passwordEl => {

    let valid = false;
    const password = passwordEl.value.trim();

    if (passwordEl.validity.valueMissing) {
        showError(passwordEl, 'Inserire la password.');
    } else if (!isPasswordValid(password)) {
        showError(passwordEl, 'Includere almeno 8 caratteri, di cui almeno: 1 minuscolo, 1 maiuscolo, 1 numero, 1 carattere speciale in (!@#$%^&*)');
    } else {
        showSuccess(passwordEl);
        valid = true;
    }
    return valid;
}

const validateConfirmPassword = (passwordEl, confirmPasswordEl) => {

    let valid = false;
    const password = passwordEl.value.trim();
    const confirmPassword = confirmPasswordEl.value.trim();

    if (passwordEl.validity.valueMissing) {
        showError(confirmPasswordEl, 'Confermare la password.');
    } else if (password !== confirmPassword) {
        showError(confirmPasswordEl, 'Le password non sono uguali.');
    } else {
        showSuccess(confirmPasswordEl);
        valid = true;
    }
    return valid;
}

/* Helping boolean function */
const isNameSurnameValid = nameSurname => {
    const re = /([a-z]+)(\s+)+[a-z]+/i;
    return re.test(nameSurname);
};

const isEmailValid = email => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPasswordValid = password => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})/;
    return re.test(password);
};

/* Show error or success */
const showError = (input, message) => {

    const formField = input.parentElement;

    formField.classList.remove('valid');
    formField.classList.add('invalid');

    // show the error
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {

    const formField = input.parentElement;

    formField.classList.remove('invalid');
    formField.classList.add('valid');

    // hide the error
    const error = formField.querySelector('small');
    error.textContent = '';
}
