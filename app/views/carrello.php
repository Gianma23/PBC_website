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
            <h1 class="primary-heading">Account</h1>
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
                                <?php echo $errorLogin; ?>
                                <button type="submit" class="button">ACCEDI</button>
                            </p>
                        </form>
                    </div>
                </article>

                <article class="card">
                    <h2>Sei nuovo?</h2>
                    <div class="form--card">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <input type='hidden' name='action' value='register'>
                            <p class="form-elem">
                                <label for="sign-up-email">Email:</label><br>
                                <input type="email" id="sign-up-email" placeholder="esempio@email.com" name="email">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="sign-up-password">Password:</label><br>
                                <input type="password" id="sign-up-password" name="password">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem">
                                <label for="pass-conf">Conferma password:</label><br>
                                <input type="password" id="pass-conf" name="pass-conf">
                                <small class="error"></small>
                            </p>
                            <p class="form-elem form__privacy-policy">
                                <input type="checkbox" id="privacy-policy" name="privacy-policy">
                                <label for="privacy-policy">Accetto le condizioni sulla privacy</label>
                            </p>
                            <p class="form-elem">
                                <?php echo $errorRegister; ?>
                                <button type="submit" class="button">REGISTRATI</button>
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
