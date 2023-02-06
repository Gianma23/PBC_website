<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/checkout.css">
    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Carrello</h1>
            <div class="column-container">

                <div class="carrello">
                    <table class="prodotti-table">
                        <thead>
                            <tr>
                                <th scope="col">Prodotto</th>
                                <th scope="col">Prezzo</th>
                                <th scope="col"><abbr title="Quantità">Qtà</abbr></th>
                                <th scope="col">Subtotale</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="prodotti-table">
                        </tbody>
                    </table>
                </div>

                <article class="riepilogo">
                    <h2>Riepilogo</h2>
                    <div class="stima">
                        <p class="riga">Totale carrello <span id="riepilogo-totale-carrello"></span></p>
                        <p class="riga">Stima spese di spedizione <span id="riepilogo-stima-spedizione"></span></p>
                    </div>
                    <div class="vai-avanti"></div>
                    <p>Totale ordine <span></span></p>
                </article>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>
