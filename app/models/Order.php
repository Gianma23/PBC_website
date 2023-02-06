<?php
namespace Models;
use JsonSerializable;

class Order implements JsonSerializable
{

    protected $nome;
    protected $prezzo;
    protected $descrizione;
    protected $categoria;
    protected $tagline;
    protected $quantita;
    protected $venduti;
    protected $imgPath;

    public function __construct($record)
    {
        $this->nome = $record['name'];
        $this->prezzo = $record['price'];
        $this->descrizione = $record['descr'];
        $this->categoria = $record['category'];
        $this->tagline = $record['tagline'];
        $this->quantita = $record['quantity'];
        $this->venduti = $record['sold'];
        $this->imgPath = $record['img_path'];
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }

    public function getDescrizione() {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria =$categoria;
    }

    public function getTagline() {
        return $this->tagline;
    }

    public function setTagline($tagline) {
        $this->tagline =$tagline;
    }

    public function getQuantita() {
        return $this->quantita;
    }

    public function setQuantita($quantita) {
        $this->quantita =$quantita;
    }

    public function getVenduti() {
        return $this->venduti;
    }

    public function setVenduti($venduti) {
        $this->venduti =$venduti;
    }

    public function getImgPath() {
        return $this->imgPath;
    }

    public function setImgPath($imgPath) {
        $this->imgPath =$imgPath;
    }

    function createProductCard()
    {
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

    public function jsonSerialize(): array
    {
        return ["nome" => $this->nome,
            "prezzo" => $this->prezzo,
            "descrizione" => $this->descrizione,
            "categoria" => $this->categoria,
            "tagline" => $this->tagline,
            "imgPath" => $this->imgPath,
            "disponibile" => $this->disponibile];
    }
}