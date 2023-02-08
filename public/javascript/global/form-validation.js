
// validazione generica di tutti i form

const formList = document.querySelectorAll("form");

formList.forEach(form => {

    const emailEl = form.querySelector('[name = email]');
    const nameSurnameEl = form.querySelector('[name = nome-cognome]');
    const messageEl = form.querySelector('[name = messaggio]');
    const passwordEl = form.querySelector('[name = password]');
    const confirmPasswordEl = form.querySelector('[name = pass-conf]');

    form.addEventListener('submit', e => {

        const validEmail = validateEmail(emailEl);
        const validNameSurname= validateText(nameSurnameEl);
        const validMessage = validateMessage(messageEl);

        const isFormValid = validMessage && validEmail && validNameSurname;

        if(!isFormValid) {
            e.preventDefault();
        }
    });

    form.addEventListener("blur", e => {

        switch (e.target.name) {
            case 'nome-cognome':
                validateText(nameSurnameEl);
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
    }, true); // se metto false non va (boh) TODO
});

/* ======= Funzioni di validazione per tutti gli inputs ======= */

function validateText(textEl) {
    if(textEl == null)
        return true;

    let valid = false;
    const text = textEl.value;

    if (textEl.validity.valueMissing) {
        showError(textEl, 'Campo richiesto.')
    } else if (!isTextValid(text)) {
        showError(textEl, 'Inserire un testo valido');
    } else {
        showSuccess(textEl);
        valid = true;
    }
    return valid;
}

function validateEmail(emailEl) {
    if(emailEl == null)
        return true;

    let valid = false;
    const email = emailEl.value.trim();

    if (emailEl.validity.valueMissing) {
        showError(emailEl, 'Email richiesta.')
    } else if (!isEmailValid(email)) {
        showError(emailEl, 'Inserire una email valida.');
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
}

const validateMessage = messageEl => {
    if(messageEl == null)
        return true;

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
    if(passwordEl == null)
        return true;

    let valid = false;
    const password = passwordEl.value.trim();

    if (passwordEl.validity.valueMissing) {
        showError(passwordEl, 'Inserire la password.');
    } else if (!isPasswordValid(password)) {
        showError(passwordEl, 'Includere almeno 8 caratteri, di cui almeno: 1 minuscolo, 1 maiuscolo, 1 numero');
    } else {
        showSuccess(passwordEl);
        valid = true;
    }
    return valid;
}

const validateConfirmPassword = (passwordEl, confirmPasswordEl) => {
    if(passwordEl == null || confirmPasswordEl == null)
        return true;

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

const validateTelephone = (telephoneEl) => {
    if(telephoneEl == null)
        return true;

    let valid = false;
    const telephone = telephoneEl.value.trim();

    if (telephoneEl.validity.valueMissing) {
        showError(telephoneEl, 'Numero di telefono richiesto.');
    } else if (!isTelephoneValid(telephone)) {
        showError(telephoneEl, 'Numero di telefono non valido.');
    } else {
        showSuccess(telephoneEl);
        valid = true;
    }
    return valid;
}

const validateCap = (capEl) => {
    if(capEl == null)
        return true;

    let valid = false;
    const cap = capEl.value.trim();

    if (capEl.validity.valueMissing) {
        showError(capEl, 'Codice postale richiesto.');
    } else if (!isCapValid(cap)) {
        showError(capEl, 'Codice postale non valido.');
    } else {
        showSuccess(capEl);
        valid = true;
    }
    return valid;
}

/* Funzioni booleano di utilità */

const isTextValid = text => {
    const re = /([a-z]+)(\s*)+/;
    return re.test(text);
};

const isEmailValid = email => {
    const re = /^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return re.test(email);
};

const isPasswordValid = password => {
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/;
    return re.test(password);
};

const isTelephoneValid = telephone => {
    const re = /^(\((00|\+)39\)|(00|\+)39)?(38[890]|34[4-90]|36[680]|33[13-90]|32[89]|35[01]|37[019])(\s?\d{3}\s?\d{3,4}|\d{6,7})$/;
    return re.test(telephone);
};

const isCapValid = cap => {
    const re = /^[0-9]{5}$/;
    return re.test(cap);
};
/* Mostra messaggi */

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
