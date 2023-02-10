<?php
namespace Models;
use JsonSerializable;

class Product implements JsonSerializable
{
    protected $nome;
    protected $prezzo;
    protected $descrizione;
    protected $categoria;
    protected $tagline;
    protected $quantita;
    protected $imgPath;

    public function __construct($record)
    {
        $this->nome = $record['name'];
        $this->prezzo = $record['price'];
        $this->descrizione = $record['descr'];
        $this->categoria = $record['category'];
        $this->tagline = $record['tagline'];
        $this->quantita = $record['quantity'];
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

    public function getImgPath() {
        return $this->imgPath;
    }

    public function setImgPath($imgPath) {
        $this->imgPath =$imgPath;
    }

    /* CRUD OPERATIONS */

    public static function add($pdo, $name, $desc, $quantity, $tagline, $price, $category, $imgPath)
    {
        $sql = "INSERT INTO product (name, descr, quantity, tagline, price, category, img_path)
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $desc);
        $stmt->bindValue(3, $quantity);
        $stmt->bindValue(4, $tagline);
        $stmt->bindValue(5, $price);
        $stmt->bindValue(6, $category);
        $stmt->bindValue(7, $imgPath);
        $stmt->execute();
    }

    public static function findByName($pdo, $name)
    {
        $sql = "SELECT * 
                FROM product 
                WHERE name=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function findByCategory($pdo, $category)
    {
        $sql = "SELECT * 
                FROM product 
                WHERE category = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $category);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function decrementQuantity($pdo, $name, $quantityToRemove)
    {
        $sql = "UPDATE product 
                SET quantity = quantity - ?
                WHERE name = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $quantityToRemove);
        $stmt->bindValue(2, $name);
        return $stmt->execute();
    }

    public static function delete($pdo, $name) {
        $sql = "DELETE FROM product
                WHERE name = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $name);
        return $stmt->execute();
    }

    /* Altre funzioni */

    public function createProductCard()
    {
        echo
        "<div class=\"product-card\">
            <img src='$this->imgPath' alt='immagine prodotto'>
            <h3 class=\"fw-medium fs-500\" id=\"nome-prodotto\">$this->nome</h3>
            <p class=\"fw-medium fs-400\">Prezzo: $this->prezzo&euro;</p>
            <small class=\"fw-medium fs-400\">Quantità: $this->quantita</small>
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
            "imgPath" => $this->imgPath];
    }
}