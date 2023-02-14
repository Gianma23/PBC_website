const ORDINI_PAGINA = 10;
const currentPage = Number(new URLSearchParams(window.location.search).get('page'));

/* CARICAMENTO LISTA ORDINI */

fetch('ordine/carica-ordini' + window.location.search)
    .then((res) => res.json())
    .then((data) => {
        if(JSON.stringify(data) !== JSON.stringify({})) {
            creaTabellaOrdiniUser(data);
            creaPaginazione(data);
        }
    });

/* FUNZIONI DI UTILITA */

function creaTabellaOrdiniUser(data) {
    const tabellaOrdini = document.getElementById('ordini-table');

    for (const ordineString of data['ordini']) {
        const ordine = JSON.parse(ordineString);

        const tr = document.createElement('tr');
        tabellaOrdini.appendChild(tr);

        // cella id
        const idCell = document.createElement('td');
        idCell.textContent = ordine['id'];
        tr.appendChild(idCell);

        // cella totale
        const totaleCell = document.createElement('td');
        totaleCell.textContent = ordine['total'] + '\u20AC';
        tr.appendChild(totaleCell);

        // cella stato
        const statoCell = document.createElement('td');
        statoCell.textContent = ordine['status'];
        tr.appendChild(statoCell);

        //cella bottone per visualizzare
        const visualizzaCell = document.createElement('td');
        const buttonVisualizza = document.createElement('a');
        buttonVisualizza.href = '/' + baseUrl + '/dettagli-ordine/' + ordine['id'];
        visualizzaCell.appendChild(buttonVisualizza);
        tr.appendChild(visualizzaCell);
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







