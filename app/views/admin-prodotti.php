<?php
// se il carrello è vuoto reindirizzo alla pagina del carrello
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="../../public/css/admin-prodotti.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <a href="admin-dashboard.php"><h1 class="primary-heading">Admin Panel</h1></a>
            <div class="gestisci-bar">
                <h2 class="secondary-heading">Gestisci prodotti</h2>
                <a href="admin-aggiungi-prodotto.php" class="button button--primary">Aggiungi</a>
            </div>
            <section>
                <div class="cards-container">
                    <?php include "pages/dashboard/prodotti.php"; ?>
                </div>
            </section>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

    <script src="../../public/javascript/admin-prodotti.js"></script>
</body>
</html>
