<?php

use app\controllers\ProductController;
use app\controllers\SiteController;
use thecodeholic\phpmvc\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/products', [ProductController::class, 'index']);
$app->router->get('/products/getProducts', [ProductController::class, 'getProducts']);
$app->router->get('/products/getProduct', [ProductController::class, 'getProduct']);

$app->run();
