<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/php/utils/head.php"; ?>
    <link rel="stylesheet" href="pages/dashboard/dashboard.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/php/utils/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Admin Panel</h1>
            <div class="cards-container">
                <a href="admin-ordini.php" class="card">
                    <h2>Gestisci ordini</h2>
                    <p>Controlla e gestisci lo stato di tutti gli ordini presenti.</p>
                </a>
                <a href="admin-prodotti.php" class="card">
                    <h2>Gestisci prodotti</h2>
                    <p>Aggiungi, elimina o modifica i prodotti presenti.</p>
                </a>
            </div>
        </div>
    </main>

    <?php include "global/php/utils/footer.php"; ?>

</body>
</html>
