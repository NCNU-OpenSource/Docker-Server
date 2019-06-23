FROM ubuntu:18.04
MAINTAINER Seng

ADD package.py /root/package.py
ADD startup.sh /
ADD crontabfile /etc/cron.d/package-cron

RUN apt-get update && apt-get install python3 python3-pip cron -y
RUN crontab /etc/cron.d/package-cron

CMD ["bash","/startup.sh"]
