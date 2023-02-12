<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
</head>
<body>

<?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <section class="hero">
            <div class="container">
                <h1 class="hero__title">LA BIRRA ARTIGIANALE <br><strong>CHE CERCAVI</strong></h1>
                <p>Produciamo una vasta gamma di birre per <strong class="fw-bold">qualsiasi gusto</strong> e per <strong class="fw-bold">qualsiasi situazione</strong>.</p>
                <a href="<?= URL_ROOT?>/shop" class="button button--hero" role="button">VAI ALLO SHOP</a>
            </div>
        </section>

        <section>
            <div class="container tile-section tile-section--left">
                <div class="tile-section__content">
                    <h2 class="primary-heading">La nostra birra</h2>
                    <p>Birre <strong>espressive e di carattere</strong> che vogliono unire la piacevolezza e la facilità di beva alla
                        <strong>continua ricerca ed innovazione</strong>, legate a doppio filo sia alla realtà territoriale labronica
                        che alle realtà esterne, che hanno permesso negli anni di collaborare anche con altre realtà
                        brassicole e ottenere premi e riconoscimenti a livello <strong>nazionale e internazionale</strong>.</p>
                    <a href="<?= URL_ROOT?>/scaffale/birra" class="button" role="button">SCOPRI LE BIRRE</a>
                </div>
                <div class="tile-section__img-container">
                    <img src="<?= WEB_PATH?>/images/background/Riappala.png" id="hero-image" alt="Birra Riappala 2.0">
                </div>
            </div>
        </section>

        <section>
            <div class="container tile-section tile-section--right">
                <div class="tile-section__content">
                    <h2 class="primary-heading">Il birrificio</h2>
                    <p>Nella nuova sede dove ci siamo da poco trasferiti possiamo vantare un impianto produttivo di
                        10 hL di doppia cotta, una cantina di 190 hL e un laboratorio di Controllo Qualità interno,
                        al fine di elevare il livello della produzione e ottimizzare le risorse. </p>
                    <a href="birrificio" class="button" role="button">VISITA IL BIRRIFICIO</a>
                </div>
                <div class="tile-section__img-container">
                    <img src="<?= WEB_PATH?>/images/birrificio/impianto-599x400.png" alt="Fermentatori del birrificio">
                </div>
            </div>
        </section>

        <section class="taproom">
            <h2 class="secondary-heading">Provale ora nella nostra Taproom...</h2>
            <a href="<?= URL_ROOT?>/taproom"><img class="taproom__img" src="<?= WEB_PATH?>/images/taproom/taproom-outside.jpg" alt="Esterno della Taproom in via Cimarosa 37, Livorno"></a>
        </section>

        <section class="shop">
            <div class="container center">
                <h2 class="secondary-heading">...o dove vuoi!</h2>
                <div class="cards-container">
                    <?php include __DIR__ . "/utils/quasi_esaurite.php"; ?>
                </div>
            </div>
        </section>

    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>