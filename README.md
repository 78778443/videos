## 一、背景

家里视频很多，迅速搭建流媒体服务

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