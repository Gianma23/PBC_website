<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/shop.css">
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <?php include __DIR__ . "/include/shop-nav.php"; ?>

        <section class="hero">
            <div class="container">
                <div class="left">
                    <h1 class="secondary-heading" id="nome-birra">Nome birra</h1>
                    <p id="stile-birra">Stile</p>
                    <p id="tagline-birra">Tagline</p>
                    <form>
                        <input type="hidden" class="prodotto-id" value="">
                        <button type="button" class="button button--shop button--hero">
                            <span class="button-image"></span>
                            AGGIUNGI
                        </button>
                    </form>
                </div>

                <div class="right">
                    <p id="descrizione-birra">descrizione</p>
                </div>

                <div class="slide-wrapper">

                    <button class="slide-arrow" id="slide-arrow-prev">
                        &#8249;
                    </button>

                    <button class="slide-arrow" id="slide-arrow-next">
                        &#8250;
                    </button>

                    <div class="img-slider" id="slider">

                    </div>
                </div>
            </div>
        </section>

        <section id="info-birra">
            <div class="container center">
                <h2 class="secondary-heading">Ultimi arrivi</h2>


            </div>
        </section>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>