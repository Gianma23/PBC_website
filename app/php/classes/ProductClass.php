<?php

class ProductClass implements JsonSerializable {

    protected $nome;
    protected $prezzo;
    protected $descrizione;
    protected $categoria;
    protected $tagline;
    protected $quantita;
    protected $imgPath;
    protected $disponibile;

    function __construct($record) {
        $this->nome = $record['name'];
        $this->prezzo = $record['price'];
        $this->descrizione = $record['descr'];
        $this->categoria = $record['category'];
        $this->tagline = $record['tagline'];
        $this->quantita = $record['quantity'];
        $this->imgPath = $record['img_path'];
        $this->disponibile = $record['quantity'] > 0;
    }

    function createShopCard() {
        $disponibileText = "disponibile";
        if(!$this->disponibile)
            $disponibileText = "esaurito";
        echo
        "<div class=\"product-card\">
            <img src='$this->imgPath' alt='immagine prodotto'>
            <h3 class=\"fw-medium fs-600\">$this->nome</h3>
            <p class=\"fw-medium fs-500\">$this->prezzo&euro;</p>
            <small class=\"$disponibileText\">$disponibileText</small>
            <button class=\"button button--shop\">
                <span class=\"button-image\"></span>
                AGGIUNGI
            </button>
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

    public function jsonSerialize() : array {
        return ["nome"=> $this->nome,
                "prezzo"=> $this->prezzo,
                "descrizione"=> $this->descrizione,
                "categoria"=> $this->categoria,
                "tagline"=> $this->tagline,
                "imgPath"=> $this->imgPath,
                "disponibile"=> $this->disponibile];
    }
}