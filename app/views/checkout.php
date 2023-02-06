<?php
    // se il carrello è vuoto reindirizzo alla pagina del carrello
    if(isset($_SESSION['cart']) && empty($_SESSION['cart']))
        header('Location:' . URL_ROOT . '/carrello');
?>
<?php include __DIR__ . "/include/head.php"; ?>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>
    <?php include __DIR__ . "/utils/effettua-ordine.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Checkout</h1>

            <form action="<?= URL_ROOT?>/ordine/aggiungi" method="POST" class="column-container" id="carrello-container" novalidate>

                <div class="info-checkout">
                    <fieldset>
                        <legend>Dettagli spedizione</legend>
                        <?php
                            if(!isset($_SESSION['account']))
                            echo '
                            <p class="form-elem">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="email">
                                <small class="error"></small>
                            </p>';
                        ?>
                        <div class="form-2col">
                            <p class="form-elem">
                                <label for="nome">Nome:</label>
                                <input type="text" id="nome" name="nome">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="cognome">Cognome:</label>
                                <input type="text" id="cognome" name="cognome">
                                <small class="error"></small>
                            </p>
                        </div>

                        <p class="form-elem" id="telefono-elem">
                            <label for="telefono">Telefono:</label>
                            <input type="text" id="telefono" name="telefono">
                            <small class="error"></small>
                        </p>
                        <p class="form-elem">
                            <label for="indirizzo">Indirizzo:</label>
                            <input id="indirizzo" name="indirizzo">
                            <small class="error"></small>
                        </p>
                        <div class="form-3col">
                            <p class="form-elem">
                                <label for="provincia">Provincia:</label>
                                <select id="provincia" name="provincia">
                                    <option value="livorno">Livorno</option>
                                <?php


                                ?>
                                </select>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="citta">Città:</label>
                                <input id="citta" name="citta">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="cap">CAP:</label>
                                <input id="cap" name="cap">
                                <small class="error"></small>
                            </p>
                        </div>
                        <p class="form-elem">
                            <label for="note">Note per il corriere:</label>
                            <textarea id="note" name="note"></textarea>
                            <small class="error"></small>
                        </p>
                    </fieldset>

                    <fieldset>
                        <legend>Metodo di pagamento</legend>
                        <div class="opzione-stima">
                            <input type="radio" value="carta" id="carta" name="pagamento" checked>
                            <label for="carta">Carta di credito</label>
                        </div>
                        <div class="opzione-stima">
                            <input type="radio" value="bonifico" id="bonifico" name="pagamento">
                            <label for="bonifico">Bonifico bancario</label>
                        </div>
                    </fieldset>
                </div>

                <div>
                    <article class="riepilogo">
                        <h2>Riepilogo</h2>
                        <div class="stima">
                            <p class="riga">Totale carrello(<span id="num-prodotti"></span>&nbsp;prodotti) <span id="riepilogo-totale-carrello">0</span>&euro;</p>
                            <p class="riga">Stima spese di spedizione <span id="riepilogo-stima-spedizione">9.50</span>&euro;</p>
                            <input type="hidden" name="totale-spedizione" id="totale-spedizione" value="5">
                        </div>

                        <div class="vai-avanti">
                            <p class="riga">Totale ordine <span id="riepilogo-totale-ordine"></span></p>
                            <button type="submit" class="button" id="effettua-ordine">EFFETTUA ORDINE</button>
                            <input type="hidden" name="totale" id="totale" value="20">
                        </div>
                    </article>
                    <small><?php if(isset($errore)) echo $errore?></small>
                </div>
            </form>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>
