<?php

use Models\Product;

include_once(ROOT_PATH . "/app/models/Product.php");

try
{
    $pdo = new PDO(CONNECTION, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CALL novita();";
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
            <img src="<?= $prodotto->getImgPath() ?>" alt='immagine prodotto'>
            <h3 class="fw-medium fs-600"><?= $prodotto->getNome()?></h3>
            <p class="fw-medium fs-500"><?= $prodotto->getPrezzo()?>&euro;</p>
            <small class="<?= $disponibileText?>"><?= $disponibileText?></small>
            <form>
                <input type="hidden" class="prodotto-id" value="<?= $prodotto->getNome()?>">
                <button type="button" class="button button--shop" id="<?= $prodotto->getNome()?>" <?php if($disponibileText == 'esaurito') echo 'disabled'?>>
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