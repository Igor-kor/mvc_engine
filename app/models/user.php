<?php

/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 01.07.2018
 * Time: 20:04
 */
namespace app\models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * Class User
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $login;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    protected $rules;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    protected $password;

    public function auth($login, $pass)
    {
        if ($this->login == $this->getString($login) && $this->checkPass($pass)) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    private function checkPass($pass)
    {
        if ($this->password == $this->getString($pass)) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    public function register($arg = [])
    {
        if (!isset($arg['name']) || !isset($arg['login']) || !isset($arg['password'])
            || $arg['name'] == '' || $arg['login'] == '' || $arg['password'] == ''
        ) {
            throw new \Exception('Не все поля заполнены!', 403);
        }
        $this->name = $this->getString($arg['name']);
        $this->login = $this->getString($arg['login']);
        $this->password = $this->getString($arg['password']);
        $this->rules = "user";
    }

    private function getString($string)
    {
        return htmlspecialchars(trim($string));
    }
}