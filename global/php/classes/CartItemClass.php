<?php
include_once __DIR__."/ProductClass.php";

class CartItemClass extends ProductClass implements JsonSerializable {

    private $pezzi;

    function __construct($record, $pezzi) {
        parent::__construct($record);

        $this->pezzi = $pezzi;
    }

    public function jsonSerialize() : array {
        return ["nome"=> $this->nome,
                "prezzo"=> $this->prezzo,
                "descrizione"=> $this->descrizione,
                "categoria"=> $this->categoria,
                "tagline"=> $this->tagline,
                "imgPath"=> $this->imgPath,
                "disponibile"=> $this->disponibile,
                "pezzi"=> $this->pezzi];
    }
}