<?php

/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 15:01
 */
namespace app\core;

use app\core\View;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Router
{
    protected $routes = [];
    protected $params = [];
    protected $request_url = "";

    function __construct()
    {
        require_once 'config/bootstrap.php';
        //why false -> https://stackoverflow.com/questions/17473225/doctrine2-no-metadata-classes-to-process
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
        $entityManager = EntityManager::create($dbParams, $config);
        $this->em = $entityManager;
        $arr = require 'config/routes.php';
        $config = require 'config/config.php';
        if (isset($config['request_url'])) {
            $this->request_url = $config['request_url'];
        }
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        if (isset($route) && $route != '') {
            $route = '#^' . $this->request_url . '/' . $route . '$#';
        } else {
            $route = '#^' . $this->request_url . '$#';
        }
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $mathes)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        // Проверка урл
        if ($this->match()) {
            $path = 'app\\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            // Проверка существования файла класса
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                // Проверка существования экшэна
                if (method_exists($path, $action)) {
                    // Запускаем
                    $controller = new $path($this->params, $this->em);
                    $controller->$action();
                } else {
                    throw new \Exception("action not found:" . $action, 404);
                }
            } else {
                throw new \Exception("class controller: " . $path . " not found", 404);
            }
        } else {
            throw new \Exception("404", 404);
        }
    }
}