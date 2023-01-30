<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/php/utils/head.php"; ?>
    <link rel="stylesheet" href="pages/dashboard/admin-prodotti.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/php/utils/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Admin Panel</h1>
                <article class="card">
                    <h2>Aggiungi prodotto</h2>
                    <div class="form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <input type='hidden' name='action' value='login'>
                            <ul>
                                <li>
                                    <label for="nome">Nome:</label><br>
                                    <input type="text" id="nome" name="nome">
                                    <small class="error"></small>
                                </li>
                                <li>
                                    <label for="desc">Descrizione:</label><br>
                                    <textarea id="desc" name="desc"></textarea>
                                    <small class="error"></small>
                                </li>
                                <li>
                                    <label for="prezzo">Prezzo:</label><br>
                                    <input type="text" id="prezzo" name="prezzo">
                                    <small class="error"></small>
                                </li>
                                <li>
                                    <label for="quantita">Quantità:</label><br>
                                    <input type="text" id="quantita" name="quantita">
                                    <small class="error"></small>
                                </li>
                                <li>
                                    <label for="">Categoria:</label><br>
                                    <select id="quantita" name="quantita">
                                        <option value="birra">Birra</option>
                                        <option value="merchandising">Merchandising</option>
                                        <option value="altro">Altro</option>
                                    </select>
                                    <small class="error"></small>
                                </li>
                                <li>
                                    <?php echo $errorAggiungi; ?>
                                    <button type="submit" class="button">AGGIUNGI</button>
                                </li>
                            </ul>
                        </form>
                    </div>
            </article>
        </div>
    </main>

    <?php include "global/php/utils/footer.php"; ?>

</body>
</html>
