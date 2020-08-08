<?php
// 验证码生成


// 生成四位随机验证码
// 生成一个包含验证码的数组,并且打乱
$arr = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
shuffle($arr);
// 从数组中随机挑选出四位
$ranIndex = array_rand($arr, 4);

// 组成一个四位字符串
$str = '';
foreach ($ranIndex as $index) {
    $str .= $arr[$index];
}

// 将验证码存入session中
session_start();
$_SESSION['captcha'] = strtolower($str);

// 生成画布
$width = 123;
$height = 40;

$img = imagecreatetruecolor($width, $height);

// 给定随机背景颜色值
// 封装成一个函数
function ranColor ($img) {
    return imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
}
// $ranColor = imagecolorallocate($img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));

// 画一个矩形
imagefilledrectangle($img, 0, 0, $width, $height, ranColor($img));

// 写入文字
$fontfile = 'D:/web_project/php/00font_resourse/msyh.ttf';  // 必须是ttf文件的绝对路径，路径中不能有中文

imagettftext($img, 33, 0, 5, 38, ranColor($img), $fontfile, $str);

// 画一些像素点
for ($i = 1; $i <= 200; $i++) {
    imagesetpixel($img, mt_rand(0, $width), mt_rand(0, $height), ranColor($img));
}

// 生成线条
for ($i = 1; $i <= 20; $i++) {
    imageline($img, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), ranColor($img));
}


// 打印出画布
header('Content-Type:image/png');
imagepng($img);

// 销毁画布
imagedestroy($img);

