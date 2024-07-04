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
        $categories = Category::getAllWithProductCount();

        $filters = $request->getBody();
        $products = Product::findAllWithFilters($filters);

        return $this->render('products', [
            'categories' => $categories,
            'products' => $products,
            'selectedCategory' => $filters['category'] ?? null,
            'selectedOrder' => $filters['order'] ?? 'price',
        ]);
    }

    public function fetchProduct(Request $request)
    {
        $queryParams = $request->getBody();
        $id = $queryParams['id'];
        $product = Product::getOne($id);
        header('Content-Type: application/json');
        echo json_encode($product);
    }

    public function fetchProducts(Request $request)
    {
        $products = Product::findAllWithFilters($request->getBody());
        header('Content-Type: application/json');
        echo json_encode(['products' => $products]);
    }
}
