<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 23.06.2018
 * Time: 11:48
 */

namespace app\controllers;


class MainController extends UserController
{

    function indexAction()
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            $repository = $this->em->getRepository('app\\models\\user');
            $user = $repository->findOneBy(['login' => $_SESSION['login']]);
            $this->view->render('Главная страница', ['user' => $user]);
        } else {
            $this->view->redirect('account/login');
        }
    }
}