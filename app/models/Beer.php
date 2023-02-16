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

    /* ============= CRUD OPERATIONS ============= */

    public static function addBeer($pdo, $productId, $style, $aroma, $flavor)
    {
        $sql = "INSERT INTO beer (product_id, style, aroma, flavor)
                VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $productId);
        $stmt->bindValue(2, $style);
        $stmt->bindValue(3, $aroma);
        $stmt->bindValue(4, $flavor);
        return $stmt->execute();
    }

    public static function updateBeer($pdo, $productId, $style, $aroma, $flavor)
    {
        $sql = "UPDATE beer
                SET style = ?, aroma = ?, flavor = ?
                WHERE product_id = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $style);
        $stmt->bindValue(2, $aroma);
        $stmt->bindValue(3, $flavor);
        $stmt->bindValue(4, $productId);
        $stmt->execute();
    }

    public static function findByName($pdo, $name)
    {
        $sql = "SELECT * 
                FROM product 
                     INNER JOIN
                     beer b on product.name = b.product_id
                WHERE name = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function jsonSerialize(): array
    {
        return ["nome" => $this->nome,
                "prezzo" => $this->prezzo,
                "quantita" => $this->quantita,
                "descrizione" => $this->descrizione,
                "categoria" => $this->categoria,
                "tagline" => $this->tagline,
                "imgPath" => $this->imgPath,
                "aroma" => $this->aroma,
                "stile" => $this->stile,
                "gusto" => $this->gusto];
    }
}