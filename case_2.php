<?php
require __DIR__ . '/init.php';

$app = new App();
foreach ($depots as $depot) {
    $app->addDepot($depot);
}

try {
    $app->addToDepot($products[0], 1100);
}
catch (AppException $e) {
    echo $e;
}

echo "...over\n";
