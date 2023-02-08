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
            <div class="cards-container">
                <article class="card">
                    <h2>Già registrato?</h2>
                    <div class="form--card">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <input type='hidden' name='action' value='login'>
                            <p class="form-elem">
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" placeholder="esempio@email.com" name="email">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="password">Password:</label><br>
                                <input type="password" id="password" name="password">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <button type="submit" class="button">ACCEDI</button>
                            </p>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>
