<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use thecodeholic\phpmvc\Controller;
use thecodeholic\phpmvc\Request;
use thecodeholic\phpmvc\Response;

class ProductController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $queryParams = $request->getBody();
        $categoryId = $queryParams['category'] ?? null;
        $orderBy = $queryParams['order'] ?? 'price';
        $categories = Category::getAllWithProductCount();
        $products = Product::getAll($categoryId, $orderBy);

        return $this->render('products', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function getProduct(Request $request, Response $response)
    {
        $queryParams = $request->getBody();
        $id = $queryParams['id'];
        $product = Product::getOne($id);
        header('Content-Type: application/json');
        echo json_encode($product);
    }
    public function getProducts(Request $request, Response $response)
    {
        $queryParams = $request->getBody();
        $categoryId = $queryParams['category'] ?? null;
        $orderBy = $queryParams['order'] ?? 'price';
        $products = Product::getAll($categoryId, $orderBy);
        header('Content-Type: application/json');
        echo json_encode(['products' => $products]);
        return;
    }
}


