const aggiungiForm = document.getElementById('aggiungi-form');
const nomeEl = aggiungiForm.querySelector('[name = nome]');
const taglineEl = aggiungiForm.querySelector('[name = tagline]');
const stileEl = aggiungiForm.querySelector('[name = stile]');
const descEl = aggiungiForm.querySelector('[name = desc]');
const prezzoEl = aggiungiForm.querySelector('[name = prezzo]');
const quantitaEl = aggiungiForm.querySelector('[name = quantita]');
const categoriaEl = aggiungiForm.querySelector('[name = categoria]');
const aromaEl = aggiungiForm.querySelector('[name = aroma]');
const gustoEl = aggiungiForm.querySelector('[name = gusto]');
const imageEl = aggiungiForm.querySelector('[name = image]');

const MAX_LENGTH_NOME = 50;
const MAX_LENGTH_TAGLINE = 100;
const MAX_LENGTH_STILE = 50;

/* ======= PULSANTE AGGIUNTA PRODOTTO ======= */

aggiungiForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const validNome = validateRequired(nomeEl) && validateLength(nomeEl, MAX_LENGTH_NOME);
    const validTagline = validateLength(taglineEl, MAX_LENGTH_TAGLINE);
    const validDesc = validateMessage(descEl);
    const validPrezzo = validateNatural(prezzoEl);
    const validQuantita = validateNatural(quantitaEl);
    const validImage = validateImage(imageEl);

    let isFormValid = validNome && validTagline && validDesc && validPrezzo && validQuantita && validImage;

    if(categoriaEl.value === 'birra') {
        const validStile = validateText(stileEl) && validateLength(stileEl, MAX_LENGTH_STILE);
        const validAroma = validateMessage(aromaEl);
        const validGusto = validateMessage(gustoEl);
        isFormValid &&= validStile && validAroma && validGusto;
    }

    if(isFormValid) {
        fetch('admin/aggiungi-prodotto', {
            method: 'POST',
            body: new FormData(aggiungiForm),
        })
            .then(res => res.json())
            .then(data => {
                if(!data['success']) {
                    const errorText = document.getElementById('error-prodotto');
                    errorText.textContent = data['text'];
                }
                else {
                    window.location.replace(data['text']);
                }
            })
    }
});

aggiungiForm.addEventListener("blur", e => {

    switch (e.target.name) {
        case 'nome':
            validateRequired(nomeEl) && validateLength(nomeEl, MAX_LENGTH_NOME);
            break;
        case 'desc':
            validateMessage(descEl);
            break;
        case 'prezzo':
            validateNatural(prezzoEl);
            break;
        case 'quantita':
            validateNatural(quantitaEl);
            break;
        case 'image':
            validateImage(imageEl);
            break;
        case 'stile':
            validateText(stileEl) && validateLength(stileEl, MAX_LENGTH_STILE);
            break;
        case 'aroma':
            validateMessage(aromaEl);
            break;
        case 'gusto':
            validateMessage(gustoEl);
            break;
    }
}, true);
