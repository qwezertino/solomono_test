<?php
namespace app\models;

use thecodeholic\phpmvc\db\DbModel;

class Product extends DbModel
{
    public $id;
    public $name;
    public $price;
    public $created_at;
    public $category_id;

    public static function tableName(): string
    {
        return 'products';
    }

    public function attributes(): array
    {
        return ['name', 'price', 'created_at', 'category_id'];
    }

    public static function findAllWithFilters($filters)
    {

        $sql = "SELECT * FROM " . static::tableName() . " WHERE 1";

        if (isset($filters['category']) && $filters['category'] !== '') {
            $sql .= " AND category_id = :category_id";
        }

        if (isset($filters['order'])) {
            switch ($filters['order']) {
                case 'price_asc':
                    $sql .= " ORDER BY price ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY price DESC";
                    break;
                case 'name':
                    $sql .= " ORDER BY name ASC";
                    break;
                case 'newest':
                    $sql .= " ORDER BY created_at DESC";
                    break;
            }
        }

        $statement = self::prepare($sql);

        if (isset($filters['category']) && $filters['category'] !== '') {
            $statement->bindValue(':category_id', $filters['category']);
        }

        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getOne($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $statement = self::prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
