<?php
require ('/put/the/absolute/path/to/geeklist.php');

use \Br\Eng\Arglbr\Geeklist as Geeklist;

$a = new Geeklist\Card('arglbr', Geeklist\OUTPUT_JSON);
print print_r($a->getAllCards(), true) . PHP_EOL;
print print_r($a->getRandomCard(), true) . PHP_EOL;
