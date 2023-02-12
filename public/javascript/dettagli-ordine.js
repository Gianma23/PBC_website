/* =============================================== */
/* =====           CARICA ITEM ORDINE        ===== */
/* =============================================== */

const queryOrdine = window.location.pathname.split('/').at(-1);

fetch('/' + baseUrl + '/ordine/carica-items-ordine/' + queryOrdine)
    .then((res) => res.json())
    .then((data) => {
        creaTabellaOrdine(data);
    });

function creaTabellaOrdine(data) {
    const tabellaOrdine = document.getElementById('items-ordine-table');

    for (const prodottoString in data) {
        const prodotto = JSON.parse(prodottoString);

        const tr = document.createElement('tr');
        tabellaOrdine.appendChild(tr);

        // cella immagine nome prodotto
        const prodottoCell = document.createElement('td');
        const divImg = document.createElement('div');
        divImg.classList.add('img-prodotto')
        const imgProdotto = document.createElement('img');
        imgProdotto.alt = prodotto['name'];
        imgProdotto.src = prodotto['img_path'];
        const nomeProdotto = document.createElement('p');
        nomeProdotto.textContent = prodotto['name'];
        divImg.appendChild(imgProdotto)
        prodottoCell.appendChild(divImg);
        prodottoCell.appendChild(nomeProdotto);
        tr.appendChild(prodottoCell);

        // cella prezzo
        const prezzoCell = document.createElement('td');
        prezzoCell.textContent = prodotto['price'] + '\u20AC';
        tr.appendChild(prezzoCell);

        // cella quantita
        const quantitaCell = document.createElement('td');
        quantitaCell.textContent = data[prodottoString];
        tr.appendChild(quantitaCell);

        // cella subtotale
        let subtotale = prodotto['price'] * data[prodottoString];
        const subtotCell = document.createElement('td');
        subtotCell.textContent = subtotale.toFixed(2) + '\u20AC';
        tr.appendChild(subtotCell);
    }
}









