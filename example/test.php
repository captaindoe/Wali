<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use Captaindoe\Wali;

/**
 * Används för att skapa en engångskod
 */
$wali = new Wali('api_key', 'protocol_id');

try {

    $wali->generate('phone number');
} catch(Exception $ex) {

    echo $ex->getMessage();
}


/**
 * Används för att verifiera en engångskod.
 */
try {

    $wali->verify('phone number', 'code');
} catch(Exception $ex) {

    echo $ex->getMessage();
}

?>