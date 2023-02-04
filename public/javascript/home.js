const heroImage = document.getElementById('hero-image');

document.body.onload = calcolaTopImmagine;
window.onscroll = calcolaTopImmagine;

function calcolaTopImmagine() {
    let top = window.scrollY + window.innerHeight * 0.3;
    if(top < window.innerHeight + 120)
        heroImage.style.top = `calc(${top}px)`;
}