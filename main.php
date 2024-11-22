<?php

header("Content-Type: application/json; charset=UTF-8");header("Access-Control-Allow-Origin: *"); // Mengizinkan semua origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // HTTP Methods yang diizinkan
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Header yang diizinkan


include "Routes/EventRoutes.php";

use Routes\EventRoutes;

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$eventRoutes = new EventRoutes();
$eventRoutes->handle($method,$path);