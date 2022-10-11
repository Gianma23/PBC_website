<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/html/head.php"; ?>

    <title>Contatti - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/html/header.php"; ?>

    <main>
        <div class="container">
            <div class="even-column">
                <section class="contatti">
                    <h1 class="primary-heading fw-bold">Contatti</h1>
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
                                <li class="form__messaggio">
                                    <label for="messaggio-cliente">Messaggio:</label><br>
                                    <textarea id="messaggio-cliente" name="messaggio"></textarea>
                                </li>
                                <li class="">
                                    <button type="button" class="button button--secondary">INVIA EMAIL</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="container-form container-form--rivenditori text-neutral-100 left-bleed">
                        <h2>Sei un rivenditore?</h2>
                        <p>Hai un locale o una distribuzione e sei interessato alle nostre birre?</p>
                        <form name="form-rivenditori" action="">
                            <ul class="form-rivenditori">
                                <li class="form__nome-cognome">
                                    <label for="nome-cognome">Nome e Cognome:</label><br>
                                    <input type="text" id="nome-cognome" name="nome cognome">
                                </li>
                                <li class="form__email">
                                    <label for="email">Email:</label><br>
                                    <input type="email" id="email" name="email">
                                </li>
                                <li class="form__messaggio">
                                    <label for="messaggio">Messaggio:</label><br>
                                    <textarea id="messaggio" name="messaggio" ></textarea>
                                </li>
                                <li class="form__button">
                                    <button type="button" class="button">INVIA EMAIL</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <?php include "global/html/footer.php"; ?>
</body>
</html>