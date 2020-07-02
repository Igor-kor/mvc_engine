<?php
/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 22.06.2018
 * Time: 21:58
 */

return [
    'account/login'=>[
        'controller'=>'account',
        'action'=>'login',
        'users'=>['anon']
    ],
    'account/logout'=>[
        'controller'=>'account',
        'action'=>'logout'
    ],
    'account/profile'=>[
        'controller'=>'account',
        'action'=>'profile',
        'users'=>['admin']
    ],
    ''=>[
        'controller'=>'main',
        'action'=>'index'
    ],
    'account/register'=>[
        'controller'=>'account',
        'action'=>'register'
    ],

];