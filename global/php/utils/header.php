<header>
    <div class="nav-wrapper">
        <div class="header-logo">
            <a class="homepage-link" href="index.php"><img  src="global/images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrifico Clandestino"></a>
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
                session_start();
                if(isset($_SESSION["account"]) && $_SESSION["account"] == "user")
                    echo "<a href=\"user-dashboard.php\" class=\"button button--tertiary\" type=\"button\">Account</a>";
                else if(isset($_SESSION["account"]) && $_SESSION["account"] == "admin")
                    echo "<a href=\"admin-dashboard.php\" class=\"button button--tertiary\" type=\"button\">Account</a>";
                else
                    echo "<a href=\"login.php\" class=\"button button--tertiary\" type=\"button\">Accedi</a>";
            ?>
            <button onclick="openCart()" class="shopping-cart-link" aria-controls="shopping-cart-slide">
                <img class="shopping-cart" src="global/images/icons/shopping_cart.png" alt="Carrello">
            </button>
        </div>

        <div id="shopping-cart-slide" class="shopping-cart-slide" tabindex="-1">
            <a href="javascript:void(0)" class="closebtn" id="close-cart">&times</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a>
        </div>
    </div>
</header>

<div class="fab-button">
    <a href="documentation.html">Doc</a>
</div>

