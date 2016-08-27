<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/18
 * Time: 11:17
 */
if(!defined("STDIN")) {
    define("STDIN", fopen('php://stdin','r'));
}
//php5.2里面STDIN已经定义了
echo "Hello! What is your name (enter below):\n";
$strName = fread(STDIN, 80);
echo 'Hello ',$strName, "\n";