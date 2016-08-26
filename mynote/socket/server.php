<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/9
 * Time: 17:17
 */
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
//本地IP
$address = 'localhost';
//设置用111端口进行通信
$port = 80;
//创建SOCKET
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {
    echo "socket创建失败原因 " . socket_strerror($sock) . "\n";
}

if (($ret = socket_bind($sock, $address, $port)) < 0) {
    echo "创建套接字失败原因 " . socket_strerror($ret) . "\n";
}
//监听
if (($ret = socket_listen($sock, 5)) < 0) {
    echo "监听失败原因 " . socket_strerror($ret) . "\n";
}
do {
    //接收命令
    if (($msgsock = @socket_accept($sock)) < 0) {
        echo "命令接收失败原因: " . socket_strerror($msgsock) . "\n";
        break;
    }
    $msg = "\nPHP Test Server. \n" ."用quit,shutdown,sun...等命令测试.\n";

    @socket_write($msgsock, $msg, strlen($msg));

    do {
        if (false === ($buf = @socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo "socket_read() failed: reason: " . socket_strerror($ret) . "\n";
            break 2;
        }
        if (!$buf = trim($buf)) {
            continue;
        }
        if ($buf == 'quit') {
            break;
        }
        if ($buf == 'shutdown') {
            socket_close($msgsock);
            break 2;
        }
        if ($buf == 'sun') {
            echo'what are you doing?';
        }
        $talkback = "Backinformation : '$buf'.\n";
        socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    } while (true);

    socket_close($msgsock);

} while (true);

socket_close($sock);
?>