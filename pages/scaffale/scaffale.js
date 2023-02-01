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
const compraButton = document.getElementById('compra');
const sliderBirre = document.getElementById('slider');

const arrayBirre = [];
let birraAttiva;
let indice = 0;

fetch('pages/scaffale/prodotti-scaffale.php' + window.location.search)
    .then((res) => res.json())
    .then((data) => {

        for(const birraString of data) {
            const birra = JSON.parse(birraString);
            arrayBirre.push(new Birra(birra.nome, birra.prezzo, birra.descrizione, birra.categoria, birra.tagline,
                                     birra.imgPath, birra.stile, birra.aroma, birra.gusto));
        }

        if(arrayBirre.length > 1)
            indice = Math.trunc(arrayBirre.length / 2);

        creaPagina();
        return true;
    });


function creaPagina() {

    riempiInfoProdotto();

    // creo slider immagini
    for(let i = 0; i < arrayBirre.length; i++) {
        const div = document.createElement('div');
        div.className = 'item';
        sliderBirre.appendChild(div);

        const img = document.createElement('img');
        img.src = arrayBirre[i].image;
        img.alt = arrayBirre[i].nome;
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
    nomeBirra.textContent = arrayBirre[indice].nome;
    stileBirra.textContent = arrayBirre[indice].stile;
    taglineBirra.textContent = arrayBirre[indice].tagline;
    descBirra.textContent = arrayBirre[indice].descrizione;
    compraButton.id = arrayBirre[indice].nome;
}

function toggleInfoBirra() {
    // nascondo le info della birra se non è una birra
    const infoBirra = document.getElementById('info-birra');
    if(arrayBirre[indice].categoria === 'birra') {
        infoBirra.style.display = 'block';
        riempiInfoBirra();

        // abilito lo scroll
        window.onscroll = aggiornaAltezzaBirra;
    }
    else
        infoBirra.style.display = 'none';
}

/* ================== SCORRIMENTO BIRRE ================== */

const arrowNext = document.getElementById('slide-arrow-next');
const arrowPrev = document.getElementById('slide-arrow-prev');

arrowNext.onclick = function() {

    if(indice===arrayBirre.length-1)
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


function getScale(elem) {
    const style = window.getComputedStyle(elem);
    const matrix = new WebKitCSSMatrix(style.transform);
    return matrix.m11;
}








