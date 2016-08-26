<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/4
 * Time: 16:39
 */
$str = "The string ends in escape: a";
$str .= chr(28); /* 在 $str 后边增加换码符 */
echo chr(27);exit(0);
/* 通常这样更有用 */

$str = sprintf("The string ends in escape: %c", 28);
echo $str;
