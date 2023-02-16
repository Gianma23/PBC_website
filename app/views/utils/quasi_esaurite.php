<?php

use Models\Product;

include_once(ROOT_PATH . "/app/models/Product.php");

try
{
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT *
            FROM beer B
                 INNER JOIN
                 product P ON B.product_id = P.name
            WHERE P.quantity > 3
            ORDER BY P.quantity
            LIMIT 4;";
    $result = $pdo->query($sql);

    while($row = $result->fetch())
    {
        $prodotto = new Product($row);

        // creazione card prodotto

        $disponibileText = "disponibile";
        if (!$prodotto->getQuantita() > 0)
            $disponibileText = "esaurito";
        ?>
        <div class="product-card">
            <img src="<?= URL_ROOT . $prodotto->getImgPath() ?>" alt='immagine prodotto'>
            <h3 class="fw-medium fs-500"><?= $prodotto->getNome()?></h3>
            <p class="fw-medium fs-500"><?= $prodotto->getPrezzo()?>&euro;</p>
            <small class="<?= $disponibileText?>"><?= $disponibileText?></small>
            <form>
                <input type="hidden" class="prodotto-id" value="<?= $prodotto->getNome()?>">
                <button type="button" class="button button--shop" <?php if($disponibileText == 'esaurito') echo 'disabled'?>>
                    <span class="button-image"></span>
                    AGGIUNGI
                </button>
            </form>
        </div>
        <?php
    }
    $pdo = null;
}
catch (PDOException $e)
{
    $pdo = null;
}