<!DOCTYPE html>
<html lang="it">
<head>
    <?php include "app/php/utils/head.php"; ?>

    <title>Home - Piccolo Birrificio Clandestino</title>
</head>
<body>

    <?php include "app/php/utils/header.php"; ?>

    <main>
        <?php include "app/php/utils/shop-nav.php"; ?>

        <section>
            <div class="container center">
                <h2 class="secondary-heading">Le più vendute</h2>
                <div class="cards-container">
                    <?php include "app/php/shop-queries/piu-vendute.php"; ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container center">
                <h2 class="secondary-heading">Ultimi arrivi</h2>
                <?php include "app/php/shop-queries/ultimi-arrivi.php" ?>
            </div>
        </section>
    </main>

    <?php include "app/php/utils/footer.php"; ?>

</body>
</html>