<?php
/*
 * Instead the way above, you can use the two lines below
 * if you're using Composer (http://getcomposer.org):
 * $loader = require 'vendor/autoload.php';
 * $loader->add('Geeklist', '/path/to/geeklist-php');
*/
require __DIR__ . '/Geeklist/SPLClassLoader.php';
$classLoader = new \Geeklist\SPLClassLoader('Geeklist', __DIR__);
$classLoader->register();

/*
 * \Geeklist\Card(username, OUTPUT_FORMAT);
 * Constants for OUTPUT_FORMAT:
 *    \Geeklist\OUTPUT_ARRAY - For output as array;
 *    \Geeklist\OUTPUT_JSON  - For output as JSON.
*/
$card_handler = new \Geeklist\Card('arglbr', \Geeklist\OUTPUT_ARRAY);

/*
 * All this horn for two methods: :-)
 *    \Geeklist\Card::getAllCards():
 *    Fetch all cards for a given user;
 *
 *    \Geeklist\Card::getRandomCard():
 *    Fetch a random card for a given user,
*/
try {
    print print_r($card_handler->getAllCards(), true) . PHP_EOL;
    print print_r($card_handler->getRandomCard(), true) . PHP_EOL;
} catch (Exception $e) {
    print 'Exception raised with the message: ' . $e->getMessage() . str_repeat(PHP_EOL, 2);
}
