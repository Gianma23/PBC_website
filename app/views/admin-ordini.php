<?php
// se il carrello è vuoto reindirizzo alla pagina del carrello
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>

    <title>Dashboard - Piccolo Birrificio Clandestino</title>
</head>
<body>

<?php include __DIR__ . "/include/header.php"; ?>

<main>
    <div class="container">
        <h1 class="primary-heading">Admin Panel</h1>
        <h2 class="secondary-heading">Gestisci ordini</h2>
    </div>
</main>

<?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>
