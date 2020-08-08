<?php
require_once '../connect.php';

session_start();

// 判断是否是登录状态
if (empty($_SESSION['username'])) {
    // 不是登录状态
    header("refresh:3;url=./login.php");
    die();
}

// 获取id值
$id = $_GET['id'];

// 实现访问点击数增加
$visit_sql = "update photos set visit = visit + 1 where id = $id";
mysqli_query($link,$visit_sql);

// 执行查询语句
$sql = "select * from photos where id = $id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>照片详细信息</title>
    <style type="text/css">
        /*全局样式*/
        body, ul, li, h2, a {
            margin: 0;
            padding: 0
        }

        body {
            font-size: 14px;
            color: #444;
            background-color: #808080;
        }

        ul, li {
            list-style: none;
        }

        a {
            text-decoration: none;
            color: #444;
        }

        a:hover {
            color: #409eff;
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

        .detail {
            padding: 15px 100px;
        }

        .detail div {
            text-align: center;
        }

        .detail img {
            width: 640px;
        }

        .detail p {
            font-size: 16px;
            text-indent: 36px;
            font-family: 微软雅黑;
            line-height: 28px;
        }
    </style>
</head>
<body>
<div class="box">
    <!--title-->
    <div class="title">
        <h2><?php echo $data['title'] ?></h2>
        访问<font color=#409eff><?php echo $data['visit'] ?></font>次，
        发布时间 <font color=#409eff><?php echo date("Y-m-d H:i:s", $data['addTime']) ?></font>，
        <a href="./photo.php">返回首页</a>
    </div><!--//title-->
    <!--photos-->
    <div class="detail">
        <div class="photo"><img align="center" src="<?php echo $data['imgPath'] ?>"></div>
        <p><?php echo $data['content'] ?></p>
    </div><!--//photos-->
</div><!--//box-->
</body>
</html>
