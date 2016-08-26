<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/22
 * Time: 15:18
 */
$hash_password = password_hash('123456',PASSWORD_DEFAULT);
//echo $hash_password;
//在命令行下执行到这一句时，就暂停执行下面的语句，要求用户输入6个字符，然后回车在执行下面的语句
$enter_password = fread(STDIN,6);
echo $hash_password;
echo "\r\n";
//echo $enter_password;
$temp = password_hash('123456',PASSWORD_DEFAULT);
echo $temp;
echo "\r\n";
if(password_verify($enter_password,$hash_password)){
    echo 'success';exit;
}else{
    echo 'fail';exit;
}
//如果使用下面这种验证方式去验证密码将会得不到正确的结果，因为哈希加密是一种不可逆的加密方式，需要使用哈希提供的专门用于验证密码的函数password_verify来验证
if(password_hash($enter_password,PASSWORD_DEFAULT) == $hash_password){
    echo 'success';
}else{
    echo 'fail';
}