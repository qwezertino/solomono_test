<?php

namespace app\controllers;

use app\models\TestCategory;
use thecodeholic\phpmvc\Controller;
use app\helpers\FormatData;

class SiteController extends Controller
{
    protected $formatData;
    public function __construct()
    {
        $this->formatData =  new FormatData();
    }
    public function home()
    {
        return $this->render('home');
    }
    public function test()
    {
        $time_start = microtime(true);
        $tree = TestCategory::buildCategoryTree();
        $treeHtml = $this->formatData->buildTreeHtml($tree);
        $time_end = microtime(true);
        $execution_time = number_format($time_end - $time_start, 3);;
        // echo 'Elapsed time: '.$execution_time.' seconds';
        return $this->render('test_categories', ['treeHtml' => $treeHtml, 'time' => $execution_time]);
        // header('Content-Type: application/json');
        // echo json_encode($data);
    }

    public function test2()
    {
        $time_start = microtime(true);
        $categories = TestCategory::getAll();
        $tree = [];
        $index = [];

        foreach ($categories as $category) {
            $index[$category['categories_id']] = [
                'categories_id' => $category['categories_id'],
                'parent_id' => $category['parent_id'],
                'children' => []
            ];
        }

        foreach ($index as $categoryId => &$node) {
            $parentId = $node['parent_id'];
            if ($parentId == 0) {
                $tree[$categoryId] = &$node; // Root node
            } else {
                $index[$parentId]['children'][] = &$node;
            }
        }
        $treeHtml = $this->formatData->buildTreeHtml($tree);
        $time_end = microtime(true);
        $execution_time = number_format($time_end - $time_start, 3);
        return $this->render('test_categories', ['treeHtml' => $treeHtml, 'time' => $execution_time]);
        // header('Content-Type: application/json');
        // echo json_encode(array_values($tree));
    }
}
