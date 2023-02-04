<?php
namespace Models;
use JsonSerializable;

include_once __DIR__ . "/Product.php";

class Beer extends Product implements JsonSerializable
{

    private $aroma;
    private $gusto;
    private $stile;

    function __construct($record)
    {
        parent::__construct($record);

        $this->stile = $record['style'];
        $this->aroma = $record['aroma'];
        $this->gusto = $record['flavor'];
    }

    public function jsonSerialize(): array
    {
        return ["nome" => $this->nome,
                "prezzo" => $this->prezzo,
                "descrizione" => $this->descrizione,
                "categoria" => $this->categoria,
                "tagline" => $this->tagline,
                "imgPath" => $this->imgPath,
                "aroma" => $this->aroma,
                "stile" => $this->stile,
                "gusto" => $this->gusto];
    }
}