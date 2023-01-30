<?php

class ProductClass {

    private $nome;
    private $prezzo;
    private $quantita;
    private $imgPath;
    private $disponibile;

    function __construct($record) {
        $this->nome = $record['name'];
        $this->prezzo = $record['price'];
        $this->quantita = $record['quantity'];
        $this->imgPath = $record['img_path'];
        $this->disponibile = $record['quantity'] > 0;
    }

    function createShopCard() {
        $disponibileText = "disponibile";
        if(!$this->disponibile)
            $disponibileText = "esaurito";
        echo
        "<div class=\"shop-card\">
            <h3 class=\"fw-medium fs-600\">$this->nome</h3>
            <p class=\"fw-medium fs-500\">$this->prezzo&euro;</p>
            <small class=\"$disponibileText\">$disponibileText</small>
            <button class=\"button shop-button\">AGGIUNGI</button>
        </div>";
    }

    function createProductCard() {
        echo
        "<div class=\"product-card\">
            <img src='$this->imgPath' alt='immagine prodotto'>
            <h3 class=\"fw-medium fs-600\" id=\"nome-birra\">$this->nome</h3>
            <p class=\"fw-medium fs-500\">Prezzo: $this->prezzo&euro;</p>
            <small class=\"fw-medium fs-500\">Quantità: $this->quantita</small>
            <div class='button-container'>
                <button class=\"button button--edit\" id=\"modifica\">Modifica</button>
                <button class=\"button button--remove elimina\">Elimina</button>
            </div>
        </div>";
    }
}