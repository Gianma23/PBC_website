<?php
// pagina accessibile solo dagli admin
if(($_SESSION['role'] != 'admin'))
    header('Location:' . URL_ROOT . '/home');
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/../include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/admin-dashboard.css">
</head>
<body>

    <?php include __DIR__ . "/../include/header.php"; ?>

    <main>
        <div class="container">
            <a href="<?= URL_ROOT?>/admin-dashboard"><h1 class="primary-heading">Admin Panel</h1></a>
            <h2 class="secondary-heading">Gestisci ordini</h2>

            <table class="ordini-table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Email</td>
                            <td>Totale</td>
                            <td>Stato</td>
                        </tr>
                    </thead>
                    <tbody id="ordini-table">
                    </tbody>
                </table>
        </div>
    </main>

    <?php include __DIR__ . "/../include/footer.php"; ?>

</body>
</html>
