class Product {
    constructor(nome, prezzo, descrizione, categoria, tagline, image) {
        this.nome = nome;
        this.prezzo = prezzo;
        this.descrizione = descrizione;
        this.categoria = categoria;
        this.tagline = tagline;
        this.image = image;
    }
}

class Beer extends Product {
    constructor(nome, prezzo, descrizione, categoria, tagline, image, stile, aroma, gusto) {
        super(nome, prezzo, descrizione, categoria, tagline, image);
        this.stile = stile;
        this.aroma = aroma;
        this.gusto = gusto;
    }
}

const nomeBirra = document.getElementById('nome');
const stileBirra = document.getElementById('stile');
const taglineBirra = document.getElementById('tagline');
const descBirra = document.getElementById('descrizione');

const arrayBirre = [];
let indice = 0;

fetch('pages/scaffale/prodotti-scaffale.php' + getQueryString())
    .then((res) => res.json())
    .then((data) => {

        for(const birraString of data) {
            console.log(birraString)
            const birra = JSON.parse(birraString);
            arrayBirre.push(new Beer(birra.nome, birra.prezzo, birra.descrizione, birra.categoria, birra.tagline,
                                     birra.imgPath, birra.stile, birra.aroma, birra.gusto));
        }

        creaPagina();
        return true;
    });

function getQueryString() {
    return window.location.search;
}

function creaPagina() {

    nomeBirra.textContent = arrayBirre[indice].nome;
    stileBirra.textContent = arrayBirre[indice].stile;
    taglineBirra.textContent = arrayBirre[indice].tagline;
    descBirra.textContent = arrayBirre[indice].descrizione;

    // nascondo le info della birra se non è una birra
    const infoBirra = document.getElementById('info-birra');
    if(arrayBirre[indice].categoria === 'birra')
        infoBirra.style.display = 'block';
    else
        infoBirra.style.display = 'none';




}