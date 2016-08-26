<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/16
 * Time: 14:19
 */
ignore_user_abort(false);
set_time_limit(0);
echo 'ignore_user_abort';
//exit;
$i = 1;
while(1) {
    $fp = fopen('time_task1.txt',"a+");
    $str = date("Y-m-d h:i:s")."\n\r";
    fwrite($fp,$str);
    fclose($fp);
    sleep(5); //半小时执行一次
    if(connection_aborted()){
        exit;
    }
    $i--;
}