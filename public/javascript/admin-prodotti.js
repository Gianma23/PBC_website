const eliminaButtons = document.getElementsByClassName('elimina');
for(let elimina of eliminaButtons) {
    elimina.onclick = function() {

        const birraCard = elimina.parentNode.parentNode;
        const nomeBirra = birraCard.querySelector('#nome-birra');
        const nome = nomeBirra.textContent.replaceAll(" ", "%20");

        fetch('pages/dashboard/elimina-prodotto.php?nome=' + nome)
            .then((res) => birraCard.remove());
    }
}

/* MOSTRA INPUT AGGIUNTIVI BIRRA */

const categoriaSelect = document.getElementById('categoria');
categoriaSelect.onchange = function() {
    const infoBirra = document.getElementById('info-birra');
    if(categoriaSelect.value !== 'birra')
        infoBirra.style.display = 'none';
    else
        infoBirra.style.display = 'flex';

}
