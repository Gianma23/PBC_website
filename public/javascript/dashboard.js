const esciButton = document.getElementById('esci');

esciButton.onclick = function() {

    fetch('auth/logout')
        .then(res => res.json())
        .then(data => {
            if(data['success'])
                window.location.replace(data['text']);
        });
}