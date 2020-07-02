<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 23:18
 */

namespace app\core;

class View
{
    public $path;
    public $layout = 'default';
    public $config = null;


    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
        $this->config = require 'config/config.php';
    }

    public function render($title, $vars = [])
    {
        $config = $this->config;
        if (is_array($vars)) {
            extract($vars);
        }else{
            throw new \Exception('parametr vars in method render is not array',500);
        }
        if (file_exists('app/views/' . $this->path . '.php')) {
            ob_start();
            require 'app/views/' . $this->path . '.php';
            $content = ob_get_clean();
        } else {
            $content = "";
        }
        require 'app/views/layouts/' . $this->layout . '.php';
    }

    public static function errorCode($code = 0, $errno = "", $errstr = "", $errfile = null, $errline = null, array $errcontext = array())
    {
        $config = require 'config/config.php';
        if (!isset($code) || $code < 1) $code = 500;
        http_response_code($code);
        require 'app/views/errors/error.php';
        exit();
    }

    public function redirect($url)
    {
        header('location: ' . $url);
        exit;
    }
}