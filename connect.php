<?php
// 连接数据库的功能代码
$host = 'localhost';
$username = 'root';
$password = '73582576';
$dbname = 'photomanager';  // 要连接的数据库名称
$port = '3307';
$charset = 'utf8';  // 设置字符串集
$link = mysqli_connect($host, $username, $password, $dbname, $port);

if (!$link) {
    // 连接数据库失败的情况
    // die函数结束程序执行也可以使用exit()
    // mysqli_connect_error() 能够抛出错误信息
    die('系统错误信息：' . mysqli_connect_error());
}

// 数据库连接成功

// 选择数据库
if (!mysqli_select_db($link, $dbname)) {
    // 选择数据库失败
    die('数据库选择失败');
}


// 设置客户端字符集
mysqli_set_charset($link, $charset);


