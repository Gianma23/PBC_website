const prodottoForm = document.getElementById('prodotto-form');
if(prodottoForm) {
    const nomeEl = prodottoForm.querySelector('[name = nome]');
    const taglineEl = prodottoForm.querySelector('[name = tagline]');
    const stileEl = prodottoForm.querySelector('[name = stile]');
    const descEl = prodottoForm.querySelector('[name = desc]');
    const prezzoEl = prodottoForm.querySelector('[name = prezzo]');
    const quantitaEl = prodottoForm.querySelector('[name = quantita]');
    const categoriaEl = prodottoForm.querySelector('[name = categoria]');
    const aromaEl = prodottoForm.querySelector('[name = aroma]');
    const gustoEl = prodottoForm.querySelector('[name = gusto]');
    const imageEl = prodottoForm.querySelector('[name = image]');

    const MAX_LENGTH_NOME = 50;
    const MAX_LENGTH_TAGLINE = 100;
    const MAX_LENGTH_STILE = 50;

    const action = window.location.pathname.split('/').at(-2).substring(6);

    /* ======= RIEMPI INFO MODIFICA PRODOTTO ======= */

    if(action === 'modifica-prodotto') {

        const nome = window.location.pathname.split('/').at(-1);

        fetch( '/' + baseUrl + '/admin/carica-prodotto/' +  nome)
            .then(res => res.json())
            .then(data => {
                nomeEl.value = data['name'];
                taglineEl.value = data['tagline'];
                descEl.value = data['descr'];
                prezzoEl.value = data['price'];
                quantitaEl.value = data['quantity'];
                categoriaEl.value = data['category'];
                if(data['category'] === 'birra') {
                    aromaEl.value = data['aroma'];
                    gustoEl.value = data['flavor'];
                    stileEl.value = data['style'];
                }
                else
                    toggleInfoBirra();
            })
    }

    /* ======= PULSANTE AGGIUNTA/MODIFICA PRODOTTO ======= */

    prodottoForm.addEventListener('submit', e => {
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
            fetch('/' + baseUrl + '/admin/aggiungi-prodotto', {
                method: 'POST',
                body: new FormData(prodottoForm),
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

    prodottoForm.addEventListener("blur", e => {

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

    /* ======= MOSTRA INPUT AGGIUNTIVI BIRRA ======= */

    categoriaEl.onchange = toggleInfoBirra;

    /* ======= FUNZIONI UTILITA ======= */

    function toggleInfoBirra() {
        const infoBirra = document.getElementById('info-birra');
        if(categoriaEl.value !== 'birra')
            infoBirra.style.display = 'none';
        else
            infoBirra.style.display = 'block';
    }
}


/* ======= PULSANTE RIMOZIONE PRODOTTO ======= */

const eliminaButtons = document.getElementsByClassName('elimina');

for(let elimina of eliminaButtons) {
    elimina.onclick = function() {

        const prodottoCard = elimina.parentNode.parentNode;
        const nomeProdotto = prodottoCard.querySelector('.nome-prodotto')[0].textContent;

        fetch('admin/elimina-prodotto/' + nomeProdotto)
            .then((res) => res.text())
            .then((text) =>  {
                prodottoCard.remove()
                console.log(text)
        });
    }
}
