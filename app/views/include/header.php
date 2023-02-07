<header>
    <div class="nav-wrapper">
        <div class="header-logo">
            <a class="homepage-link" href="<?= URL_ROOT?>/home"><img  src="<?= WEB_PATH?>/images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrifico Clandestino"></a>
        </div>

        <nav class="nav" id="nav">
            <h2 hidden>Main Menu</h2>

            <input type="checkbox" class="nav__toggle visually-hidden" id="nav__toggle" aria-controls="primary-nav">
            <label for="nav__toggle" class="nav__toggle-label">
                <span></span>
                <span></span>
            </label>

            <ul class="nav__list" id="primary-nav" tabindex="-1">
                <li class="nav__list__item <?php if(strpos($_SERVER['REQUEST_URI'], 'shop')) echo "active"; ?>">
                    <a data-text="Shop" href="<?= URL_ROOT?>/shop">Shop</a>
                </li>
                <li class="nav__list__item <?php if(strpos($_SERVER['REQUEST_URI'],'birrificio')) echo "active"; ?>">
                    <a data-text="Il Birrificio" href="<?= URL_ROOT?>/birrificio">Il Birrificio</a>
                </li>
                <li class="nav__list__item <?php if(strpos($_SERVER['REQUEST_URI'], 'taproom')) echo "active"; ?>">
                    <a data-text="La Taproom" href="<?= URL_ROOT?>/taproom">La Taproom</a>
                </li>
                <li class="nav__list__item <?php if(strpos($_SERVER['REQUEST_URI'], 'contatti')) echo "active"; ?>">
                    <a data-text="Contatti" href="<?= URL_ROOT?>/contatti">Contatti</a>
                </li>
            </ul>
        </nav>

        <div class="nav__right">
            <?php
                if(isset($_SESSION["role"]) && $_SESSION["role"] == "user")
                    echo "<a href=\"" . URL_ROOT . "/user-dashboard\" class=\"button button--tertiary\" role=\"button\">
                            <span>Account</span></a>";
                else if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
                    echo "<a href=\"" . URL_ROOT . "/admin-dashboard\" class=\"button button--tertiary\" role=\"button\">
                          <span>Account</span></a>";
                else
                    echo "<a href=\"" . URL_ROOT . "/login\" class=\"button button--tertiary\" role=\"button\">
                          <span>Accedi</span></a>";
            ?>

            <button id="cart-button" class="shopping-cart-link">
                <img class="shopping-cart" src="<?= WEB_PATH?>/images/icons/shopping_cart.png" alt="Carrello">
            </button>
        </div>

        <!-- Carrello shopping -->
        <aside id="shopping-cart-slide" class="shopping-cart-slide" tabindex="-1">
            <button class="closebtn" id="close-cart">&times;</button>
            <h2 class="fs-600 fw-bold">Carrello</h2>

            <div id="carrello">
                <ul class="prodotti-list" id="prodotti-list">
                </ul>

                <p class="totale" id="totale"></p>
                <div class="pulsanti-carrello">
                    <a href="<?= URL_ROOT?>/carrello" class="button" role="button">VISUALIZZA CARRELLO</a>
                    <a href="<?= URL_ROOT?>/checkout" class="button button--secondary" role="button">PROCEDI ALL'ORDINE</a>
                </div>
            </div>
        </aside>
    </div>
</header>

<div class="fab-button">
    <a target="_blank" href="<?= WEB_PATH?>/documentation.html">Doc</a>
</div>

