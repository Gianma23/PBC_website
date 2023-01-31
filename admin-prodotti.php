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

    <?php include "global/php/utils/footer.php"; ?>

    <script src="pages/dashboard/admin-prodotti.js"></script>
</body>
</html>
