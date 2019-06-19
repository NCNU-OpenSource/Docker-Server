# Docker-Server
---
# Group 2
# Group member
1. 資工四 104321051 林煒星
2. 資工四 104321024 王子佳

## 功能
- 使用 docker swarm 並建立多個 container 維持服務的有效性
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

## 成果展示
- [學生包裹自助查詢系統](http://35.229.226.20/?fbclid=IwAR35dq0Svd6S-lKXD0dLKRDHWAUFnw5wnCBJk3RVlLFRGy8sekhSF1u0aP0)

## 資料參考
- [LSA-1072 Docker](https://docs.google.com/presentation/d/1wYhJkBQkx0jS-oyJG-2imdI7p93wti4XZqR9Jc49PxE/edit?usp=sharing)　
- [Get Docker CE for Debian](https://docs.docker.com/install/linux/docker-ce/debian/)
- [把 Docker Image Push 到 Docker Hub](https://ithelp.ithome.com.tw/articles/10191139)
- [利用 Docker 建構 Nginx + php-fpm 5.2 + mysql](http://blog.chengweichen.com/2015/05/docker-nginx-php-fpm-52-mysql.html?fbclid=IwAR1DuH4fd8Gt3cBI5pfpip3C8-2fR5m40GLV2vB45ALnBtmFBSLXRGH8EFE)

## 分工
- 104321051 林煒星 : Docker Server建立, DockerHub 上傳, 網頁, package.py
- 104321062 王子佳 : 資料搜集, 網頁, package.py


