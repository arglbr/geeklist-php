<?php
require ('arglbr/Geeklist/Loader/Autoloader.php');
$classLoader = new arglbr\Geeklist\Loader\Autoloader('arglbr\Geeklist', dirname(__FILE__) . '');
$classLoader->register();

use arglbr\Geeklist as Geeklist;

$card_handler = new Geeklist\Card('arglbr', Geeklist\OUTPUT_ARRAY);
print print_r($card_handler->getAllCards(), true) . PHP_EOL;
print print_r($card_handler->getRandomCard(), true) . PHP_EOL;

