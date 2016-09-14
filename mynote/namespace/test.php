<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/13
 * Time: 13:57
 */
namespace test;
class index{
    public function a(){
        echo basename(__FILE__);
        echo '<br>';
        echo __CLASS__ . ' : ' . __METHOD__;
    }
}