# -*- coding: utf-8 -*-

import sys
import requests
from bs4 import BeautifulSoup
#导入城市列表
from city import city

def gethtml(url):
    return requests.get(url).content

def parsehtml(html):
    soup = BeautifulSoup(html,'html.parser')
    clearfix = soup.find('ul',attrs={'class','t clearfix'})
    today = clearfix.find('li',attrs={'class','on'})
    list = today.get_text().split()
    dat = list[0]
    wea = list[1]
    tem = list[2]
    win = list[3]
    print(dat)
    print(wea)
    print(tem)
    print(win)

print(sys.argv[1])
try:
    i = int(city[sys.argv[1]])
    url = 'http://www.weather.com.cn/weather/%d.shtml'%i
    html = gethtml(url)
    parsehtml(html)
except:
    print ('该城市不存在')