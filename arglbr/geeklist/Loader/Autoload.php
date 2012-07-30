<?php
namespace ArglBR\Geeklist;

class Autoload
{
	public static function loadClass($className)
	{
		$className = ltrim($className, '\\');
		$fileName  = '';
		$namespace = '';

		if ($lastNsPos = strripos($className, '\\')) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}

		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		$fileName .= strtolower($fileName);
		require $fileName;
	}
	
}
