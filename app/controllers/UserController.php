<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 02.07.2018
 * Time: 23:39
 */

namespace app\controllers;

use \app\core\Controller;
use app\models\User;

class UserController extends Controller
{
    public function __construct($route, $entityManager)
    {
        // Если не указаны права доступа
        if (!isset($route['users'])) {
            $route['users'] = ['anon'];
        }
        // Если пользователь не авторизован иначе получаем права пользователя
        if (!isset($_SESSION['login'])) {
            $rules = 'anon';
        } else {
            $repository = $entityManager->getRepository('app\\models\\user');
            $user = $repository->findOneBy(['login' => $_SESSION['login']]);
            $rules = $user->getRules();
        }
        // Если не указаны права или анон то доступно всем авторизованным
        if (!in_array($rules, $route['users']) && !in_array('anon', $route['users'])) {
            throw new \Exception("Недостаточно прав доступа!", 403);
        }
        parent::__construct($route, $entityManager);
    }

    function getCurrentUser()
    {
        $repository = $this->em->getRepository('app\\models\\user');
        $user = $repository->findOneBy(['login' => $_SESSION['login']]);
        return $user;
    }

    function isAuth()
    {
        // Если пользователь уже авторизован редирект
        if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
            $url = isset($this->view->config['request_url']) ? '/' . $this->view->config['request_url'] . '/' : '';
            $this->view->redirect($url);
        }
    }

    function logout()
    {
        // сбросить все переменные сессии
        $_SESSION = array();

        // сбросить куки, к которой привязана сессия
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // уничтожить сессию
        session_destroy();
    }
}
