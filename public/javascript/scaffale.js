class Prodotto {
    constructor(nome, prezzo, descrizione, categoria, tagline, image) {
        this.nome = nome;
        this.prezzo = prezzo;
        this.descrizione = descrizione;
        this.categoria = categoria;
        this.tagline = tagline;
        this.image = image;
    }
}

class Birra extends Prodotto {
    constructor(nome, prezzo, descrizione, categoria, tagline, image, stile, aroma, gusto) {
        super(nome, prezzo, descrizione, categoria, tagline, image);
        this.stile = stile;
        this.aroma = aroma;
        this.gusto = gusto;
    }
}

const nomeBirra = document.getElementById('nome-birra');
const stileBirra = document.getElementById('stile-birra');
const taglineBirra = document.getElementById('tagline-birra');
const descBirra = document.getElementById('descrizione-birra');
const sliderBirre = document.getElementById('slider');
const prodottoId = document.getElementsByClassName('prodotto-id')[0];

const arrayProdotti = [];
let birraAttiva;
let indice = 0;

const queryCategory = window.location.pathname.split('/').at(-1);

fetch('search/' + queryCategory)
.then((res) => res.json())
.then((data) => {

    let vuoto = true;
    for(const prodottoString of data) {
        vuoto = false;
        const prod = JSON.parse(prodottoString);
        if(queryCategory === 'birra')
            arrayProdotti.push(new Birra(prod.nome, prod.prezzo, prod.descrizione, prod.categoria, prod.tagline,
                                      prod.imgPath, prod.stile, prod.aroma, prod.gusto));
        else
            arrayProdotti.push(new Prodotto(prod.nome, prod.prezzo, prod.descrizione, prod.categoria, prod.tagline, prod.imgPath));
    }

    // guardo se non ci sono prodotti
    if(vuoto) {
        messaggioScaffaleVuoto();
        return;
    }

    if(arrayProdotti.length > 1)
        indice = Math.trunc(arrayProdotti.length / 2);

    creaPagina();
});


function creaPagina() {

    riempiInfoProdotto();

    // creo slider immagini
    for(let i = 0; i < arrayProdotti.length; i++) {
        const div = document.createElement('div');
        div.className = 'item';
        sliderBirre.appendChild(div);

        const img = document.createElement('img');
        img.src = arrayProdotti[i].image;
        img.alt = arrayProdotti[i].nome;
        div.appendChild(img);

        // attivo birra corrente
        if(i === indice) {
            div.id = 'active';
            birraAttiva = div;
        }

        sliderBirre.style.transform = '';
    }


    toggleInfoBirra();
}

function riempiInfoBirra() {

}

function riempiInfoProdotto() {
    nomeBirra.textContent = arrayProdotti[indice].nome;
    stileBirra.textContent = arrayProdotti[indice].stile;
    taglineBirra.textContent = arrayProdotti[indice].tagline;
    descBirra.textContent = arrayProdotti[indice].descrizione;
    prodottoId.value = arrayProdotti[indice].nome;
}

function toggleInfoBirra() {
    // nascondo le info della birra se non è una birra
    const infoBirra = document.getElementById('info-birra');
    if(arrayProdotti[indice].categoria === 'birra') {
        infoBirra.style.display = 'block';
        riempiInfoBirra();

        // abilito lo scroll
        window.onscroll = aggiornaAltezzaBirra;
    }
    else
        infoBirra.style.display = 'none';
}

function messaggioScaffaleVuoto() {
    const contenitore = document.getElementById('contenitore-prodotto');
    contenitore.innerHTML = '';

    const p = document.createElement('p');
    p.textContent = 'Nessun prodotto trovato!';
    p.classList.add('primary-heading');
    p.classList.add('scaffale-vuoto');
    contenitore.appendChild(p);
}

/* ================== SCORRIMENTO BIRRE ================== */

const arrowNext = document.getElementById('slide-arrow-next');
const arrowPrev = document.getElementById('slide-arrow-prev');

arrowNext.onclick = function() {

    if(indice===arrayProdotti.length-1)
        return;
    indice++;

    // sposto a sinistra
    const actualTranslate = getTranslateX(sliderBirre);
    sliderBirre.style.transform = `translateX( calc( ${actualTranslate}px - var(--column-width-2) - var(--gutter)))`;

    // cambio la birra attiva
    birraAttiva = document.getElementById('active');
    birraAttiva.id = '';
    birraAttiva.style.transform = '';

    birraAttiva = birraAttiva.nextSibling;
    birraAttiva.id = 'active';
    birraAttiva.style.transform = '';

    riempiInfoProdotto();
    toggleInfoBirra();
}

arrowPrev.onclick = function() {

    if(indice===0)
        return;
    indice--;

    // sposto a sinistra
    const actualTranslate = getTranslateX(sliderBirre);
    sliderBirre.style.transform = `translateX( calc( ${actualTranslate}px + var(--column-width-2) + var(--gutter)))`;

    // cambio la birra attiva
    birraAttiva = document.getElementById('active');
    birraAttiva.id = '';
    birraAttiva.style.transform = '';

    birraAttiva = birraAttiva.previousSibling;
    birraAttiva.id = 'active';
    birraAttiva.style.transform = '';

    riempiInfoProdotto();
    toggleInfoBirra();
}

/* SCORRIMENTO VERTICALE BIRRA ATTIVA */

function aggiornaAltezzaBirra() {
    let top = window.scrollY;
    birraAttiva.style.transform = `translateY( calc(${top}px - 56px)) scale(1.2)`;
}


function getTranslateX(elem) {
    const style = window.getComputedStyle(elem);
    const matrix = new WebKitCSSMatrix(style.transform);
    return matrix.m41;
}








