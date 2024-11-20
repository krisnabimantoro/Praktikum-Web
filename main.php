<?php

header("Content-Type: application/json; charset=UTF-8");

include "Routes/ProductRoutes.php";

use Routes\ProductRoutes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$productRoutes = new ProductRoutes();
$productRoutes->handle($method,$path);