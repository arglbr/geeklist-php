<?php
require 'Geeklist/Loader/Autoloader.php';
$classLoader = new \Geeklist\Loader\Autoloader('Geeklist', dirname(__FILE__) . '');
$classLoader->register();

$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);
print print_r($card_handler->getAllCards(), true) . PHP_EOL;
print print_r($card_handler->getRandomCard(), true) . PHP_EOL;
//
//
