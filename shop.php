<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/html/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/html/header.php"; ?>

    <main>
        <div class="secondary-nav" role="navigation" aria-label="shop">
            <div class="container">



                <ul class="nav__list" tabindex="-1">
                    <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'birrificio.php') { echo "active"; } ?>">
                        <a data-text="Birre" href="shop-birre.php">Birre</a>
                    </li>
                    <li class="nav__list__item <?php if(basename($_SERVER['PHP_SELF']) == 'birrificio.php') { echo "active"; } ?>">
                        <a data-text="Box Birre" href="shop-box-birre.php">Box Birre</a>
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

    </main>

    <?php include "global/html/footer.php"; ?>

</body>
</html>