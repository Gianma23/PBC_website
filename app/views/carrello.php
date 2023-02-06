    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/checkout.css">
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Carrello</h1>
            <div class="column-container" id="carrello-container">

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
                        <p class="riga">Totale carrello(<span id="num-prodotti"></span>&nbsp;prodotti) <span id="riepilogo-totale-carrello">0</span>&euro;</p>
                        <p class="riga">Stima spese di spedizione <span id="riepilogo-stima-spedizione">9.50</span>&euro;</p>
                        <div class="opzione-stima">
                            <input type="radio" value="9.50" id="italia" name="stima-spese" checked>
                            <label for="italia">9.50&euro; Tariffa Italia isole escluse</label>
                        </div>
                        <div class="opzione-stima">
                            <input type="radio" value="12.50" id="sardegna" name="stima-spese">
                            <label for="sardegna">12.50&euro; Tariffa Sardegna</label>
                        </div>
                        <div class="opzione-stima">
                            <input type="radio" value="15.50" id="sicilia" name="stima-spese">
                            <label for="sicilia">15.50&euro; Tariffa Sicilia</label>
                        </div>
                        <div class="opzione-stima">
                            <input type="radio" value="0" id="livorno" name="stima-spese">
                            <label for="livorno">0&euro; Comune di Livorno</label>
                        </div>
                    </div>

                    <div class="vai-avanti">
                        <p class="riga">Totale ordine <span id="riepilogo-totale-ordine"></span></p>
                        <a href="<?= URL_ROOT?>/checkout" role="button" class="button" id="successivo">SUCCESSIVO</a>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>
