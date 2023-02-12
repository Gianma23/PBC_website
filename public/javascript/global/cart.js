/* Sostituisco <a> con <button> se javascript è abilitato */

const cartLink = document.querySelector(".shopping-cart-link");
const cartButton = document.createElement('button')

for (const attr of cartLink.attributes) {
    cartButton.setAttributeNS(null, attr.name, attr.value)
}
while (cartLink.firstChild) {
    cartButton.appendChild(cartLink.firstChild)
}
cartButton.removeAttribute("href")
cartLink.replaceWith(cartButton)

/* Apertura e chiusura carrello laterale */

const cartSlide = document.getElementById('shopping-cart-slide');

cartButton.onclick = function() {
    cartSlide.classList.add('open');
}

const closeCart = document.getElementById('close-cart');
closeCart.onclick = function() {
    cartSlide.classList.remove('open');
}

const baseUrl = window.location.pathname.split('/')[1];

/* =============================================== */
/* =====           CARICA CARRELLO           ===== */
/* =============================================== */

fetch('/' + baseUrl + '/carica-carrello')
    .then((res) => res.json())
    .then((data) => {
        creaCarrelloLaterale(data);
        creaCarrelloPagina(data);
        setRiepilogo(data);
    });

/* =============================================== */
/* =====          AGGIUNGI PRODOTTO          ===== */
/* =============================================== */

const addButtons = document.querySelectorAll('.button--shop');

addButtons.forEach((button) => button.onclick = (e) => {

    const formContainer = e.currentTarget.parentElement;
    const nomeBirra = formContainer.getElementsByClassName('prodotto-id')[0];

    fetch('/' + baseUrl + '/carrello/aggiungi/' + nomeBirra.value)
        .then(() => {
            fetch('/' + baseUrl + '/carica-carrello')
                .then((res) => res.json())
                .then((data) => {
                    creaCarrelloLaterale(data);
                    creaCarrelloPagina(data);
                    setRiepilogo(data);
                    cartSlide.classList.add('open');
                });
        });
});

/* ================================================= */
/* =====           RIMUOVI PRODOTTO            ===== */
/* ================================================= */

function rimuoviHandler(e) {

    const nomeBirra = e.currentTarget.id;

    fetch('/' + baseUrl + '/carrello/rimuovi/' + nomeBirra)
        .then((dres) => dres.text())
        .then((text) => {
            console.log(text)
            fetch('/' + baseUrl + '/carica-carrello')
                .then((res) => res.json())
                .then((data) => {
                    creaCarrelloLaterale(data);
                    creaCarrelloPagina(data);
                    setRiepilogo(data);
                });
        });
}

/* ========== Caricamento carrello laterale ==========  */

function creaCarrelloLaterale(data) {
    const listaProdotti = document.getElementById('prodotti-list');
    listaProdotti.innerHTML = '';

    let numProdotti = 0;
    let totale = 0;

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);

        totale += prodotto['price'] * data[prodottoString];
        numProdotti += data[prodottoString];

        const li = document.createElement('li');
        li.classList.add('prodotto');
        listaProdotti.appendChild(li);

        const div = document.createElement('div');
        const imgProdotto = document.createElement('img');
        imgProdotto.src = prodotto['img_path'];
        imgProdotto.alt = prodotto['name'];
        div.appendChild(imgProdotto);
        li.appendChild(div);

        const divInfo = document.createElement('div');
        li.classList.add('info-prodotto-carrello');
        li.appendChild(divInfo);

        const nomeProdotto = document.createElement('p');
        nomeProdotto.textContent = prodotto['name'];
        nomeProdotto.classList.add('nome-prodotto');
        divInfo.appendChild(nomeProdotto);

        const prezzoProdotto = document.createElement('p');
        prezzoProdotto.textContent = data[prodottoString] + '\u00D7' + prodotto['price'] + '\u20AC';
        prezzoProdotto.classList.add('prezzo-prodotto');
        divInfo.appendChild(prezzoProdotto);

        const buttonRimuovi = document.createElement('button');
        buttonRimuovi.textContent = '\u00D7';
        buttonRimuovi.classList.add('remove-prodotto');
        buttonRimuovi.id = prodotto['name'];
        li.appendChild(buttonRimuovi);
        buttonRimuovi.addEventListener('click', rimuoviHandler);
    }
    const prezzoTotale = document.getElementById('totale');
    prezzoTotale.textContent = `Subtotale:\xa0\xa0\xa0\xa0${String(totale.toFixed(2))}\u20AC`;

    if(numProdotti > 0) {
        // metto il totale anche nel riepilogo
        const totaleRiepilogo = document.getElementById('riepilogo-totale-carrello');
        if (totaleRiepilogo) {
            totaleRiepilogo.textContent = String(totale);
        }
    }
}

