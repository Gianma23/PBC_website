<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/dashboard.css">
</head>
<body>

<?php include __DIR__ . "/include/header.php"; ?>

<main>
    <div class="container">
        <h1 class="primary-heading">Dashboard Account</h1>
        <div class="cards-container">
            <a href="user-ordini.php" class="card">
                <h2>Ordini</h2>
                <p>Controlla e gestisci lo stato di tutti gli ordini presenti.</p>
            </a>
            <a href="user-dettagli.php" class="card">
                <h2>Dettagli account</h2>
                <p>Visualizza e modifica le informazioni del tuo account.</p>
            </a>
        </div>
    </div>
</main>

<?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>
