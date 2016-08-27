<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/9
 * Time: 17:19
 */
header("Content-type:text/html;charset=utf-8");
error_reporting(E_ALL);
//端口111
$service_port = 80;
//本地
$address = 'localhost';
//创建 TCP/IP socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket创建失败原因: " . socket_strerror($socket) . "\n";
} else {
    echo "OK，HE HE.\n";
}
$result = socket_connect($socket, $address, $service_port);
if ($result < 0) {
    echo "SOCKET连接失败原因: ($result) " . socket_strerror($result) . "\n";
} else {
    echo "开启套接字连接 OK.\n";
}
//发送命令
$in = "HEAD / HTTP/1.1\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = '';
echo "Send Command..........";
$in = "sun\n";
socket_write($socket, $in, strlen($in));
echo "OK.\n";
echo "Reading Backinformatin:\n\n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}
echo "Close socket........";
socket_close($socket);
echo "OK,He He.\n\n";
?>
