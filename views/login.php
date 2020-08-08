<?php
//创建随机token值
session_start();

$_SESSION['token'] = uniqid();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<link rel="stylesheet" href='../public/login.css'>
<body>
<div class="loginBox">
    <form action="../loginConfirm.php" method="post">
        <div class="header">用户登录</div>
        <div class="login">
            <div class="username">
                <label for="username">
                    <span class="label">用户名：</span>
                    <input type="text" id="username" name="username">
                </label>
            </div>
            <div class="password">
                <label for="password">
                    <span class="label">密码：</span>
                    <input type="password" id="password" name="password">
                </label>
            </div>
            <div class="confirm">
                <label for="confirm">
                    <span class="label">验证码：</span>
                    <input type="text" id="confirm" name="confirm">
                </label>
                <div class="captcha" style="width: 123px;height: 40px;border: 1px solid #cccccc;display: block;cursor: pointer">
                    <img src="../captcha.php" onclick="this.src='../captcha.php?'+Math.random();">
                </div>
            </div>
        </div>
        <div class="submit">
            <input type="submit" value="登录" id="logButton">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token']?>">
            <input type="button" value="重置" id="reset">
        </div>
    </form>
 </div>
</body>
</html>