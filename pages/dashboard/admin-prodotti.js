const eliminaButtons = document.getElementsByClassName('elimina');
for(let elimina of eliminaButtons) {
    elimina.onclick = function() {

        const birraCard = elimina.parentNode.parentNode;
        const nomeBirra = birraCard.querySelector('#nome-birra');

        fetch('pages/dashboard/elimina-prodotto.php?nome=' + nomeBirra.textContent)
            .then(() => birraCard.remove());
    }
}