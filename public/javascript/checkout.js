const totaleCarrello = document.getElementById('riepilogo-totale-carrello');
const stimaSpedizione = document.getElementById('riepilogo-stima-spedizione');
const totaleOrdine = document.getElementById('riepilogo-totale-ordine');

totaleOrdine.textContent = Number.parseFloat(stimaSpedizione.textContent) + Number.parseFloat(totaleCarrello.textContent) + '\u20AC';


