<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/php/utils/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/php/utils/header.php"; ?>

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

        <section>
            <div class="container center">
                <h2 class="secondary-heading">Le più vendute</h2>
                <div class="cards-container">
                    <?php include "global/php/utils/piu-vendute.php"; ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container center">
                <h2 class="secondary-heading">Ultimi arrivi</h2>
                <?php include "global/php/utils/ultimi-arrivi.php" ?>
            </div>
        </section>
    </main>

    <?php include "global/php/utils/footer.php"; ?>

</body>
</html>