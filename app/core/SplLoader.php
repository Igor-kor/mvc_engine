<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 02.07.2018
 * Time: 11:55
 */

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    } else {
        throw new Exception("Class not found: " . $path, 500);
    }
});