<?php
/**
* File for autoloading classes
*/

// PRODUCTION: Disable Error logging
ini_set('display_errors', true);
error_reporting(E_ALL);

define('DEFAULT_TIMEZONE', date_default_timezone_get());
date_default_timezone_set('UTC');

const CLASSES_PATH = __DIR__ . '/../classes/';
set_include_path(CLASSES_PATH);

spl_autoload_extensions('.php');

spl_autoload_register('___autoload');

/**
 * Autoloads classes, Processing namespaces as folders
 */
function ___autoload($className){
    $className = ltrim($className, '\\');
    $fileName  = get_include_path();
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= $className . '.php';
    if (file_exists($fileName))
        require($fileName);
}
