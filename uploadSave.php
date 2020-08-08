<?php
require_once './connect.php';
// 判断是否是非法提交
session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['token']) {
    // 判定为非法提交
    header('location:./views/login.php');
    die();
}

// 判断上传图片的合法性
if ($_FILES['uploadFile']['error'] != 0) {
    // 上传的图片有错误
    echo '<h2>上传的图片有错！</h2>';
    header('refresh:3;url=./upload.php');
    die();
}


// 判断文件扩展名是否是图片类型

// 获取文件扩展名
$extension = pathinfo($_FILES['uploadFile']['name'],PATHINFO_EXTENSION);

// 定义一个扩展名数组
$img_extensions = array('jpg','png','gif');
if (!in_array($extension,$img_extensions)) {
    // 不是规定的扩展名
    echo '<h2>上传文件类型不符合规定！</h2>';
    header('refresh:3;url=./upload.php');
    die();
}


// 判断上传的图片内容是否是真的图片

// 创建finfo资源
$finfo = finfo_open(FILEINFO_MIME_TYPE);

// 获取文件内容的原始类型
$content_type = finfo_file($finfo,$_FILES['uploadFile']['tmp_name']);

// 定义一个图像类型数组
$img_content = array('image/jpeg','image/png','image/gif');
if (!in_array($content_type,$img_content)) {
    // 不是图片类型的内容
    echo '<h2>上传文件类型有错！</h2>';
    header('refresh:3;url=./upload.php');
    die();
}


// 验证成功上传图片
$tmp_name = $_FILES['uploadFile']['tmp_name'];
$save_path = "../assets/images/".uniqid().".".$extension;

//echo $tmp_name, $save_path;

move_uploaded_file($tmp_name,$save_path);

// 验证成功
// 提交数据
$title = $_POST['title']; // 图片标题
$content = $_POST['intro']; // 照片描述
$addTime = time(); // 上传时间

// 上传数据库
$sql = "insert into photos (title,imgPath,content,addTime) values ('$title','$save_path','$content','$addTime')";
// echo $sql;

// 执行sql语句
if (mysqli_query($link,$sql)) {
    // 执行成功
    echo '上传成功';
    header('refresh:3;url=./views/photo.php');
    die();
}