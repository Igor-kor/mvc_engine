<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 30.06.2018
 * Time: 14:49
 *
 * http://doctrine-orm.readthedocs.io/en/latest/reference/configuration.html#setting-up-the-commandline-tool
 */

require_once "vendor/autoload.php";

$paths = array(__DIR__ . "\\..\\app\\models");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'    => 'pdo_mysql',
    'user'      => 'mvcengine',
    'password'  => 'mvcengine',
    'dbname'    => 'mvcengine',
    'charset'   => 'UTF8',
);
