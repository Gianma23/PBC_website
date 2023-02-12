<?php
include_once(ROOT_PATH . "/app/models/Order.php");
use Models\Order;

if(!isset($_SESSION['account_id']))
    header('Location:' . URL_ROOT . '/home');

$role = $_SESSION['role'];

$pdo = new PDO(CONNECTION, USER, PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$orderInfo = Order::findById($pdo, $order);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
    <link rel="stylesheet" href="<?= WEB_PATH?>/css/dashboard.css">
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <div class="container">
            <h1 class="primary-heading"><a href="<?= URL_ROOT . '/' . $role?>-dashboard">Admin Panel</a></h1>
            <h2 class="secondary-heading"><a href="<?= URL_ROOT . '/' . $role?>-ordini?page=">Gestisci ordini</a></h2>

            <div class="info-ordine">
                <div class="info-ordine__bar">
                    <h3>Ordine numero: <?= $orderInfo['id']?></h3>
                    <p>stato: <?= $orderInfo['status']?></p>
                </div>

                <div class="cards-ordine">
                    <article class="card">
                        <h4>Cliente</h4>
                        <ul>
                            <li><?= $orderInfo['name'] . ' ' . $orderInfo['surname']?></li>
                            <li><?= $orderInfo['account_id'] == null ? 'Non registrato' : 'Registrato' ?></li>
                            <li>Email: <?= $orderInfo['account_id'] == null ? $orderInfo['email'] : $orderInfo['account_id'] ?></li>
                        </ul>
                    </article>

                    <article class="card">
                        <h4>Spedizione</h4>
                        <ul>
                            <li>Provincia: <?= $orderInfo['province']?></li>
                            <li>Città: <?= $orderInfo['city']?></li>
                            <li>CAP: <?= $orderInfo['cap'] ?></li>
                            <li>Telefono: <?= $orderInfo['telephone']?></li>
                            <li>Note: <br><?= $orderInfo['note']?></li>
                        </ul>
                    </article>
                </div>
            </div>

            <div class="ordine">
                <table class="items-ordine-table">
                    <thead>
                        <tr>
                            <th scope="col">Prodotto</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Quantità</th>
                            <th scope="col">Totale</th>
                        </tr>
                    </thead>
                    <tbody id="items-ordine-table">
                    </tbody>
                </table>
                <div class="riepilogo-ordine">
                    <p class="riepilogo-item">Subtotale: <span id="subtotale-ordine" class="fs-500"><?= $orderInfo['total'] - $orderInfo['shipment_total']?>&euro;</span></p>
                    <p class="riepilogo-item">Costi di spedizione: <span id="costi-spedizione"><?= $orderInfo['shipment_total']?>&euro;</span></p>
                    <p class="riepilogo-item ">Totale ordine: <span id="totale-ordine" class="fs-600 fw-medium"><?= $orderInfo['total']?>&euro;</span></p>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>
</body>
</html>
