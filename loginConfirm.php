<?php

// 连接数据库判断token值
require_once './connect.php';

session_start();
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    // 验证成功

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm = $_POST['confirm']; // 验证码

    // 验证验证码是否正确
    if (strtolower($confirm) != $_SESSION['captcha']) {
        // 验证不通过
        echo '<h2>验证码输入错误!</h2>';
        header("refresh:3;url=./views/login.php");
        die();
    }

    // 验证登录的账号和密码  验证码是否正确
    $sql = "select * from users where username = '$username' and password = '$password'";
    $result = mysqli_query($link,$sql);

    if (mysqli_num_rows($result) == 0) {
        // 查询失败，登录验证失败
        echo '<h2>账号或密码错误！</h2>';
        header("refresh:3;url=./views/login.php");
        die();
    }

    // 登录成功
    // session中保存用户信息,用于验证是否是登录状态
    $_SESSION['username'] = $username;
    // 跳转到相册主页
    header("location:./views/photo.php");

}else {

    // 验证失败
    header("location:./views/login.php");
}
