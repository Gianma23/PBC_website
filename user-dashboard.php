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
        <div class="container center">
            <h1 class="primary-heading">Account</h1>
            <div class="cards-container">
                <article class="card card--sign-in">
                    <h2>Già registrato?</h2>
                    <div class="form-container">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <input type='hidden' name='action' value='login'>
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
                                    <?php echo $errorLogin; ?>
                                    <button type="submit" class="button">ACCEDI</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <?php include "global/php/utils/footer.php"; ?>

</body>
</html>
