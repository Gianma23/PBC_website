/* ========================================== */
/* =====            GLOBAL              ===== */
/* ========================================== */

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

/* ========================================== */

const navToggle = document.getElementById('nav__toggle');
navToggle.onclick = function() {
    const body = document.body;

    if (document.getElementById('nav__toggle').checked) {
        const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
        body.style.position = 'fixed';
        body.style.top = `-${scrollY}`;
    } else {
        const scrollY = body.style.top;
        body.style.position = '';
        body.style.top = '';
        window.scrollTo(0, parseInt(scrollY || '0') * -1);
    }
}
window.addEventListener('scroll', () => {
    document.documentElement.style.setProperty('--scroll-y', `${window.scrollY}px`);
});

/*===================== Cart ====================*/

const cartSlide = document.getElementById('shopping-cart-slide');
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
cartButton.onclick = function() {
    cartSlide.classList.add('open');
}

const closeCart = document.getElementById('close-cart');
closeCart.onclick = function() {
    cartSlide.classList.remove('open');
}

/* ========================================== */
/* =====          BUTTON SHOP           ===== */
/* ========================================== */

const addButtons = document.querySelectorAll('.button--shop');

addButtons.forEach((button) => button.onclick = (e) => {

    fetch('global/php/carrello/carrello-aggiungi.php?product_id=' + e.currentTarget.id)
    .then(() =>{
        fetch('global/php/carrello/carrello-carica.php')
        .then((res) => res.json())
        .then((data) => creaListaCarrello(data))
    });

});


fetch('global/php/carrello/carrello-carica.php')
.then((res) => res.json())
.then((data) => creaListaCarrello(data));


function creaListaCarrello(data) {
    const listaProdotti = document.getElementById('prodotti-list');
    listaProdotti.innerHTML = '';

    let totale = 0;

    for (const productString of data) {
        const prodotto = JSON.parse(productString);

        totale += prodotto['prezzo'] * prodotto['pezzi'];

        const li = document.createElement('li');
        li.classList.add('prodotto');

        const div = document.createElement('div');
        const imgProdotto = document.createElement('img');
        imgProdotto.src = prodotto['imgPath'];
        div.appendChild(imgProdotto);
        li.appendChild(div);

        const nomeProdotto = document.createElement('p');
        nomeProdotto.textContent = prodotto['nome'];
        nomeProdotto.classList.add('nome-prodotto');
        li.appendChild(nomeProdotto);

        const prezzoProdotto = document.createElement('p');
        prezzoProdotto.textContent = prodotto['prezzo'];
        prezzoProdotto.classList.add('prezzo-prodotto');
        li.appendChild(prezzoProdotto);

        listaProdotti.appendChild(li);
    }
    const prezzoTotale = document.getElementById('totale');
    prezzoTotale.textContent = `Subtotale:\xa0\xa0\xa0\xa0${String(totale)}\u20AC`;
}