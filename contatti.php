<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="lorem ipsum">
    <!-- favicon list made with RealFaviconGenerator.net -->
    <link rel="apple-touch-icon" sizes="180x180" href="/global/02-images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/global/02-images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/global/02-images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/global/02-images/favicon/manifest.json">
    <link rel="mask-icon" href="/global/02-images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-config" content="/global/02-images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="global/01-css/style-reset.css">
    <link rel="stylesheet" href="global/01-css/grid.css">
    <link rel="stylesheet" href="pages/contatti/contatti.css">

    <title>Contatti - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php
        include "global/html/header.php";
    ?>

    <main>
        <div class="container">
            <div class="even-column">
                <section class="contatti">
                    <h1 class="fs-900 fw-bold">Contatti</h1>
                    <ul>
                        <li class="contatti__item">
                            <h2>E-mail</h2>
                            <img src="global/02-images/icons/email.svg" alt="">
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
                            <img src="global/02-images/icons/phone.svg" alt="">
                            <p class="recapiti">+0586 854439</p>
                        </li>
                        <li class="contatti__item">
                            <h2>Orario</h2>
                            <img src="global/02-images/icons/clock.svg" alt="">
                            <p class="recapiti">Dal lunedì al venerdì dalle 9.00 alle 17.30</p>
                        </li>
                        <li class="contatti__item">
                            <h2>Dove siamo</h2>
                            <img src="global/02-images/icons/dove_siamo.svg" alt="">
                            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.0692301506583!2d10.333298951611132!3d43.542598767490134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12d5ebedea14991d%3A0x5143657c42abe11e!2sPiccolo%20Birrificio%20Clandestino!5e0!3m2!1sit!2sit!4v1664006135201!5m2!1sit!2sit"
                                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </li>
                    </ul>
                </section>
                <section class="forms">
                    <div class="container-form container-form--clienti left-bleed">
                        <h2>Serve una mano?</h2>
                        <p>Hai domande o dubbi? Hai problemi con la spedizione o ti serve qualche chiarimento? Scrivici per qualsiasi cosa!</p>
                        <form name="form-clienti" action="">
                            <ul>
                                <li>
                                    <label for="nome-cognome-cliente">Nome e Cognome:</label><br>
                                    <input type="text" id="nome-cognome-cliente" name="nome e cognome"></li>
                                <li>
                                    <label for="email-cliente">Email:</label><br>
                                    <input type="email" id="email-cliente" name="email">
                                </li>
                                <li>
                                    <label for="messaggio-cliente">Messaggio:</label><br>
                                    <textarea id="messaggio-cliente" name="messaggio"></textarea>
                                </li>
                                <li>
                                    <input type="checkbox" id="privacy-policy-cliente" name="privacy policy">
                                    <label for="privacy-policy-cliente">Accetto le condizioni del sium</label></li>
                                <li>
                                    <button type="button" class="button button--secondary">INVIA EMAIL</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="container-form container-form--rivenditori text-neutral-100 left-bleed">
                        <h2>Sei un rivenditore?</h2>
                        <p>Hai un locale o una distribuzione e sei interessato alle nostre birre?</p>
                        <form name="form-rivenditori" action="">
                            <ul>
                                <li>
                                    <label for="nome-cognome-rivenditore">Nome e Cognome:</label><br>
                                    <input type="text" id="nome-cognome-rivenditore" name="nome e cognome"></li>
                                <li>
                                    <label for="email-rivenditore">Email:</label><br>
                                    <input type="email" id="email-rivenditore" name="email">
                                </li>
                                <li>
                                    <label for="messaggio-rivenditore">Messaggio:</label><br>
                                    <textarea id="messaggio-rivenditore" name="messaggio"></textarea>
                                </li>
                                <li>
                                    <input type="checkbox" id="privacy-policy-rivenditore" name="privacy policy">
                                    <label for="privacy-policy-rivenditore">Accetto le condizioni del sium</label></li>
                                <li>
                                    <button type="button" class="button">INVIA EMAIL</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>