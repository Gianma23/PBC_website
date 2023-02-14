<?php
// pagina accessibile solo dagli admin
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');

$action = 'AGGIUNGI';
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/../include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/admin-prodotti.css">
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/dashboard.css">
</head>
<body>

    <?php include __DIR__ . "/../include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading"><a href="<?= URL_ROOT?>/admin-dashboard">Admin Panel</a></h1>
            <h2 class="secondary-heading"><a href="<?= URL_ROOT?>/admin-prodotti">Gestisci prodotti</a></h2>
                <article class="card-prodotto">
                    <h3>Aggiungi prodotto</h3>
                    <div class="form--card">
                        <?php include __DIR__ . "/../utils/form-modifica-prodotto.php"; ?>
                    </div>
            </article>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>
    <script src="<?= WEB_PATH?>/javascript/admin-prodotti.js"></script>
</body>
</html>
