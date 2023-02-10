<?php
// pagina accessibile solo dagli admin
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/../include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/dashboard.css">
</head>
<body>

    <?php include __DIR__ . "/../include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading"><a href="<?= URL_ROOT?>/admin-dashboard">Admin Panel</a></h1>
            <div class="gestisci-bar">
                <h2 class="secondary-heading">Gestisci prodotti</h2>
                <a href="<?= URL_ROOT?>/admin-aggiungi-prodotto" class="button button--primary">Aggiungi</a>
            </div>
            <div class="products cards-container">
                <?php include __DIR__ . "/../utils/carica-prodotti.php"; ?>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>

</body>
</html>
