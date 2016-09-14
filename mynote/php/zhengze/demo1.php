<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/4
 * Time: 11:38
 */
header("Content-type:text/html;charset=utf-8");
//要匹配的字符串
$str = "adjksasafdkadf22-66-22-66jkajsdfkjakfafajkdf1234566-88-66-88adjfjadjklajfkaskdkasadj ";

/*
    正则表达式中的 ^ 用法
 */
//正则表达式
$preg = '/^[a-z](dj){2}/';//匹配首位置的d字符，其它位置的d字符将不会被匹配出来
//$preg = '/d/';//匹配任意位置的d字符
preg_match_all($preg,$str,$res);

$regex = '/^http:\/\/([\w.]+)\/([\w]+)\/([\w]+)\.html$/i';
$str = 'http://www.youku.com/show_page/id_ABCDEFG.html';
preg_match($regex,$str,$res);
p($res,0);
$regex = '/^http:\/\/([\w.]+)\//i';
preg_match($regex,$str,$res);
p($res);
/*
    正则表达式中的 * 的用法
 */
$preg = '/2*/';
preg_match_all($preg,$str,$res);

/*
    正则表达式中的 [0-9]和 \d 的用法
 */
$preg = '/[0-9]/';//匹配0-9的任意数字，等价于 \d 也是匹配0-9的任意数字，如果是这么写[0-9]\d那么就是匹配两个任意的数字
preg_match_all($preg,$str,$res);

/*
    正则表达式中的 字表达式用法
 */
$preg = '/(\d){2}-([0-9]){2}-\1{2}-\2{2}/';
preg_match_all($preg,$str,$res);

//匹配邮箱的正则表达式
//匹配以字符或者下划线开头的 2 个以上的126或者163邮箱名称
$str = '__@163.cn';
$preg = '/^[a-zA-Z_]{2,}@(163|126).(com|cn|yet)$/';
if(preg_match($preg,$str)){
    echo '恭喜邮箱验证成功';
}else{
    echo '对不起！邮箱验证失败';
}
echo '<br/>';
//匹配电话号码的正则表达式
$str = '13031266732';
$preg = '/^(13\d)[0-9]{8}$/';
if(preg_match($preg,$str)){
    echo '恭喜手机验证成功';
}else{
    echo '对不起！手机验证失败';
}
function p($str , $flag = 1){
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}
