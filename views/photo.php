<?php
require_once '../connect.php';

session_start();

// 判断是否是登录状态
if (empty($_SESSION['username'])) {
    // 不是登录状态
    header("refresh:3;url=./login.php");
    die();
}

// 查询所有的数据
$aql = 'select * from photos order by id desc ';
$result = mysqli_query($link, $aql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>相册首页</title>
    <style type="text/css">
        /*全局样式*/
        body, ul, li, h2, a {
            margin: 0;
            padding: 0;
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

        .photos {
            padding: 15px;
        }

        .photos li {
            float: left;
            width: 290px;
            padding: 8px 5px;
            margin: 10px;
            text-align: center;
            border: 1px solid #409eff;
        }

        .photos img {
            width: 280px;
            height: 160px;
        }

        .pagelist {
            height: 40px;
            line-height: 40px;
            text-align: center;
        }

        .pagelist a {
            padding: 8px 15px;
            margin: 0px 3px;
            border: 1px solid #ccc;
        }

        .pagelist a:hover {
            border: 1px solid #0000ff;
        }

        .pagelist .current {
            padding: 8px 15px;
        }
    </style>
</head>
<body>
<div class="box">
    <!--title-->
    <div class="title">
        <h2>我的相册</h2>
        <a href="../views/upload.php">上传照片</a>
        共有个<font color='#409eff'><?php echo $total ?></font>照片
    </div><!--//title-->
    <!--photos-->
    <div class="photos">
        <ul>
            <?php
            foreach ($data as $item) {
                ?>
                <li>
                    <a href="./detail.php?id=<?php echo $item['id'] ?>"><img src="<?php echo $item['imgPath'] ?>"></a>
                    <a href="./detail.php?id=<?php echo $item['id'] ?>"><?php echo $item['title'] ?></a>
                </li>
                <?php
            }
            ?>
        </ul>
        <div style="clear:both"></div>
        <div class="pagelist">
        </div>
    </div><!--//photos-->
</div><!--//box-->
</body>
</html>