<?php
/**
 * 调试输出方法
 * @author 钟土佳
 * @params:
 * $str ： 需要打印输出的变量
 * $flag ： 默认值为1 ，默认打印输出变量 $str 后退出程序，如果不想退出程序只需要传入一个 0 即可
 */
function p($str , $flag = 1){
    echo '<pre>';
    print_r($str);
    echo '</pre>';
    if($flag)exit;
}