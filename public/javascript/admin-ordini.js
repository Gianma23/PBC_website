const ORDINI_PAGINA = 10;
const currentPage = Number(new URLSearchParams(window.location.search).get('page'));

/* CARICAMENTO LISTA ORDINI */

fetch('ordine/carica-ordini' + window.location.search)
    .then((res) => res.json())
    .then((data) => {
        creaTabellaOrdiniAdmin(data);
        creaPaginazione(data);
    });

/* CAMBIO STATO ORDINE */

function statoHandler(e) {
    const tabellaOrdini = document.getElementById('ordini-table');

    const index = e.currentTarget.parentNode.rowIndex;
    const orderId = tabellaOrdini.rows[index-1].cells[0].textContent;

    fetch('ordine/aggiorna-stato?order=' + orderId + '&status=' +  e.target.value);
}

/* FUNZIONI DI UTILITA */

function creaTabellaOrdiniAdmin(data) {
    const tabellaOrdini = document.getElementById('ordini-table');

    for (const ordineString of data['ordini']) {
        const ordine = JSON.parse(ordineString);

        const tr = document.createElement('tr');
        tabellaOrdini.appendChild(tr);

        // cella id
        const idCell = document.createElement('td');
        idCell.textContent = ordine['id'];
        tr.appendChild(idCell);

        // cella email
        const emailCell = document.createElement('td');
        emailCell.textContent = ordine['account_id'] === null ? ordine['email'] : ordine['account_id'];
        tr.appendChild(emailCell);

        // cella totale
        const totaleCell = document.createElement('td');
        totaleCell.textContent = ordine['total'] + '\u20AC';
        tr.appendChild(totaleCell);

        // cella stato
        const statoCell = document.createElement('td');
        const select = document.createElement('select');
        console.log(ordine['status'])
        statoCell.appendChild(select);

        const optionElaborazione = document.createElement('option');
        optionElaborazione.textContent = 'elaborazione';
        select.appendChild(optionElaborazione);

        const optionInTransito = document.createElement('option');
        optionInTransito.textContent = 'in transito';
        select.appendChild(optionInTransito);

        const optionSpedito = document.createElement('option');
        optionSpedito.textContent = 'spedito';
        select.appendChild(optionSpedito);

        const optionCancellato = document.createElement('option');
        optionCancellato.textContent = 'cancellato';
        select.appendChild(optionCancellato);

        select.value = ordine['status'];
        statoCell.addEventListener('click', statoHandler);
        tr.appendChild(statoCell);

        //cella bottone per modificare
        const rimuoviCell = document.createElement('td');
        const buttonVisualizza = document.createElement('a');
        buttonVisualizza.href = '/' + baseUrl + '/dettagli-ordine/' + ordine['id'];
        rimuoviCell.appendChild(buttonVisualizza);
        tr.appendChild(rimuoviCell);
    }
}

function creaPaginazione(data) {
    const listaPagine = document.getElementById('lista-pagine');

    const totaleOrdini = data['count'];
    const totalePagine = Math.ceil(totaleOrdini / ORDINI_PAGINA);

    // Pulsante precedente
    if(currentPage !== 1) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        listaPagine.appendChild(li);

        const a = document.createElement('a');
        a.href = '/' + baseUrl + `/admin-ordini?page=${(currentPage-1)}&how-many=${ORDINI_PAGINA}`;
        a.textContent = 'Precedente';
        li.appendChild(a);
    }

    // indice pagina corrente
    const li = document.createElement('li');
    li.classList.add('page-item');
    li.textContent = String(currentPage);
    listaPagine.appendChild(li);

    // Pulsante successivo
    if(currentPage !== totalePagine) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        listaPagine.appendChild(li);

        const a = document.createElement('a');
        a.href = '/' + baseUrl + `/admin-ordini?page=${(currentPage+1)}&how-many=${ORDINI_PAGINA}`;
        a.textContent = 'Successivo';
        li.appendChild(a);
    }

}







