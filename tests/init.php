<?php
/**
 * Unit test bootloader for geeklist-php
 *
 * @package   geeklist-php
 * @author    Adriano Laranjeira <adriano@argl.eng.br>
 * @link      https://github.com/arglbr/geeklist-php
*/

require __DIR__ . '/../Geeklist/SPLClassLoader.php';
$classLoader = new \Geeklist\SPLClassLoader('Geeklist', __DIR__ . '/..');
$classLoader->register();

date_default_timezone_set('UTC');
