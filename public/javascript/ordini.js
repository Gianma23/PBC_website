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