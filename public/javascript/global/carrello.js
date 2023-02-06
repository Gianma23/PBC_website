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

/* =============================================== */
/* =====           CARICA CARRELLO           ===== */
/* =============================================== */

fetch('carica-carrello')
    .then((res) => res.json())
    .then((data) => {
        creaCarrelloLaterale(data);
        creaCarrelloPagina(data);
    });

/* =============================================== */
/* =====          AGGIUNGI PRODOTTO          ===== */
/* =============================================== */

const addButtons = document.querySelectorAll('.button--shop');

addButtons.forEach((button) => button.onclick = (e) => {

    const form = button.parentElement;
    const nomeBirra = form.getElementsByClassName('prodotto-id')[0].value.replaceAll(' ', '%20');

    fetch('carrello/aggiungi/' + nomeBirra)
        .then(() => {
            fetch('carica-carrello')
                .then((res) => res.json())
                .then((data) => {
                    creaCarrelloLaterale(data);
                    creaCarrelloPagina(data);
                    cartSlide.classList.add('open');
                });
        });
});

/* ================================================= */
/* =====           RIMUOVI PRODOTTO            ===== */
/* ================================================= */

function rimuoviHandler(e) {

    const nomeBirra = e.currentTarget.id;

    fetch('carrello/rimuovi/' + nomeBirra)
        .then(() => {
            fetch('carica-carrello')
                .then((res) => res.json())
                .then((data) => {
                    creaCarrelloLaterale(data);
                    creaCarrelloPagina(data);
                });
        });
}

/* Caricamento carrello laterale */

function creaCarrelloLaterale(data) {
    const listaProdotti = document.getElementById('prodotti-list');
    listaProdotti.innerHTML = '';

    let totale = 0;

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);

        totale += prodotto['price'] * data[prodottoString];

        const li = document.createElement('li');
        li.classList.add('prodotto');
        listaProdotti.appendChild(li);

        const div = document.createElement('div');
        const imgProdotto = document.createElement('img');
        imgProdotto.src = prodotto['img_path'];
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
    prezzoTotale.textContent = `Subtotale:\xa0\xa0\xa0\xa0${String(totale)}\u20AC`;
}

function creaCarrelloPagina(data) {
    const tabellaProdotti = document.getElementById('prodotti-table');
    if(!tabellaProdotti)
        return;
    tabellaProdotti.innerHTML = '';

    let totale = 0;

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);

        let subtotale = prodotto['price'] * data[prodottoString];
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
        subtotCell.textContent = subtotale + '\u20AC';
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
    const prezzoTotale = document.getElementById('totale');
    prezzoTotale.textContent = `Subtotale:\xa0\xa0\xa0\xa0${String(totale)}\u20AC`;

    // metto il totale anche nel riepilogo
    const totaleRiepilogo = document.getElementById('riepilogo-totale-carrello');
    if(totaleRiepilogo) {
        totaleRiepilogo.textContent = totale + '\u20AC';
    }
}

