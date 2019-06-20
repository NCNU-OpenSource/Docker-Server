# Docker-Server
---
# Group 5
# Group member
1. 資工四 104321051 林煒星
2. 資工四 104321062 王子佳

## 簡介
- 自己的電腦不能長期開啟, 那要怎麼樣才能把自己的服務有效的執行呢? 所以我們決定自己來建一個 docker server 來幫忙!!
- 查看學校包裹的網站資料非常的亂, 看著就不順眼, 所以我們就想自己做一個包裹查詢網頁

## 功能
- 使用 docker 並建立多個 container 維持服務的有效性
- 查看宿舍包裹資訊
- 在網頁呈現，快速查詢
- 定時更新資料，確保最新的資訊

## 開發環境
- Ubuntu 18.04
- Debian version 9
- Docker version 18.09.6
- Python 3

## 套件安裝
### 安裝 Docker
- set up the repository
```
sudo apt-get update
sudo apt-get install apt-transport-https ca-certificates curl gnupg2 software-properties-common
curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
```
- install docker-ce
```
sudo apt-get update
sudo apt-get install docker-ce docker-ce-cli containerd.io
sudo apt-cache madison docker-ce
```

## 程式執行
- 把我們自製好的 image 載下來
```
docker pull seng96/package
```
- 下載並執行我們自製好的 image 成為一個 container(容器)
```
docker run -d -ti --name myPackage seng96/package bash
```

## Image 設定
- 開啟 cron 服務
```
docker exec myPackage service cron start
```
- cron 服務啟動後，container(容器)會每一分鐘自動爬資料到資料庫

## Nginx + PHP
- 讓Nginx可以跑PHP的網頁
```
docker run --restart=always --name php-fpm -v /etc/localtime:/etc/localtime:ro -v /works/www:/works/www -d seng96/php-fpm
```
- Nginx的部分
```
- docker run --restart=always --name nginx -v /etc/localtime:/etc/localtime:ro -p 80:80 -e NGINX_SITE_ROOT=/works/www -v /works/www:/works/www -v /works/nginx/log:/var/log/nginx/ --link php-fpm:phpfpm -d chengweisdocker/docker-nginx:phpfpm
```
- /works/www
- 網頁部分放在伺服器的/works/www 目錄下

## 成果展示
- 網頁呈現
![網頁](https://github.com/NCNU-OpenSource/Docker-Server/blob/master/%E5%AD%B8%E7%94%9F%E5%8C%85%E8%A3%B9%E6%9F%A5%E8%A9%A2%E7%B3%BB%E7%B5%B1.png)
- 資料庫
![db](https://github.com/NCNU-OpenSource/Docker-Server/blob/master/db.png)
- [學生包裹自助查詢系統](http://35.229.226.20/?fbclid=IwAR35dq0Svd6S-lKXD0dLKRDHWAUFnw5wnCBJk3RVlLFRGy8sekhSF1u0aP0)

## 資料參考
- [LSA-1072 Docker](https://docs.google.com/presentation/d/1wYhJkBQkx0jS-oyJG-2imdI7p93wti4XZqR9Jc49PxE/edit?usp=sharing)　
- [Get Docker CE for Debian](https://docs.docker.com/install/linux/docker-ce/debian/)
- [把 Docker Image Push 到 Docker Hub](https://ithelp.ithome.com.tw/articles/10191139)
- [利用 Docker 建構 Nginx + php-fpm 5.2(但我們用bitnami/phpfpm(PHP7)的版本) + mysql](http://blog.chengweichen.com/2015/05/docker-nginx-php-fpm-52-mysql.html?fbclid=IwAR1DuH4fd8Gt3cBI5pfpip3C8-2fR5m40GLV2vB45ALnBtmFBSLXRGH8EFE)

## 分工
- 104321051 林煒星 : Docker Server建立, DockerHub 上傳, 網頁, package.py
- 104321062 王子佳 : Docker Server建立, 資料搜集, 網頁, package.py


