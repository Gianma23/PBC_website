/* =========== BARRA DI RICERCA =========== */

const searchBar = document.getElementById('search-bar');

searchBar.onkeydown = function(e) {

    if(e.key === 'Enter') {
        const nomeRicerca = searchBar.value;
        window.location.href = '/' + baseUrl + '/scaffale?nome=' + nomeRicerca;
    }
}