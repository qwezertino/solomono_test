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

    public static function getAll($categoryId = null, $orderBy = 'price')
    {
        $sql = "SELECT * FROM products";
        if ($categoryId) {
            $sql .= " WHERE category_id = :category_id";
        }
        $sql .= " ORDER BY $orderBy";
        $statement = self::prepare($sql);
        if ($categoryId) {
            $statement->bindValue(':category_id', $categoryId);
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
