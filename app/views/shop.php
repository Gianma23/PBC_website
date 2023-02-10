<!DOCTYPE html>
<html lang="it">
<head>
    <?php include __DIR__ . "/include/head.php"; ?>
</head>
<body>

    <?php include __DIR__ . "/include/header.php"; ?>

    <main>
        <?php include __DIR__ . "/include/shop-nav.php"; ?>

        <section>
            <div class="container center">
                <h2 class="secondary-heading">Ultimi arrivi</h2>
                <div class="cards-container">
                    <?php include __DIR__ . "/utils/ultimi-arrivi.php"; ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container center">
                <h2 class="secondary-heading">In esaurimento</h2>
                <div class="cards-container">
                    <?php include __DIR__ . "/utils/quasi_esaurite.php"; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . "/include/footer.php"; ?>

</body>
</html>