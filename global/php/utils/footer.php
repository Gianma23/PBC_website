<footer>
    <section class="newsletter">
        <div class="container">
            <h3 class="secondary-heading">Resta aggiornato</h3>
            <p class="fs-500">Iscriviti alla nostra Newsletter per ricevere promozioni,
                consigli e novità sui prodotti! </p>
            <form action="">
                <ul>
                    <li class="form__email">
                        <label for="news-email">Email:</label><br>
                        <input type="email" id="news-email" name="email" placeholder="esempio@gmail.com" required><br>
                        <small class="error"></small>
                    </li>
                    <li>
                        <button type="submit" class="button button--secondary">ISCRIVITI</button>
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <div class="footer">
        <div class="container">
            <div class="footer__left">
                <div class="copyright">
                    <a href="#" aria-label="home"><img class="footer-logo" src="global/02-images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrificio Clandestino"></a>
                    <small>&copy;2022 Aura SRL</small>
                </div>
                <ul class="social-list">
                    <li>
                        <a href="#" aria-label="facebook"><img class="social-icon" src="global/02-images/icons/facebook.svg" alt=""></a>
                    </li>
                    <li>
                        <a href="#" aria-label="instagram"><img class="social-icon" src="global/02-images/icons/instagram.svg" alt=""></a>
                    </li>
                </ul>
            </div>
            <nav>
                <ul class="footer-nav">
                    <li class="footer-nav__list">Su di noi
                        <ul>
                            <li class="footer-nav__list__item"><a href="#">Privacy Policy</a></li>
                            <li class="footer-nav__list__item"><a href="#">Cookie Policy</a></li>
                            <li class="footer-nav__list__item"><a href="#">Sitemap</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Aiuto Cliente
                        <ul>
                            <li class="footer-nav__list__item"><a href="#">Info spedizioni</a></li>
                            <li class="footer-nav__list__item"><a href="#">Condizioni di vendita</a></li>
                            <li class="footer-nav__list__item"><a href="#">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Account
                        <ul>
                            <li class="footer-nav__list__item"><a href="#">Accedi o Registrati</a></li>
                            <li class="footer-nav__list__item"><a href="#">Dettagli Account</a></li>
                            <li class="footer-nav__list__item"><a href="#">Password dimenticata</a></li>
                            <li class="footer-nav__list__item"><a href="#">I tuoi ordini</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Contatti
                        <ul>
                                <li class="footer-nav__list__item">Telefono: <a href="tel:+390586 123942">+0586 123942</a></li>
                                <li class="footer-nav__list__item">E-mail: <a href="mailto:info@piccolobirrificioclandestino.it">info@piccolobirrificioclandestino.it</a></li>
                                <li class="footer-nav__list__item">Indirizzo: <a href="#">Via D. Cimarosa 37/39 - LIVORNO 57124</a></li>
                                <li class="footer-nav__list__item">Aperti dal lunedì al venerdì, dalle 9:00 alle 17:30</li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="legal">
                <small>P.I./C.F. 01665150494 - R.E.A. UD-206662 - Capitale Sociale € 90.000 i.v.</small>
            </div>
        </div>
    </div>
</footer>
<script src="global/javascript/main.js"></script>
<script src="global/javascript/form-validation.js"></script>
<?php
$jsUrl = "pages/".basename($_SERVER['PHP_SELF'], ".php")."/".basename($_SERVER['PHP_SELF'], ".php").".js";
if(file_exists($jsUrl))
    echo "<script src=\"$jsUrl\">";
?>