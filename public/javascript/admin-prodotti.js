
/* ======= MOSTRA INPUT AGGIUNTIVI BIRRA ======= */

const categoriaSelect = document.getElementById('categoria');

categoriaSelect.onchange = function() {
    const infoBirra = document.getElementById('info-birra');
    if(categoriaSelect.value !== 'birra')
        infoBirra.style.display = 'none';
    else
        infoBirra.style.display = 'block';
}

/* ======= PULSANTE RIMOZIONE PRODOTTO ======= */

const eliminaButtons = document.getElementsByClassName('elimina');

for(let elimina of eliminaButtons) {
    elimina.onclick = function() {

        const prodottoCard = elimina.parentNode.parentNode;
        const nomeProdotto = prodottoCard.querySelector('#nome-prodotto');

        fetch('admin/elimina-prodotto/' + nomeProdotto)
            .then(() => prodottoCard.remove());
    }
}

/* ======= PULSANTE MODIFICA PRODOTTO ======= */
//TODO: modifica prodotto

/* ======= PULSANTE AGGIUNTA PRODOTTO ======= */

const aggiungiForm = document.getElementById('aggiungi-form');
const nomeEl = aggiungiForm.querySelector('[name = nome]');
const stileEl = aggiungiForm.querySelector('[name = stile]');
const descEl = aggiungiForm.querySelector('[name = desc]');
const prezzoEl = aggiungiForm.querySelector('[name = prezzo]');
const quantitaEl = aggiungiForm.querySelector('[name = quantita]');
const categoriaEl = aggiungiForm.querySelector('[name = categoria]');
const aromaEl = aggiungiForm.querySelector('[name = aroma]');
const gustoEl = aggiungiForm.querySelector('[name = gusto]');
const imageEl = aggiungiForm.querySelector('[name = image]');

aggiungiForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const validNome = validateRequired(nomeEl);
    const validDesc = validateMessage(descEl);
    const validPrezzo = validateNatural(prezzoEl);
    const validQuantita = validateNatural(quantitaEl);
    const validImage = validateImage(imageEl);

    let isFormValid = validNome && validDesc && validPrezzo && validQuantita && validImage;

    if(categoriaEl.value === 'birra') {
        const validStile = validateText(stileEl);
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

//TODO: aggiungi form blur