<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/1
 * Time: 13:44
 */
$url = "http://www.sina.com.cn";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL ,"http://www.baidu.com");
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_exec($ch);
//curl_close($ch);