const totaleCarrello = document.getElementById('riepilogo-totale-carrello');
const stimaSpedizione = document.getElementById('riepilogo-stima-spedizione');
const totaleOrdine = document.getElementById('riepilogo-totale-ordine');
const provinciaSelect = document.getElementById('provincia');
const totaleInput = document.getElementById('totale-input');
const totaleSpedizioneInput = document.getElementById('totale-spedizione');

const checkoutForm = document.getElementById('checkout-form');
const emailEl = checkoutForm.querySelector('[name = email]');
const nomeEl = checkoutForm.querySelector('[name = nome]');
const cognomeEl = checkoutForm.querySelector('[name = cognome]');
const telefonoEl = checkoutForm.querySelector('[name = telefono]');
const indirizzoEl = checkoutForm.querySelector('[name = indirizzo]');
const cittaEl = checkoutForm.querySelector('[name = citta]');
const capEl = checkoutForm.querySelector('[name = cap]');
const noteEl = checkoutForm.querySelector('[name = note]');

/* Aggiornamento totale ordine */
provinciaSelect.oninput = function(e) {

    const provincia = provinciaSelect.value;
    const regione = provinciaSelect.options[provinciaSelect.selectedIndex].dataset.region;

    if(provincia === 'Livorno') {
        stimaSpedizione.textContent = '0';
        totaleOrdine.textContent = totaleCarrello.textContent;
    }
    else if(regione === 'Sardegna') {
        stimaSpedizione.textContent = '12.50';
        totaleOrdine.textContent = String(Number(totaleCarrello.textContent) + 12.5);
    }
    else if(regione === 'Sicilia') {
        stimaSpedizione.textContent = '15.50';
        totaleOrdine.textContent = String(Number(totaleCarrello.textContent) + 15.5);
    }
    else {
        stimaSpedizione.textContent = '9.50';
        totaleOrdine.textContent = String(Number(totaleCarrello.textContent) + 9.5);
    }

    // aggiorno valori inputs totali
    totaleSpedizioneInput.value =  stimaSpedizione.textContent;
    totaleInput.value = totaleOrdine.textContent;
}

/* =========== CHECKOUT FORM =========== */

checkoutForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const emailValid= validateEmail(emailEl) && validateLength(emailEl, 100);
    const nomeValid= validateText(nomeEl) && validateLength(nomeEl, 50);
    const cognomeValid= validateText(cognomeEl) && validateLength(cognomeEl, 50);
    const telValid= validateTelephone(telefonoEl);
    const indirizzoValid= validateRequired(indirizzoEl);
    const cittaValid= validateText(cittaEl) && validateLength(cittaEl, 50);
    const capValid= validateCap(capEl);
    const noteValid= validateRequired(noteEl);

    const isFormValid = emailValid && nomeValid && cognomeValid && telValid && indirizzoValid && cittaValid && capValid && noteValid;

    if(isFormValid) {
        fetch('ordine/aggiungi', {
            method: 'POST',
            body: new FormData(checkoutForm),
        })
            .then(res => res.json())
            .then(data => {
                if(!data['success']) {
                    const errorText = document.getElementById('error-checkout');
                    errorText.textContent = data['text'];
                }
                else {
                    window.location.replace(data['text']);
                }
            })
    }
});

checkoutForm.addEventListener("blur", e => {

    switch (e.target.name) {
        case 'nome':
            validateText(nomeEl) && validateLength(nomeEl, 50);
            break;
        case 'cognome':
            validateText(cognomeEl) && validateLength(cognomeEl, 50);
            break;
        case 'email':
            validateEmail(emailEl) && validateLength(emailEl, 100);
            break;
        case 'telefono':
            validateTelephone(telefonoEl);
            break;
        case 'indirizzo':
            validateRequired(indirizzoEl);
            break;
        case 'citta':
            validateText(cittaEl) && validateLength(cittaEl, 50);
            break;
        case 'cap':
            validateCap(capEl);
            break;
        case 'note':
            validateRequired(noteEl);
            break;
    }
}, true);