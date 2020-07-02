<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 22:32
 */

namespace app\controllers;

use app\models\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class AccountController extends UserController
{
    public function loginAction()
    {
        try {
            $this->isAuth();
            if (isset($this->post['login']) && isset($this->post['password'])) {
                $repository = $this->em->getRepository('app\\models\\user');
                $user = $repository->findOneBy(['login' => $this->post['login']]);
                if ($user == null) {
                    throw new \Exception('User not found', 403);
                }
                if ($user->auth($this->post['login'], $this->post['password'])) {
                    $url = isset($this->view->config['request_url']) ? '/' . $this->view->config['request_url'] . '/' : '';
                    $this->view->redirect($url);
                } else {
                    throw new \Exception('Bad password', 403);
                }
            } else {
                $this->view->render('Вход');
            }
        } catch (\Exception $e) {
            if ($e->getCode() == 403) {
                $this->view->render('Вход', ['error' => $e->getMessage()]);
            } else throw $e;
        }
    }

    public function logoutAction()
    {
        $this->logout();
        $url = isset($this->view->config['request_url']) ? '/' . $this->view->config['request_url'] . '/' : '';
        $this->view->redirect($url);
    }

    function profileAction()
    {
        $user = $this->getCurrentUser();
        $this->view->render('Мой профиль', ['name' => $user->getName(), 'login' => $user->getLogin(), 'rules' => $user->getRules()]);
    }

    function registerAction()
    {
        try {
            $this->isAuth();
            if ($this->post == null) {
                $this->view->render('Регистраия');
            } else {
                if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
                    throw new \Exception('Вы уже авторизованны, выйдети из пользователя', 403);
                }
                $user = new User();
                $user->register($this->post);
                $this->em->persist($user);
                $this->em->flush();
                $this->view->render('Регистраия', ['register' => true]);
            }
        } catch (UniqueConstraintViolationException $e) {
            $this->view->render('Регистраия', ['error' => 'Указаный пользователь уже существует!']);
        } catch (\Exception $e) {
            if ($e->getCode() == 403) {
                $this->view->render('Регистраия', ['error' => $e->getMessage()]);
            } else {
                throw $e;
            }
        }
    }

}