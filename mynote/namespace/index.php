<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/13
 * Time: 13:56
 */
include 'test.php';
class index{
    public function a(){
        echo basename(__FILE__);
        echo '<br>';
        echo __CLASS__ . ' : ' . __METHOD__;
    }
}
$obj = new index();
$obj->a();
echo '<br>';
$obj1 = new test\index();
$obj1->a();