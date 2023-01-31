<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/php/utils/head.php"; ?>
    <link rel="stylesheet" href="pages/shop/shop.css">
    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/php/utils/header.php"; ?>

    <main>
        <?php include "global/php/utils/shop-nav.php"; ?>

        <section class="hero">
            <div class="container">
                <div class="left">
                    <h1 class="secondary-heading" id="nome">Nome birra</h1>
                    <p id="stile">Stile</p>
                    <p id="tagline">Tagline</p>
                </div>
                <div class="right">
                    <p id="descrizione">descrizione</p>
                    <button class="button button--shop">
                        <span class="button-image"></span>
                        AGGIUNGI
                    </button>
                </div>
                <div class="img-slider">
                </div>
            </div>
        </section>

        <section id="info-birra">
            <div class="container center">
                <h2 class="secondary-heading">Ultimi arrivi</h2>
                <?php include "global/php/shop-queries/ultimi-arrivi.php" ?>

            </div>
        </section>
    </main>

    <?php include "global/php/utils/footer.php"; ?>

    <script src="pages/scaffale/scaffale.js"></script>
</body>
</html>