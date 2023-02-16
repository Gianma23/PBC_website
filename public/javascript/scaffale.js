class Prodotto {
    constructor(nome, prezzo, descrizione, categoria, quantita, tagline, image) {
        this.nome = nome;
        this.prezzo = prezzo;
        this.quantita = quantita;
        this.descrizione = descrizione;
        this.categoria = categoria;
        this.tagline = tagline;
        this.image = image;
    }
}

class Birra extends Prodotto {
    constructor(nome, prezzo, descrizione, categoria, quantita, tagline, image, stile, aroma, gusto) {
        super(nome, prezzo, descrizione, categoria, quantita, tagline, image);
        this.stile = stile;
        this.aroma = aroma;
        this.gusto = gusto;
    }
}

const nomeProdotto = document.getElementById('nome-prodotto');
const stileBirra = document.getElementById('stile-birra');
const taglineProdotto = document.getElementById('tagline-prodotto');
const descProdotto = document.getElementById('descrizione-prodotto');
const aromaBirra = document.getElementById('aroma');
const gustoBirra = document.getElementById('gusto');
const sliderProdotti = document.getElementById('slider');
const prodottoId = document.getElementsByClassName('prodotto-id')[0];

const arrayProdotti = [];
let activeProduct;
let indice = 0;

/* =========== RIEMPIMENTO SCAFFALE =========== */
let query;

if (window.location.search === '')
    query = '/search/' + window.location.pathname.split('/').at(-1);
else
    query = '/search' + window.location.search;

fetch('/' + baseUrl + query)
    .then((res) => res.json())
    .then((data) => {
        riempiScaffale(data);
    });

/* ================== SCORRIMENTO BIRRE ================== */

const arrowNext = document.getElementById('slide-arrow-next');
const arrowPrev = document.getElementById('slide-arrow-prev');

arrowNext.onclick = function () {

    if (indice === arrayProdotti.length - 1)
        return;
    indice++;
    arrowNext.disabled = true;

    const nextProduct = activeProduct.nextSibling;

    scorriScaffale(nextProduct);

    riempiInfoProdotto();
    toggleInfoBirra();

    setTimeout(() => arrowNext.disabled = false, 500);
}

arrowPrev.onclick = function () {

    if (indice === 0)
        return;
    indice--;
    arrowPrev.disabled = true;

    const nextProduct = activeProduct.previousSibling;

    scorriScaffale(nextProduct);

    riempiInfoProdotto();
    toggleInfoBirra();

    setTimeout(() => arrowPrev.disabled = false, 500);
}

/* SCORRIMENTO VERTICALE BIRRA ATTIVA */

function aggiornaAltezzaBirra() {
    let top = window.scrollY;
    activeProduct.style.transform = `translateY( calc(${top}px - 56px)) scale(1.2)`;
}


/* =========== FUNZIONI DI UTILITA =========== */

function riempiScaffale(data) {
    let vuoto = true;
    for (const prodottoString of data) {
        vuoto = false;
        const prod = JSON.parse(prodottoString);
        if (prod.categoria === 'birra')
            arrayProdotti.push(new Birra(prod.nome, prod.prezzo, prod.descrizione, prod.categoria, prod.quantita, prod.tagline,
                prod.imgPath, prod.stile, prod.aroma, prod.gusto));
        else
            arrayProdotti.push(new Prodotto(prod.nome, prod.prezzo, prod.descrizione, prod.categoria, prod.quantita, prod.tagline, prod.imgPath));
    }

    // guardo se non ci sono prodotti
    if (vuoto) {
        messaggioScaffaleVuoto();
        return;
    }
    indice = Math.trunc(arrayProdotti.length / 2);
    creaPagina();
}

function creaPagina() {

    riempiInfoProdotto();
    toggleInfoBirra();

    // creo slider immagini
    for (let i = 0; i < arrayProdotti.length; i++) {
        const div = document.createElement('div');
        div.className = 'item';
        sliderProdotti.appendChild(div);

        const img = document.createElement('img');
        img.src = '/' + baseUrl + arrayProdotti[i].image;
        img.alt = arrayProdotti[i].nome;
        div.appendChild(img);

        // attivo birra corrente
        if (i === indice) {
            div.id = 'active';
            activeProduct = div;
        }
    }

    // se ci sono prodotti in numero pari devo shiftare il centro a sinistra
    if (arrayProdotti.length % 2 === 0){
        const nextProduct = activeProduct.previousSibling;
        // calcolo distanza tra nextProduct e activeProduct
        const distanza = getXDistanceBetweenElements(activeProduct, nextProduct);

        // sposto a sinistra
        sliderProdotti.style.transform = `translateX(-${distanza / 2}px)`;
    }
}

function riempiInfoBirra() {
    aromaBirra.textContent = arrayProdotti[indice].aroma;
    gustoBirra.textContent = arrayProdotti[indice].gusto;
}

function riempiInfoProdotto() {
    nomeProdotto.textContent = arrayProdotti[indice].nome;
    stileBirra.textContent = arrayProdotti[indice].stile;
    taglineProdotto.textContent = arrayProdotti[indice].tagline;
    descProdotto.textContent = arrayProdotti[indice].descrizione;
    prodottoId.value = arrayProdotti[indice].nome;

    prodottoId.nextElementSibling.disabled = Number(arrayProdotti[indice].quantita) === 0;
}

function toggleInfoBirra() {
    // nascondo le info della birra se non è una birra
    const infoBirra = document.getElementById('info-birra');
    if (arrayProdotti[indice].categoria === 'birra') {
        infoBirra.style.display = 'block';
        riempiInfoBirra();

        // abilito lo scroll
        window.onscroll = aggiornaAltezzaBirra;
    } else
        infoBirra.style.display = 'none';
}

function messaggioScaffaleVuoto() {
    const contenitore = document.getElementById('contenitore-prodotto');
    // svuoto pagina
    while (contenitore.firstChild) {
        contenitore.firstChild.remove()
    }

    const p = document.createElement('p');
    p.textContent = 'Nessun prodotto trovato!';
    p.classList.add('primary-heading');
    p.classList.add('scaffale-vuoto');
    contenitore.appendChild(p);
}

function scorriScaffale(nextProduct) {
    // calcolo distanza tra nextProduct e activeProduct
    const distanza = getXDistanceBetweenElements(activeProduct, nextProduct);

    // sposto il prodotto
    const actualTranslate = getTranslateX(sliderProdotti);
    sliderProdotti.style.transform = `translateX( calc(${distanza}px + ${actualTranslate}px))`;

    // cambio la birra attiva
    activeProduct = document.getElementById('active');
    activeProduct.id = '';
    activeProduct.style.transform = '';

    activeProduct = nextProduct;
    activeProduct.id = 'active';
    activeProduct.style.transform = '';
}

function getTranslateX(elem) {
    const style = window.getComputedStyle(elem);
    const matrix = new WebKitCSSMatrix(style.transform);
    return matrix.m41;
}

function getXDistanceBetweenElements(elementA, elementB) {
    const aPosition = getXPosition(elementA);
    const bPosition = getXPosition(elementB);
    return aPosition - bPosition;
}

function getXPosition(el) {
    const {top, left, width, height} = el.getBoundingClientRect();
    return left + width / 2;
}