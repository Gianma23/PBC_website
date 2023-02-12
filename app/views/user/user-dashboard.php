<?php
if(!isset($_SESSION['account_id']))
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
            <h1 class="primary-heading">Dashboard account</h1>
            <div class="cards-container">
                <a href="<?= URL_ROOT?>/user-ordini?page=1&how-many=10" class="card">
                    <h2>Ordini</h2>
                    <p>Controlla e gestisci lo stato di tutti gli ordini presenti.</p>
                </a>
            </div>
            <div class="esci">
                <button class="button button--remove" id="esci">Esci</button>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>
    <script src="<?= WEB_PATH?>/javascript/dashboard.js"></script>
</body>
</html>
