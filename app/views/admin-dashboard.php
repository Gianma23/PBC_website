<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/dashboard.css">
    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading">Admin Panel</h1>
            <div class="cards-container">
                <a href="<?= WEB_PATH?>/admin-ordini" class="card">
                    <h2>Gestisci ordini</h2>
                    <p>Controlla e gestisci lo stato di tutti gli ordini presenti.</p>
                </a>
                <a href="<?= WEB_PATH?>/admin-prodotti" class="card">
                    <h2>Gestisci prodotti</h2>
                    <p>Aggiungi, elimina o modifica i prodotti presenti.</p>
                </a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>
