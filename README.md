## 一、背景

家里电脑中收藏了很多视频,笔者想将自己收藏的一些电影放到网站上可以用来随时播放，不过遇到了一个问题，便是如果直接将 MP4 文件放放到网站目录当中，手机端必须下载整个视频才可以播放，而如果跨外网传输，这实在是不太现实。

为了解决这个问题，便想着搭建一套流媒体服务，这样手机就可以边看边下载，查询了一些资料了了解到需要先将视频分成一小片来传输，比如将 MP4 转码为 M3U8 格式，查询了相关转码方法，比较主流的方式是使用 ffmpeg 这个开源工具，这个项目中使用了FFmpeg+docker的方式能够让你迅速搭建流媒体服务。

## 二、启动方法

2.1 运行容器命令

```
docker run --name videos -d -i -p 8811:80   -v /Users/song/files/videos:/data/videos  daxia/videos:latest
```

2.2 启动Nginx服务和PHP

```
docker exec videos zsh -c "nginx && /usr/sbin/php-fpm7.2 -R"
```

2.3 启动FRP链接

```
docker exec videos zsh -c " /root/files/frp/frpc -c /root/files/frp/frpc.ini  >> frp.log"   &
```


## 三、访问

接下来访问网址即可，网址如下
```
http://video.qsjianzhan.com:8089/
```
