<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/14
 * Time: 10:52
 */
//php中使用mysql事务机制
header("Content-type:text/html;charset=utf-8");
$conn = mysql_connect("localhost","root","root") or die("连接数据库失败");
mysql_select_db("account",$conn);
mysql_query("utf-8");
//开启mysql事务机制
mysql_query("BEGIN");//或者 mysql_query("START TRANSACTION");
$sql1 = "update  `account` set `money` = money-1 where `namea` = 'user1'";
$sql2 = "update  `account` set `money` = money+1 where `name` = 'user2'";

$res1 = mysql_query($sql1);
$res2 = mysql_query($sql2);
echo mysql_error();
if($res1 && $res2){
    //一起提交执行sql语句
    mysql_query("COMMIT");
    echo '转账成功';
}else{
    //事务回滚
    mysql_query("ROLLBACK");
    echo '转账失败';
}

mysql_close($conn);