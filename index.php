<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/html/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/html/header.php"; ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1 class="hero__title">LA BIRRA ARTIGIANALE <br><strong>CHE CERCAVI</strong></h1>
                <p>Produciamo una vasta gamma di birre per <strong class="fw-bold">qualsiasi gusto</strong> e per <strong class="fw-bold">qualsiasi situazione</strong>.</p>
                <button type="button" class="button">VAI ALLO SHOP</button>
            </div>
        </section>

        <section class="birre">
            <div class="container tile-section">
                <div class="tile-section__birre">
                    <h2 class="primary-heading">La nostra birra</h2>
                    <p>Birre <strong>espressive e di carattere</strong> che vogliono unire la piacevolezza e la facilità di beva alla
                        <strong>continua ricerca ed innovazione</strong>, legate a doppio filo sia alla realtà territoriale labronica
                        che alle realtà esterne, che hanno permesso negli anni di collaborare anche con altre realtà
                        brassicole e ottenere premi e riconoscimenti a livello <strong>nazionale e internazionale</strong>.</p>
                    <button type="button" class="button">SCOPRI LE BIRRE</button>
                </div>
                <div class="tile-section__birre__img-container">
                    <img src="" alt="Birra Riappala 2.0">
                </div>
            </div>
        </section>

        <section class="birrificio">
            <div class="container tile-section">
                <div class="tile-section__birrificio__img-container">
                    <img src="pages/index/images/birrificio-599x400.png" alt="Fermentatori del birrificio">
                </div>
                <div class="tile-section__birrificio">
                    <h2 class="primary-heading">Il birrificio</h2>
                    <p>Nella nuova sede dove ci siamo da poco trasferiti possiamo vantare un impianto produttivo di
                        10 hL di doppia cotta, una cantina di 190 hL e un laboratorio di Controllo Qualità interno,
                        al fine di elevare il livello della produzione e ottimizzare le risorse. </p>
                    <button type="button" class="button">VISITA IL BIRRIFICIO</button>
                </div>
            </div>
        </section>

        <section class="taproom">
            <h2 class="secondary-heading">Provale ora nella nostra Taproom...</h2>
            <img src="global/02-images/taproom/taproom-outside.jpg" alt="Esterno della Taproom in via Cimarosa 37, Livorno">
        </section>

        <section class="shop">
            <div class="container">
                <h2 class="secondary-heading">...o dove vuoi!</h2>
            </div>
        </section>

        <section class="rivenditori">
            <div class="container">
                <h2 class="fs-secondary-heading fw-bold">Sei un rivenditore?</h2>
                <p class="fs-500">Hai un locale o una distribuzione e sei interessato alle nostre birre?</p>
                <form name="form-rivenditori" action="">
                    <ul class="form-rivenditori">
                        <li class="form-rivenditori__nome-cognome">
                            <label for="nome-cognome">Nome e Cognome:</label><br>
                            <input type="text" id="nome-cognome" name="nome cognome">
                        </li>
                        <li class="form-rivenditori__email">
                            <label for="email">Email:</label><br>
                            <input type="email" id="email" name="email">
                        </li>
                        <li class="form-rivenditori__messaggio">
                            <label for="messaggio">Messaggio:</label><br>
                            <textarea id="messaggio" name="messaggio" ></textarea>
                        </li>
                        <li class="form-rivenditori__privacy-policy checkbox-container">
                            <input type="checkbox" id="privacy-policy" name="privacy policy">
                            <label for="privacy-policy">Accetto le condizioni del sium</label></li>
                        <li class="form-rivenditori__button">
                            <button type="button" class="button">INVIA EMAIL</button>
                        </li>
                    </ul>
                </form>
            </div>
        </section>
    </main>
    <?php include "global/html/footer.php"; ?>
</body>
</html>