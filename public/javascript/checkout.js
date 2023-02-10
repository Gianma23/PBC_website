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
const cittaEl = checkoutForm.querySelector('[name = citta]');
const capEl = checkoutForm.querySelector('[name = cap]');

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

    const emailValid= validateEmail(emailEl);
    const nomeValid= validateText(nomeEl);
    const cognomeValid= validateText(cognomeEl);
    const telValid= validateTelephone(telefonoEl);
    const cittaValid= validateText(cittaEl);
    const capValid= validateCap(capEl);

    const isFormValid = emailValid && nomeValid && cognomeValid && telValid && cittaValid && capValid;

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
            validateText(nomeEl);
            break;
        case 'cognome':
            validateText(cognomeEl);
            break;
        case 'email':
            validateEmail(emailEl);
            break;
        case 'telefono':
            validateTelephone(telefonoEl);
            break;
        case 'citta':
            validateText(cittaEl);
            break;
        case 'cap':
            validateCap(capEl);
            break;
    }
}, true); // se metto false non va (boh) TODO