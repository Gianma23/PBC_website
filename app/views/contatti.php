<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <div class="even-column">
                
                <section>
                    <h1 class="primary-heading fw-bold">Contatti</h1>
                    <ul>
                        <li class="contatti__item">
                            <h2>E-mail</h2>
                            <img src="<?= WEB_PATH?>/images/icons/email.svg" alt="">
                            <address class="fw-medium fs-500">
                                <ul>
                                    <li class="emails__item">
                                        Per informazioni: <br>
                                        <a href="mailto:info@piccolobirrificioclandestino.it">info@piccolobirrificioclandestino.it</a>
                                    </li>
                                    <li class="emails__item">
                                        Per rivenditori e commercianti: <br>
                                        <a href="mailto:commerciale@piccolobirrificioclandestino.it">commerciale@piccolobirrificioclandestino.it</a>
                                    </li>
                                </ul>
                            </address>
                        </li>
                        <li class="contatti__item">
                            <h2>Telefono</h2>
                            <img src="<?= WEB_PATH?>/images/icons/phone.svg" alt="">
                            <p class="recapiti">+0586 854439</p>
                        </li>
                        <li class="contatti__item">
                            <h2>Orario</h2>
                            <img src="<?= WEB_PATH?>/images/icons/clock.svg" alt="">
                            <p class="recapiti">Dal lunedì al venerdì dalle 9.00 alle 17.30</p>
                        </li>
                        <li class="contatti__item">
                            <h2>Dove siamo</h2>
                            <img src="<?= WEB_PATH?>/images/icons/dove_siamo.svg" alt="">
                            <div class="map" id="map"></div>

                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdpoSpwBgLMn-Cag6mdnUBXjn2gWuNvnY&libraries=places&callback=initMap&v=weekly"
                                    defer></script>
                        </li>
                    </ul>
                </section>

                <section class="forms">

                    <div class="container-form container-form--clienti left-bleed">
                        <h2>Serve una mano?</h2>
                        <p>Hai domande o dubbi? Hai problemi con la spedizione o ti serve qualche chiarimento? Scrivici per qualsiasi cosa!</p>
                        <form class="email-form" novalidate>
                            <input type="hidden" value="cliente" name="tipo">
                            <p class="form-elem">
                                <label for="nome-cognome-cliente">Nome e Cognome:</label><br>
                                <input type="text" id="nome-cognome-cliente" name="nome-cognome" required>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="email-cliente">Email:</label><br>
                                <input type="email" id="email-cliente" name="email" required>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="messaggio-cliente">Messaggio:</label><br>
                                <textarea id="messaggio-cliente" name="messaggio" required></textarea>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <small class="error email-text"></small>
                                <button type="submit" class="button button--secondary">INVIA EMAIL</button>
                            </p>
                        </form>
                    </div>

                    <div class="container-form container-form--rivenditori text-neutral-100 left-bleed">
                        <h2>Sei un rivenditore?</h2>
                        <p>Hai un locale o una distribuzione e sei interessato alle nostre birre?</p>
                        <form class="email-form" novalidate>
                            <input type="hidden" value="rivenditore" name="tipo">
                            <p class="form-elem">
                                <label for="nome-cognome-riv">Nome e Cognome:</label><br>
                                <input type="text" id="nome-cognome-riv" name="nome-cognome" required>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="email-riv">Email:</label><br>
                                <input type="email" id="email-riv" name="email" required>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="messaggio-riv">Messaggio:</label><br>
                                <textarea id="messaggio-riv" name="messaggio" required></textarea>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <small class="error email-text"></small>
                                <button type="submit" class="button">INVIA EMAIL</button>
                            </p>
                        </form>
                    </div>

                </section>
            </div>
        </div>
    </main>
    <?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>