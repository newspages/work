<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/6
 * Time: 15:14
 * 功能: 使用ob缓存实现页面静态化，提高网站速度，解决大并发问题的重要方案之一，可以立竿见影
 */
require_once '../Db.class.php';
require_once '../function.php';
header("Content-type:text/html;charset=utf-8");
//开始时间
$start = time();
//将生成的缓存文件写道html文件中
$id=$_GET['id'];
$filename="static_id_".$id.".html";
$status=filemtime($filename)+30>time();//判断文件创建及修改时间距当前时间是否超过30秒（30秒刷新一次更新静态页面文件）
if(file_exists($filename)&&$status){//如果没有超过设定的时间，直接输出静态页面文件
    $str=file_get_contents($filename);
    echo '这是缓存文件<br/>';
    echo $str;
}else{
    $db = new Db();//实例化自定义的数据库类
    $conn = $db->conn;//获取数据库连接
    $sql = "select * from car_user order by UserId desc limit 10000";
    $result = mysql_query($sql,$conn);
    while($row = mysql_fetch_assoc($result)){
        $rows[] = $row;
    }
    if(empty($rows)){
        echo "数据为空";
    }else{
        /***缓存开始***/
        ob_start();//下面的内容将存到缓存区中,显示的内容都将存到缓存区
        /*下面写的是要缓冲的内容*/
        p($rows,0);
        /*到这里已经完成文件缓存*/
        $content=  ob_get_contents();//从缓存中获取内容
        ob_end_clean();//关闭缓存并清空
        /***缓存结束***/
        file_put_contents($filename, $content);//将ob缓存区域中的内容输出到一个静态文件.html文件中
        echo '<br/>content'.$content;
    }
}
$end = time();
$total = $end - $start;
echo "总共耗时：".$total;