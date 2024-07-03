<?php
namespace app\models;

use thecodeholic\phpmvc\db\DbModel;

class Category extends DbModel
{
    public $id;
    public $name;

    public static function tableName(): string
    {
        return 'categories';
    }

    public function attributes(): array
    {
        return ['name'];
    }

    public static function getAllWithProductCount()
    {
        $sql = "SELECT c.*, COUNT(p.id) AS product_count
                FROM categories c
                LEFT JOIN products p ON p.category_id = c.id
                GROUP BY c.id";
        $statement = self::prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}
