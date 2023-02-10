
/* ======= PULSANTE RIMOZIONE PRODOTTO ======= */

const eliminaButtons = document.getElementsByClassName('elimina');

for(let elimina of eliminaButtons) {
    elimina.onclick = function() {

        const prodottoCard = elimina.parentNode.parentNode;
        const nomeProdotto = prodottoCard.querySelector('#nome-prodotto').textContent;

        fetch('admin/elimina-prodotto/' + nomeProdotto)
            .then((res) => res.text())
            .then((text) =>  {
                prodottoCard.remove()
                console.log(text)
        });
    }
}

/* ======= PULSANTE MODIFICA PRODOTTO ======= */
//TODO: modifica prodotto

