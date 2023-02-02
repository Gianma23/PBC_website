<header>
    <div class="nav-wrapper">
        <div class="header-logo">
            <a class="homepage-link" href="index.php"><img  src="images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrifico Clandestino"></a>
        </div>

        <nav class="nav" id="nav">
            <h2 hidden>Main Menu</h2>

            <input type="checkbox" class="nav__toggle visually-hidden" id="nav__toggle" aria-controls="primary-nav">
            <label for="nav__toggle" class="nav__toggle-label">
                <span></span>
                <span></span>
            </label>

            <ul class="nav__list" id="primary-nav" tabindex="-1">
                <li class="nav__list__item <?php if(strpos(($_SERVER['PHP_SELF']), 'shop')) echo "active"; ?>">
                    <a data-text="Shop" href="shop.php">Shop</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'birrificio.php') echo "active"; ?>">
                    <a data-text="Il Birrificio" href="birrificio.php">Il Birrificio</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'taproom.php') echo "active"; ?>">
                    <a data-text="La Taproom" href="taproom.php">La Taproom</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'contatti.php') echo "active"; ?>">
                    <a data-text="Contatti" href="contatti.php">Contatti</a>
                </li>
            </ul>
        </nav>

        <div class="nav__right">
            <?php
                if(isset($_SESSION["role"]) && $_SESSION["role"] == "user")
                    echo "<a href=\"user-dashboard.php\" class=\"button button--tertiary\" role=\"button\">Account</a>";
                else if(isset($_SESSION["role"]) && $_SESSION["role"] == "admin")
                    echo "<a href=\"admin-dashboard.php\" class=\"button button--tertiary\" role=\"button\">Account</a>";
                else
                    echo "<a href=\"login.php\" class=\"button button--tertiary\" role=\"button\">Accedi</a>";
            ?>
            <button id="cart-button" class="shopping-cart-link">
                <img class="shopping-cart" src="images/icons/shopping_cart.png" alt="Carrello">
            </button>
        </div>

        <!-- Carrello shopping -->
        <aside id="shopping-cart-slide" class="shopping-cart-slide" tabindex="-1">
            <a href="javascript:void(0)" class="closebtn" id="close-cart">&times;</a>
            <h2 class="fs-600 fw-bold">Carrello</h2>
            <ul class="prodotti-list" id="prodotti-list">

            </ul>
            <p class="totale" id="totale"></p>
            <div class="pulsanti-carrello">
                <a href="carrello.php" class="button" role="button">VISUALIZZA CARRELLO</a>
                <a href="spedizione.php" class="button button--secondary" role="button">PROCEDI ALL'ORDINE</a>
            </div>
        </aside>
    </div>
</header>

<div class="fab-button">
    <a href="documentation.html">Doc</a>
</div>

