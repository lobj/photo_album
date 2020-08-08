<?php
session_start();

// 判断是否是登录状态
if (empty($_SESSION['username'])) {
    // 不是登录状态
    header("refresh:3;url=./login.php");
    die();
}

// 生成token值,用于验证上传相册的合法性
$_SESSION['token'] = uniqid();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>上传照片</title>
    <style type="text/css">
        /*全局样式*/
        body, h2, form, a {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 14px;
            color: #444;
            background-color: #808080;
        }

        a {
            text-decoration: none;
            color: #444;
        }

        a:hover {
            color: red;
        }

        /*局部样式*/
        .box {
            width: 1000px;
            margin: 100px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 2px 1px 1px #cccccc;
            border: 1px solid #cccccc;
        }

        .title {
            text-align: center;
            padding: 10px 0;
            background-color: #f9fafc;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .title h2 {
            font-size: 36px;
            padding: 10px;
        }

        form {
            padding: 30px;
            height: 400px;
        }

        form td {
            padding: 8px;
        }

        .submit input {
            color: #fff;
            background-color: #409eff;
            padding: 10px 18px;
            font-size: 14px;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            box-sizing: border-box;
            border: 1px solid #dcdfe6;
            cursor: pointer;
        }
        .submit input:active, .submit input:focus {
            outline: none;
            background: #3a8ee6;
            border-color: #3a8ee6;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="box">
    <!--title-->
    <div class="title">
        <h2>上传照片</h2>
        <a href="./photo.php">返回首页</a>
    </div><!--//title-->
    <!--form-->
    <form method="post" action="../uploadSave.php" enctype="multipart/form-data">
        <table align="center" width="600">
            <tr>
                <td width="100" align="right">照片标题：</td>
                <td><input type="text" name="title" size="60"></td>
            </tr>
            <tr>
                <td align="right">上传照片：</td>
                <td><input type="file" name="uploadFile"></td>
            </tr>
            <tr>
                <td align="right">照片描述：</td>
                <td><textarea name="intro" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td class="submit">
                    <input type="submit" value="提交">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    <input type="reset" value="重置">
                </td>
            </tr>
        </table>
    </form><!--//form-->
</div><!--//box-->
</body>
</html>
