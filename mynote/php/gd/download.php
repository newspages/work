<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/9
 * Time: 11:53
 */
$file = $_GET['image'];
header("Content-type: octet/stream");
header("Content-disposition:attachment;filename=".$file.";");
header("Content-Length:".filesize($file));
readfile($file);
exit;