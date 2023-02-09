fetch('ordine/carica-ordini')
    .then((res) => res.json())
    .then((data) => {
        console.log(data)
        creaTabellaOrdiniAdmin(data);
    });

function creaTabellaOrdiniAdmin(data) {
    const tabellaOrdini = document.getElementById('ordini-table');

    for (const ordineString of data) {
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
        statoCell.textContent = ordine['status'];
        tr.appendChild(statoCell);

        /* cella bottone per modificare TODO
        const rimuoviCell = document.createElement('td');
        const buttonRimuovi = document.createElement('button');
        buttonRimuovi.textContent = '\u00D7';
        buttonRimuovi.classList.add('remove-ordine');
        buttonRimuovi.id = ordine['name'];
        rimuoviCell.appendChild(buttonRimuovi);
        tr.appendChild(rimuoviCell);
        buttonRimuovi.addEventListener('click', rimuoviHandler);*/
    }
}