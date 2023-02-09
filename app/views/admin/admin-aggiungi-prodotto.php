<?php
// pagina accessibile solo dagli admin
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/../include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/admin-prodotti.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/../include/header.php"; ?>
    <?php include "pages/admin-aggiungi-prodotto/aggiungi.php"; ?>

    <main>
        <div class="container">
            <a href="<?= URL_ROOT?>/admin-dashboard"><h1 class="primary-heading">Admin Panel</h1></a>
            <a href="<?= URL_ROOT?>/admin-prodotti"><h2 class="secondary-heading">Gestisci prodotti</h2></a>
                <article class="card">
                    <h3>Aggiungi prodotto</h3>
                    <div class="form--card">
                        <form method="POST" enctype="multipart/form-data" id="aggiungi-form" novalidate>
                            <p class="form-elem">
                                <label for="nome">Nome:</label><br>
                                <input type="text" id="nome" name="nome" required>
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="tagline">Tag-line:</label><br>
                                <input type="text" id="tagline" name="tagline">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="desc">Descrizione:</label><br>
                                <textarea id="desc" name="desc" required></textarea>
                                <small class="error"></small>
                            </p>

                            <div class="form-3col">
                                <p class="form-elem">
                                    <label for="prezzo">Prezzo:</label><br>
                                    <input type="number" step="0.01" id="prezzo" name="prezzo" required>
                                    <small class="error"></small>
                                </p>
                                <p class="form-elem">
                                    <label for="quantita">Quantità:</label><br>
                                    <input type="number" id="quantita" name="quantita" required>
                                    <small class="error"></small>
                                </p>
                                <p class="form-elem">
                                    <label for="categoria">Categoria:</label><br>
                                    <select id="categoria" name="categoria">
                                        <option value="birra">Birra</option>
                                        <option value="merchandising">Merchandising</option>
                                        <option value="altro">Altro</option>
                                    </select>
                                    <small class="error"></small>
                                </p>
                            </div>

                            <div id="info-birra">
                                <p class="form-elem">
                                    <label for="stile">Stile:</label><br>
                                    <input type="text" id="stile" name="stile" required>
                                    <small class="error"></small>
                                </p>
                                <div class="form-2col">
                                    <p class="form-elem">
                                        <label for="aroma">Aroma:</label><br>
                                        <textarea id="aroma" name="aroma" required></textarea>
                                        <small class="error"></small>
                                    </p>
                                    <p class="form-elem">
                                        <label for="gusto">Gusto:</label><br>
                                        <textarea id="gusto" name="gusto" required></textarea>
                                        <small class="error"></small>
                                    </p>
                                </div>
                            </div>

                            <p class="form-elem">
                                <label for="image">Immagine:</label><br>
                                <input type="file" id="image" name="image" required>
                                <small class="error"></small>
                            </p>
                            <p>
                                <button type="submit" class="button">AGGIUNGI</button>
                                <small class="error" id="error-prodotto"></small>
                            </p>
                        </form>
                    </div>
            </article>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>
    <script src="<?= WEB_PATH?>/javascript/admin-prodotti.js"></script>
</body>
</html>
