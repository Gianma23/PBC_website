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

let mediaquery = window.matchMedia("(min-width: 55em)")
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openCart() {
    let width = "calc(var(--column-width-4) + var(--margin)"
    if(mediaquery.matches) {
        width = "calc(var(--column-width-3) + var(--margin)";
    }
    document.getElementById("shopping-cart-slide").style.width = width;
}

const closeCart = document.getElementById('close-cart');
closeCart.onclick = function() {
    document.getElementById("shopping-cart-slide").style.width = "0";
}
