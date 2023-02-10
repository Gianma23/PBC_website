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
            <h1 class="primary-heading">Admin Panel</h1>
            <div class="cards-container">
                <a href="<?= URL_ROOT?>/admin-ordini?page=1&how-many=10" class="card">
                    <h2>Gestisci ordini</h2>
                    <p>Controlla e gestisci lo stato di tutti gli ordini presenti.</p>
                </a>
                <a href="<?= URL_ROOT?>/admin-prodotti" class="card">
                    <h2>Gestisci prodotti</h2>
                    <p>Aggiungi, elimina o modifica i prodotti presenti.</p>
                </a>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>

</body>
</html>
