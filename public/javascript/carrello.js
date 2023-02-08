/* Aggiornamento stima spedizione */
const opzioniStima = document.getElementsByName('stima-spese');
const totaleCarrello = document.getElementById('riepilogo-totale-carrello');
const stimaSpedizione = document.getElementById('riepilogo-stima-spedizione');
const totaleOrdine = document.getElementById('riepilogo-totale-ordine');

opzioniStima.forEach(opzione => opzione.oninput = function(e) {

    if(opzione.checked) {
        stimaSpedizione.textContent = opzione.value;
    }

    totaleOrdine.textContent = String(Number.parseFloat(opzione.value) + Number.parseFloat(totaleCarrello.textContent));
});