/* ========== Caricamento carrello pagina ==========  */

function creaCarrelloPagina(data) {
    const tabellaProdotti = document.getElementById('prodotti-table');

    // controllo che esista la tabella del carrello
    if(!tabellaProdotti)
        return;
    tabellaProdotti.innerHTML = '';

    let numProdotti = 0;
    let totale = 0;

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);

        let subtotale = prodotto['price'] * data[prodottoString];
        numProdotti += data[prodottoString];
        totale += subtotale;

        const tr = document.createElement('tr');
        tabellaProdotti.appendChild(tr);

        // cella immagine nome prodotto
        const prodottoCell = document.createElement('td');
        const divImg = document.createElement('div');
        divImg.classList.add('img-prodotto')
        const imgProdotto = document.createElement('img');
        imgProdotto.alt = prodotto['name'];
        imgProdotto.src = prodotto['img_path'];
        const nomeProdotto = document.createElement('p');
        nomeProdotto.textContent = prodotto['name'];
        divImg.appendChild(imgProdotto)
        prodottoCell.appendChild(divImg);
        prodottoCell.appendChild(nomeProdotto);
        tr.appendChild(prodottoCell);

        // cella prezzo
        const prezzoCell = document.createElement('td');
        prezzoCell.textContent = prodotto['price'] + '\u20AC';
        tr.appendChild(prezzoCell);

        // cella quantita
        const quantitaCell = document.createElement('td');
        quantitaCell.textContent = data[prodottoString];
        tr.appendChild(quantitaCell);

        // cella subtotale
        const subtotCell = document.createElement('td');
        subtotCell.textContent = subtotale.toFixed(2) + '\u20AC';
        tr.appendChild(subtotCell);

        // cella bottone per rimuovere
        const rimuoviCell = document.createElement('td');
        const buttonRimuovi = document.createElement('button');
        buttonRimuovi.textContent = '\u00D7';
        buttonRimuovi.classList.add('remove-prodotto');
        buttonRimuovi.id = prodotto['name'];
        rimuoviCell.appendChild(buttonRimuovi);
        tr.appendChild(rimuoviCell);
        buttonRimuovi.addEventListener('click', rimuoviHandler);
    }

    // se non ci sono prodotti mostro un messaggio
    if(numProdotti === 0) {
        const carrelloContainer = document.getElementById('carrello-container');
        carrelloContainer.classList.add('secondary-heading');
        rimuoviCarrello(carrelloContainer);
    }
}

function rimuoviCarrello(carrelloContainer) {
    carrelloContainer.innerHTML = '';
    carrelloContainer.textContent = 'Il carrello è vuoto!';
}

function setRiepilogo(data) {

    let numProdotti = 0;
    let totale = 0;

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);
        totale += prodotto['price'] * data[prodottoString];
        numProdotti += Number(data[prodottoString]);
    }

    // metto il totale del carrello
    const totaleCarrello = document.getElementById('riepilogo-totale-carrello');
    const totaleSpedizione = document.getElementById('riepilogo-stima-spedizione');
    const totaleOrdine = document.getElementById('riepilogo-totale-ordine');
    const textNumProdotti = document.getElementById('num-prodotti');
    const totaleSpedizioneInput = document.getElementById('totale-spedizione');
    const totaleInput = document.getElementById('totale-input');

    // guardo che esista la card riepilogo
    if (totaleCarrello) {
        totaleCarrello.textContent = totale.toFixed(2);
        textNumProdotti.textContent = String(numProdotti);
        totaleOrdine.textContent = (totale + Number(totaleSpedizione.textContent)).toFixed(2);
    }

    // aggiorno valori inputs totali
    if(totaleSpedizioneInput) {
        totaleSpedizioneInput.value = totaleSpedizione.textContent;
        totaleInput.value = totaleOrdine.textContent;
    }
}

