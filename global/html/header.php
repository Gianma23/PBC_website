<header>
    <div class="nav-wrapper">
        <a class="homepage-link" href="index.php"><img class="header-logo" src="global/02-images/loghi/loghi_pbc/PBC_LOGO.jpg" alt="Piccolo Birrifico Clandestino"></a>

        <nav class="nav" id="nav">

            <ul class="nav__list" id="main-navigation" tabindex="-1" aria-label="main-navigation" hidden>
                <li class="nav__list__item"><a href="shop.php">Shop</a></li>
                <li class="nav__list__item"><a href="birre.php">Le Birre</a></li>
                <li class="nav__list__item"><a href="birrificio.php">Il Birrificio</a></li>
                <li class="nav__list__item"><a href="taproom.php">La Taproom</a></li>
                <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'contatti.php') { echo "active"; } ?>"><a href="contatti.php">Contatti</a></li>
            </ul>

            <a href="#nav" class="nav__toggle" role="button" aria-expanded="false" aria-controls="main-navigation">
                <svg class="icon-menu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 24" width="32" height="24">
                    <title>Toggle Menu</title>
                    <rect width="32" height="8"></rect>
                    <rect y="16" width="32" height="8"></rect>
                </svg>
            </a>

            <div class="nav__overlay">
                <svg xmlns="http://www.w3.org/2000/svg" id="visual" viewBox="0 0 960 540" width="960" height="540">
                    <path d="M0 328L26.7 334.8C53.3 341.7 106.7 355.3 160 336.5C213.3 317.7 266.7 266.3 320 234.5C373.3 202.7 426.7 190.3 480 211.8C533.3 233.3 586.7 288.7 640 294.2C693.3 299.7 746.7 255.3 800 241.5C853.3 227.7 906.7 244.3 933.3 252.7L960 261L960 541L933.3 541C906.7 541 853.3 541 800 541C746.7 541 693.3 541 640 541C586.7 541 533.3 541 480 541C426.7 541 373.3 541 320 541C266.7 541 213.3 541 160 541C106.7 541 53.3 541 26.7 541L0 541Z" fill="#0066FF" stroke-linecap="round" stroke-linejoin="miter"/>
                </svg>
            </div>
        </nav>

        <div class="nav__right">
            <button class="button button--login" type="button">Accedi</button>
            <a href="#"><img class="shopping-cart" src="global/02-images/icons/shopping_cart.png" alt="Carrello"></a>
        </div>
    </div>
</header>