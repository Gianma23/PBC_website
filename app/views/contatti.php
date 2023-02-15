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
                            <iframe class="map" src="https://maps.googleapis.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.0692301506583!2d10.333298951611132!3d43.542598767490134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d5ebedea14991d%3A0x5143657c42abe11e!2sPiccolo%20Birrificio%20Clandestino!5e0!3m2!1sit!2sit!4v1664006135201!5m2!1sit!2sit"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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