const emailForms = document.getElementsByClassName('email-form');


for(let emailForm of emailForms) {

    const emailEl = emailForm.querySelector('[name = email]');
    const messaggioEl = emailForm.querySelector('[name = messaggio]');
    const nomeCognomeEl = emailForm.querySelector('[name = nome-cognome]');

    emailForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const validEmail = validateEmail(emailEl);
        const validNomeCognome = validateText(nomeCognomeEl);
        const validMessaggio = validateMessage(messaggioEl);

        const isFormValid = validEmail && validNomeCognome && validMessaggio;

        if(isFormValid) {
            fetch('invia-email', {
                method: 'POST',
                body: new FormData(emailForm),
            })
                .then(res => res.json())
                .then(data => {
                    const text = emailForm.querySelector('#email-text');
                    text.textContent = data['text'];
                    if(data['success']) {
                        text.classList.remove('error');
                        text.classList.add('success');

                    }
                    else {
                        text.classList.add('error');
                        text.classList.remove('success');
                    }
                })
        }
    });

    emailForm.addEventListener("blur", (e) => {

        switch (e.target.name) {
            case 'email':
                validateEmail(emailEl);
                break;
            case 'nome-cognome':
                validateText(nomeCognomeEl);
                break;
            case 'messaggio':
                validateMessage(messaggioEl) && validateLength(messaggioEl, 200);
                break;
        }
    }, true);
}

