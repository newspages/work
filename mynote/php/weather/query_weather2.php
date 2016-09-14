<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/16
 * Time: 17:00
 */
header("Content-type:text/html;charset=utf-8");
$city="北京";
$url = "http://php.weather.sina.com.cn/xml.php?city=$city&password=DJOYnieT8234jlsK&day=0";
$content = file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location=%E5%98%89%E5%85%B4&output=json&ak=5slgyqGDENN7Sy7pw29IUvrZ");
$content = file_get_contents($url);
echo '<pre>';
print_r(json_decode($content));
echo '</pre>';