<?php
require __DIR__ . '/init.php';

$app = new App();
foreach ($depots as $depot) {
    $app->addDepot($depot);
}

try {
    $app->addToDepot($products[0], 10);
    $app->removeFromDepot($products[0], 1000);
}
catch (AppException $e) {
    echo $e;
}

echo "...over\n";
