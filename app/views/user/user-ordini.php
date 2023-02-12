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
            <h1 class="primary-heading"><a href="<?= URL_ROOT?>/user-dashboard">Dashboard account</a></h1>
            <h2 class="secondary-heading">Gestisci ordini</h2>

            <table class="ordini-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Totale</th>
                            <th scope="col">Stato</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="ordini-table">
                    </tbody>
                </table>
            <ul class="lista-pagine" id="lista-pagine">
            </ul>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>

</body>
</html>
