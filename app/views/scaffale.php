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
            <div class="container" id="contenitore-prodotto">
                <div class="left">
                    <h1 class="secondary-heading" id="nome-prodotto">Nome birra</h1>
                    <p id="stile-birra">stile</p>
                    <p id="tagline-prodotto">tagline</p>
                    <form class="form-add">
                        <input type="hidden" class="prodotto-id" value="">
                        <button type="button" class="button button--shop button--hero">
                            <span class="button-image"></span>
                            AGGIUNGI
                        </button>
                    </form>
                </div>

                <div class="right">
                    <p id="descrizione-prodotto">descrizione</p>
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

        <div id="info-birra" class="container">
            <section class="descrizione">
                <h2 class="section-title">Descrizione</h2>

                <h3>Aroma</h3>
                <p id="aroma"></p>

                <h3>Gusto</h3>
                <p id="gusto"></p>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
    <script src="<?= WEB_PATH?>/javascript/shop-nav.js"></script>
</body>
</html>