<?php
namespace Models;
use JsonSerializable;

include_once __DIR__ . "/Product.php";

class CartItem extends Product implements JsonSerializable
{
    private $pezzi;

    function __construct($record, $pezzi)
    {
        parent::__construct($record);

        $this->pezzi = $pezzi;
    }

    public function jsonSerialize(): array
    {
        return ["nome" => $this->nome,
            "prezzo" => $this->prezzo,
            "descrizione" => $this->descrizione,
            "categoria" => $this->categoria,
            "tagline" => $this->tagline,
            "imgPath" => $this->imgPath,
            "pezzi" => $this->pezzi];
    }

    public function getPezzi()
    {
        return $this->pezzi;
    }

    public function setPezzi($pezzi)
    {
        $this->pezzi = $pezzi;
    }
}