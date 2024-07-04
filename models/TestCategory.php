<?php
namespace app\models;

use thecodeholic\phpmvc\db\DbModel;

class TestCategory extends DbModel
{
    public $categories_id;
    public $parent_id;
    public $children = [];

    public static function tableName(): string
    {
        return 'test_categories';
    }

    public function attributes(): array
    {
        return ['categories_id', 'parent_id'];
    }
    public static function getAll()
    {
        $sql = "SELECT * FROM test_categories";
        $statement = self::prepare($sql);
        $statement->execute();
        $categories = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }
    public static function buildCategoryTree($parentId = 0)
    {
        $sql = "SELECT * FROM test_categories WHERE parent_id = :parent_id";
        $statement = self::prepare($sql);
        $statement->bindValue(':parent_id', $parentId);
        $statement->execute();
        $categories = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $tree = [];
        foreach ($categories as $category) {
            $categoryId = $category['categories_id'];
            $categoryModel = new self();
            $categoryModel->categories_id = $category['categories_id'];
            $categoryModel->parent_id = $category['parent_id'];
            $categoryModel->children = self::buildCategoryTree($categoryId);
            $tree[$categoryId] = (array)$categoryModel;
        }

        return $tree;
    }
}
?>
