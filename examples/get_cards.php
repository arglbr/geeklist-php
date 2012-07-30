<?php
require ('arglbr/geeklist/card.php');

use ArglBR\Geeklist as Geeklist;

$a = new Geeklist\Card('arglbr', Geeklist\OUTPUT_ARRAY);
print print_r($a->getAllCards(), true) . PHP_EOL;
print print_r($a->getRandomCard(), true) . PHP_EOL;
