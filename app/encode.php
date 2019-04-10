<?php
session_start();
error_reporting(0);

include "head.php";

//接收必要参数
$name = $_GET['name'] ?? '1.mp4';
$forced = $_GET['forced'] ?? 0;
$fileName = getFileName($name);


$outPath = '/data/videos';
$inPath = '/data/videos';
$dir = __DIR__;

//判断之前是否已经转码,如果不强制转码便先返回
if (file_exists("$outPath/$fileName/index0.ts") && empty($forced)) {
    header("location:./static/{$fileName}/index.m3u8");
    die;
}

//将目标映射过来
if (!file_exists("{$dir}/static")) {
    $cmd = "ln -s {$outPath}  {$dir}/static";
    system($cmd);
}

//先创建文件夹
$cmd = "mkdir -p {$outPath}/{$fileName}";
system($cmd);

//进行转码
$cmd = "ffmpeg -i '{$inPath}/{$name}'  -hls_time 12 -hls_list_size 0 -f hls -r 25 '{$inPath}/{$fileName}/index.m3u8' >> ./code.log &";
system($cmd);


//延时执行跳转
echo returnUrl($fileName);

function getFileName($filename)
{
    $houzhui = substr(strrchr($filename, '.'), 1);
    $result = basename($filename, "." . $houzhui);

    return $result;

}


function returnUrl($fileName)
{
    return "<a class='btn  btn-video btn-lg' href='./static/{$fileName}/index.m3u8'><h1>正在转码中...点击进行跳转</h1></a>";

}