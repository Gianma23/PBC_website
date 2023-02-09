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

    <main>
        <div class="container">
            <a href="<?= URL_ROOT?>/admin-dashboard"><h1 class="primary-heading">Admin Panel</h1></a>
            <div class="gestisci-bar">
                <h2 class="secondary-heading">Gestisci prodotti</h2>
                <a href="<?= URL_ROOT?>/admin-aggiungi-prodotto" class="button button--primary">Aggiungi</a>
            </div>
            <section>
                <div class="cards-container">
                    <?php include __DIR__ . "/../utils/carica-prodotti.php"; ?>
                </div>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>

    <script src="<?= WEB_PATH?>/javascript/admin-prodotti.js"></script>
</body>
</html>
