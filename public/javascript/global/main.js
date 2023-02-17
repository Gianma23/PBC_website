
/* =============== NAVIGATION SCROLL =============== */

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

/* ===============  MAPPA GOOGLE =============== */

function initMap() {

    const pbc = {lat: 43.54279735579751, lng: 10.335472798648};
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: pbc,
    });

    const marker = new google.maps.Marker({
        position: pbc,
        map: map,
    });
}

window.initMap = initMap;