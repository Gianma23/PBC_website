<header>
    <div class="nav-wrapper">
        <div class="header-logo">
            <a class="homepage-link" href="index.php"><img  src="global/02-images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrifico Clandestino"></a>
        </div>

        <nav class="nav" id="nav" aria-labelledby="mainmenulabel">
            <h2 id="mainmenulabel" hidden>Main Menu</h2>

            <input type="checkbox" class="nav__toggle" id="nav__toggle" onclick="lockScroll()">

            <ul class="nav__list" tabindex="-1">
                <li class="nav__list__item <?php if(strpos(($_SERVER['PHP_SELF']), 'shop')) { echo "active"; } ?>">
                    <a data-text="Shop" href="shop.php">Shop</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'birrificio.php') { echo "active"; } ?>">
                    <a data-text="Il Birrificio" href="birrificio.php">Il Birrificio</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'taproom.php') { echo "active"; } ?>">
                    <a data-text="La Taproom" href="taproom.php">La Taproom</a>
                </li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'contatti.php') { echo "active"; } ?>">
                    <a data-text="Contatti" href="contatti.php">Contatti</a>
                </li>
            </ul>

            <label for="nav__toggle" class="nav__toggle-label">
                <span></span>
                <span></span>
            </label>

            <div class="nav__bg"></div>

        </nav>

        <div class="nav__right">
            <a href="login.php" class="button button--login" type="button">Accedi</a>
            <a href="#" onclick="openNav()" class="shopping-cart-link"><img class="shopping-cart" src="global/02-images/icons/shopping_cart.png" alt="Carrello"></a>
        </div>
    </div>
</header>

<div id="shopping-cart-slide" class="shopping-cart-slide">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Clients</a>
    <a href="#">Contact</a>
</div>