<footer>

    <section class="newsletter">
        <div class="container">
            <h3 class="secondary-heading">Resta aggiornato</h3>
            <p class="fs-500">Iscriviti alla nostra Newsletter per ricevere promozioni,
                consigli e novità sui prodotti! </p>
            <form id="newsletter-form" novalidate>
                <p class="form-elem form__email">
                    <label for="news-email">Email:</label><br>
                    <input type="email" id="news-email" name="email" placeholder="esempio@gmail.com" required><br>
                    <small class="error" id="error-newsletter"></small>
                </p>
                <p class="form-elem">
                    <button type="submit" class="button button--secondary">ISCRIVITI</button>
                    <small class="success" id="success-newsletter"></small>
                </p>
        </form>
        </div>
    </section>

    <div class="footer">
        <div class="container">
            <div class="footer__left">
                <div class="copyright">
                    <a href="<?= URL_ROOT?>/home" aria-label="home"><img class="footer-logo" src="<?= WEB_PATH?>/images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrificio Clandestino"></a>
                    <small>&copy;2023 Gianmaria Saggini</small>
                </div>
                <ul class="social-list">
                    <li>
                        <a href="https://www.facebook.com/pbclivorno" aria-label="facebook"><img class="social-icon" src="<?= WEB_PATH?>/images/icons/facebook.svg" alt=""></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/pbc_brewery/" aria-label="instagram"><img class="social-icon" src="<?= WEB_PATH?>/images/icons/instagram.svg" alt=""></a>
                    </li>
                </ul>
            </div>
            <nav>
                <ul class="footer-nav">
                    <li class="footer-nav__list">Su di noi
                        <ul>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">Privacy Policy</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">Cookie Policy</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">Sitemap</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Aiuto Cliente
                        <ul>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">Info spedizioni</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">Condizioni di vendita</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/home">FAQ</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Account
                        <ul>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/login">Accedi o Registrati</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/user-dashboard">Dettagli Account</a></li>
                            <li class="footer-nav__list__item"><a href="<?= URL_ROOT?>/user-ordini?page=1&how-many=10">I tuoi ordini</a></li>
                        </ul>
                    </li>
                    <li class="footer-nav__list">Contatti
                        <ul>
                                <li class="footer-nav__list__item">Telefono: <a href="tel:+390586123942">+0586 123942</a></li>
                                <li class="footer-nav__list__item">E-mail: <a href="mailto:info@piccolobirrificioclandestino.it">info@piccolobirrificioclandestino.it</a></li>
                                <li class="footer-nav__list__item">Indirizzo: <a href="https://tinyurl.com/yjc7wahv">Via D. Cimarosa 37/39 - LIVORNO 57124</a></li>
                                <li class="footer-nav__list__item">Aperti dal lunedì al venerdì, dalle 9:00 alle 17:30</li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="legal">
                <small>P.I./C.F. ??????????? - R.E.A. AA-XXXXX - Capitale Sociale € XX.xxx i.v.</small>
            </div>
        </div>
    </div>
</footer>

<!-- Javascript-->
<script src="<?= WEB_PATH?>/javascript/global/main.js"></script>
<script src="<?= WEB_PATH?>/javascript/global/form-validation.js"></script>
<script src="<?= WEB_PATH?>/javascript/global/cart.js"></script>
<script src="<?= WEB_PATH?>/javascript/global/newsletter.js"></script>
<?php
    $path =  explode( '/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[2];
    $jsUrl = "javascript/" . $path .".js";
    if(file_exists($jsUrl))
        echo '<script src="' . WEB_PATH . '/' . $jsUrl .'"></script>';
?>