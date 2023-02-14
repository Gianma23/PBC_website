<?php
    // la pagina carica solo se è stato effettuato un ordine
    if (!isset($_SESSION['confirmation']) || !$_SESSION['confirmation'])
        header('Location:' . URL_ROOT . '/home');
    unset($_SESSION['confirmation']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container center">
            <h1 class="primary-heading">Grazie per il tuo ordine!</h1>
            <p class="fw-medium fs-600">Riceverai una email di conferma del tuo ordine a breve.</p>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>
