<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/21
 * Time: 14:09
 */
header("Content-type:text/html;charset=utf-8");
//$arr['name'] ='root';
//$arr['password'] = 'root';
//1.获取地址栏参数：
//$_SERVER['QUERY_STRING'];
file_put_contents(__DIR__.'/data.txt',serialize($_POST));
echo '请求成功,用户名：'.$_SERVER["QUERY_STRING"];