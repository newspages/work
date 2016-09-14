<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/13
 * Time: 11:05
 */
//namespace Home;
//use Home\Controller\UserController;
require 'Application/Home/Controller/UserController.class.php';
$user = new UserController();
$user->user();