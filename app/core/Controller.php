<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 22:37
 */
namespace app\core;

use app\core\View;
use Doctrine\ORM\EntityManager;

abstract class Controller
{
    public $route;
    public $view;
    public $post;
    public $method;
    public $em;

    public function __construct($route, $entityManager)
    {
        $this->em = $entityManager;
        $this->route = $route;
        $this->view = new View($route);
        $this->method = '';
        if (isset($_POST)) {
            $this->post = $_POST;
            $this->method = 'post';
        }
    }

}