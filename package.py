import requests
import urllib3.request
from bs4 import BeautifulSoup
import pymysql
import sys
db = pymysql.connect("localhost","user","password","dbname",use_unicode=True,charset="utf8")
cursor = db.cursor()
cursor.execute("truncate package")
urls = ['https://ccweb.ncnu.edu.tw/dormMail/','https://ccweb.ncnu.edu.tw/registered_letter/']

def getData(url):
    r = requests.get(url)
    r.encoding = 'big5-hkscs'
    html_content = r.text
    soup = BeautifulSoup(html_content,'html.parser')
    j=0
    for i in soup.find_all('tr'):
        data = []
        for tr in soup.find_all('tr')[j]:
            text = tr.text
            text = text.replace('\u3000','')
            if j >= 2:
                data.append(text)
            if len(data) == 11:
                sql = "INSERT INTO package(dorm, logID, date, name, readEmailTime, company, type, regNumber, remark, department, recDays)VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')" % \
                    (data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10])
                # print(sql)
                try:
                    cursor.execute(sql)
                    db.commit()
                except:
                    db.rollback()
        j += 1

def getData2(url):
    r = requests.get(url)
    r.encoding = 'big5-hkscs'
    html_content = r.text
    soup = BeautifulSoup(html_content,'html.parser')
    j=0
    for i in soup.find_all('tr'):
        data = []
        for tr in soup.find_all('tr')[j]:
            text = tr.text
            text = text.replace('\u3000','')
            if j >= 2:
                data.append(text)
            if len(data) == 10:
                sql = "INSERT INTO package(logID, date, name, readEmailTime, company, type, regNumber, remark, department, recDays)VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')" % \
                    (data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9])
                # print(sql)
                try:
                    cursor.execute(sql)
                    db.commit()
                except:
                    db.rollback()
        j += 1
getData(urls[0])
getData2(urls[1])

db.close
