<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/13
 * Time: 11:05
 */
namespace Demo;
use Home\Controller\UserController;
require 'Application/Home/Controller/UserController.class.php';
//require 'Application/Home/Controller/UserController.class.php';
//$user = new \Home\Controller\UserController();
$user = new UserController();
$user->user();