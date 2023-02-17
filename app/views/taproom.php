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
            <div class="wrapper">
                <h1 class="hero__title"><img src="<?= WEB_PATH?>/images/loghi/loghi_pbc/taproom_scritta_bianca.png" alt="Cimarosa 37, Taproom Livorno"></h1>
                <p class="fs-600 fw-bold">Aperto tutti i giorni dalle 18 alle 1:30</p>
                <div class="map" id="map"></div>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdpoSpwBgLMn-Cag6mdnUBXjn2gWuNvnY&callback=initMap&v=weekly"
                        defer></script>
            </div>
        </div>
    </section>

    <section class="taproom">
        <div class="container tile-section tile-section--left">
            <div class="tile-section__content">
                <h2 class="primary-heading">Gustati la nostra birra</h2>
                <p>Dall’aperitivo al dopo cena, puoi scegliere tra sedici diverse tipologie di birre alla spina di nostra
                    produzione, che si alternano in serate speciali con birre di produttori amici, e tra birre in bottiglia
                    firmate PBC e/o di birrifici ospiti .</p>
            </div>
            <div class="tile-section__img-container">
                <img src="<?= WEB_PATH?>/images/taproom/taproom-inside.png" alt="Fermentatori del birrificio">
            </div>
        </div>
    </section>

    <section class="fornitori">
        <div class="container center">
            <h2 class="secondary-heading">I nostri fornitori</h2>
            <ul class="fornitori-list">
                <li class="fornitori-list__item"><img src="<?= WEB_PATH?>/images/loghi/loghi_generici/dolcevita.png" alt="Pasticceria Dolcevita"></li>
                <li class="fornitori-list__item"><img src="<?= WEB_PATH?>/images/loghi/loghi_generici/La-rinasita.png" alt="la rinascita panificio livorno"></li>
                <li class="fornitori-list__item"><img src="<?= WEB_PATH?>/images/loghi/loghi_generici/ADC_logo.png" alt="L'angolo della carne, produzione propria di pronto cuici e insaccati"></li>
                <li class="fornitori-list__item"><img src="<?= WEB_PATH?>/images/loghi/loghi_generici/LOGO_doit.png" alt="du it, distilleria urbana italia"></li>
                <li class="fornitori-list__item"><img src="<?= WEB_PATH?>/images/loghi/loghi_generici/quadrato4.jpg" alt="quadrato 4"></li>
            </ul>
        </div>
    </section>

    <section class="social">
        <div class="container center">
            <h2 class="secondary-heading">Seguici sui social</h2>
            <ul class="social-list">
                <li>
                    <a href="https://www.facebook.com/pbctaproom/" aria-label="facebook"><img class="social-icon" src="<?= WEB_PATH?>/images/icons/facebook.svg" alt=""></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/pbc_taproom/" aria-label="instagram"><img class="social-icon" src="<?= WEB_PATH?>/images/icons/instagram.svg" alt=""></a>
                </li>
            </ul>
        </div>
    </section>

</main>
<?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>