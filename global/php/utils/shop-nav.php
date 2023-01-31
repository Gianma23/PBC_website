<div class="secondary-nav" role="navigation" aria-label="shop">
    <div class="container">

        <ul class="sec-nav__list" tabindex="-1">
            <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'birrificio.php') { echo "active"; } ?>">
                <a data-text="Birre" href="scaffale.php?categoria=birra&stile=ipa">Birre</a>
            </li>
            <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'taproom.php') { echo "active"; } ?>">
                <a data-text="Merchandising" href="shop-merchandising.php">Merchandising</a>
            </li>
        </ul>

        <div class="search-container">
            <label for="search-bar"></label>
            <input type="search" id="search-bar" placeholder="Cerca nello shop">
        </div>

        <small>SPEDIZIONE GRATUITA PER ORDINI SUPERIORI A 89€ E PER IL COMUNE DI LIVORNO</small>

    </div>
</div>
