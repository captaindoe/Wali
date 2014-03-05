<?php

use captaindoe\Wali;

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

$wali = new Wali(
    '5e663b87c664ee2a7c246703027252eb76279f4c',
    '1eed5cc655ea98d'
);

try {
    $wali->generate("0735295405");
} catch (Exception $ex) {
    echo json_encode(array('status' => false, 'error' => $ex->getMessage()));
    die();
}

echo json_encode(array('status' => true));

?>