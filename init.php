<?php
define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function ($className) {
    $className = str_replace(['/', '\\'], DS, $className);
    require_once __DIR__ . DS .  $className . '.php';
});

// ===== Build objects =====
$data = [
    'brands'     => include __DIR__ . DS . 'data' . DS . 'brands.php',
    'products'   => include __DIR__ . DS . 'data' . DS . 'products.php',
    'depots'     => include __DIR__ . DS . 'data' . DS . 'depots.php',
];

try {
    $brands     = Methods::buildBrands($data['brands']);
    $products   = Methods::buildProducts($data['products'], $brands);
    $depots     = Methods::buildDepots($data['depots'], $products);
}
catch (AppException $e) {
    echo $e;
}
// ===== Build objects - END =====
