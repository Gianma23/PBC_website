<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="../../public/css/admin-prodotti.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>
    <?php include "pages/admin-aggiungi-prodotto/aggiungi.php"; ?>

    <main>
        <div class="container">
            <a href="admin-dashboard.php"><h1 class="primary-heading">Admin Panel</h1></a>
                <article class="card">
                    <h2>Aggiungi prodotto</h2>
                    <div class="form--card">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                            <p class="form-elem">
                                <label for="nome">Nome:</label><br>
                                <input type="text" id="nome" name="nome">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="stile">Stile:</label><br>
                                <input type="text" id="stile" name="stile">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="tagline">Tag-line:</label><br>
                                <input type="text" id="tagline" name="tagline">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="desc">Descrizione:</label><br>
                                <textarea id="desc" name="desc"></textarea>
                                <small class="error"></small>
                            </p>

                            <div class="form-fieldset">
                                <p class="form-elem">
                                    <label for="prezzo">Prezzo:</label><br>
                                    <input type="text" id="prezzo" name="prezzo">
                                    <small class="error"></small>
                                </p>
                                <p class="form-elem">
                                    <label for="quantita">Quantità:</label><br>
                                    <input type="text" id="quantita" name="quantita">
                                    <small class="error"></small>
                                </p>
                                <p class="form-elem">
                                    <label for="categoria">Categoria:</label><br>
                                    <select id="categoria" name="categoria">
                                        <option value="birra">Birra</option>
                                        <option value="merchandising">Merchandising</option>
                                    </select>
                                    <small class="error"></small>
                                </p>
                            </div>

                            <div class="form-fieldset" id="info-birra">
                                <p class="form-elem">
                                    <label for="aroma">Aroma:</label><br>
                                    <textarea id="aroma" name="aroma"></textarea>
                                    <small class="error"></small>
                                </p>
                                <p class="form-elem">
                                    <label for="gusto">Gusto:</label><br>
                                    <textarea id="gusto" name="gusto"></textarea>
                                    <small class="error"></small>
                                </p>
                            </div>

                            <p class="form-elem">
                                <label for="image">Immagine:</label><br>
                                <input type="file" id="image" name="image">
                                <small class="error"></small>
                            </p>
                            <p>
                                <?php echo $errorAggiungi; ?>
                                <button type="submit" class="button">AGGIUNGI</button>
                            </p>
                        </form>
                    </div>
            </article>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
    <script src="../../public/javascript/admin-prodotti.js"></script>
</body>
</html>
