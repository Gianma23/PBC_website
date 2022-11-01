<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "global/html/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "global/html/header.php"; ?>

    <main>
        <div class="container center">
            <h1 class="primary-heading">Account</h1>
            <div class="cards-container">
                <article class="card card--sign-in">
                    <h2>Già registrato?</h2>
                    <div class="form-container">
                        <form action="">
                            <ul class="form-sign-in">
                                <li class="form__email">
                                    <label for="email">Email:</label><br>
                                    <input type="email" id="email" placeholder="esempio@email.com" name="email">
                                    <small class="error"></small>
                                </li>
                                <li class="form__pass">
                                    <label for="password">Password:</label><br>
                                    <input type="password" id="password" name="password">
                                    <small class="error"></small>
                                </li>
                                <li class="form__button">
                                    <button type="submit" class="button">ACCEDI</button>
                                </li>
                                <li><a href="#" class="remember-pass">Password dimenticata?</a></li>
                            </ul>
                        </form>
                    </div>
                </article>

                <article class="card card--sign-up">
                    <h2>Sei nuovo?</h2>
                    <div class="form-container">
                        <form action="">
                            <ul class="form-sign-up">
                                <li class="form__email">
                                    <label for="sign-up-email">Email:</label><br>
                                    <input type="email" id="sign-up-email" placeholder="esempio@email.com" name="email">
                                    <small class="error"></small>
                                </li>
                                <li class="form__pass">
                                    <label for="sign-up-password">Password:</label><br>
                                    <input type="password" id="sign-up-password" name="password">
                                    <small class="error"></small>
                                </li>
                                <li class="form__pass-conferma">
                                    <label for="sign-up-pass-conf">Conferma password:</label><br>
                                    <input type="password" id="pass-conf" name="pass-conf">
                                    <small class="error"></small>
                                </li>
                                <li class="form__privacy-policy checkbox-container">
                                    <input type="checkbox" id="privacy-policy" name="privacy-policy">
                                    <label for="privacy-policy">Accetto le condizioni del sium</label>
                                </li>
                                <li class="form__button">
                                    <button type="submit" class="button">REGISTRATI</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <?php include "global/html/footer.php"; ?>

</body>
</html>
