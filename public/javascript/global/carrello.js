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
    .then((res) => res.text())
    .then((html) => {
        caricaCarrello(html);
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
                .then((res) => res.text())
                .then((html) => {
                    caricaCarrello(html);
                    cartSlide.classList.add('open');
                });
        });
});

/* ================================================= */
/* =====           RIMUOVI PRODOTTO            ===== */
/* ================================================= */

function rimuoviHandler(removeButtons) {

    removeButtons.forEach((button) => button.onclick = (e) => {

        const listElement = button.parentElement;
        const nomeBirra = listElement.getElementsByClassName('nome-prodotto')[0].textContent.replaceAll(' ', '%20');

        fetch('carrello/rimuovi/' + nomeBirra)
            .then(() => {
                fetch('carica-carrello')
                    .then((res) => res.text())
                    .then((html) => {
                        caricaCarrello(html);
                    });
            });
    });
}

function caricaCarrello(html) {
    const listaProdotti = document.getElementById('prodotti-list');
    listaProdotti.innerHTML = html;

    // aggiungo listener su bottoni per rimuovere
    const removeButtons = document.querySelectorAll('.remove-prodotto');
    rimuoviHandler(removeButtons);
}

