<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 14:47
 */

require_once "app/lib/dev.php";
use app\core\Router;
use app\core\View;

function engineErrorHandler($errno, $errstr, $errfile = null, $errline = null, array $errcontext = array())
{
    View::errorCode(500, $errno, $errstr, $errfile, $errline, $errcontext);
    return true;
}

set_error_handler('engineErrorHandler');

try {
    require_once "app/core/SplLoader.php";
    session_start();
    $router = new Router();
    $router->run();
} catch (Exception $e) {
    View::errorCode($e->getCode(),'',$e->getMessage());
}

