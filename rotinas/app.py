

url = 'https://www.blockchain.com/explorer/addresses/btc/bc1qfcrvahytrmhd2tpkg6u30ews6f9ukhgaqt34c8';
url = 'https://www.cursohacker.com.br'
url = 'https://blockchain.info/rawaddr/bc1qfcrvahytrmhd2tpkg6u30ews6f9ukhgaqt34c8';

import os, requests, sys, traceback, hashlib, re, base64;

from bs4 import BeautifulSoup
from lxml import etree

class Web:
    def __init__(self):
        self.dom = None;
        headers ={'user-agent': 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.28 Safari/537.36'}
        self.session = requests.session()
        self.session.headers = headers       # <-- set default headers here
        pass;
    
    def navegate(self, url):
        soup = BeautifulSoup(self.download(url, backup=False), "html.parser")
        self.dom = etree.HTML(str(soup))
    
    def elements(self, xpath, by=None):
        if by != None:
            return by.xpath(xpath);
        return self.dom.xpath(xpath);

    def element(self, xpath, by=None):
        if by != None:
            return by.xpath(xpath)[0];
        buffer = self.elements(xpath);
        if len(buffer) > 0:
            return buffer[0];
        return None;

    def download(self, url, backup=True):
        page = None;
        headers={'User-Agent': 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0'}
        try:
            r = self.session.get(url);
            print(r.status_code);
            return r.text
        except:
            print("Status code "+ str(page.status_code) +" " + url);
            traceback.print_exc();
        return  None;

w = Web();
print(w.download(url));
#w.navegate(url);
#elemento = w.element('//h1');
#print(elemento);
#if elemento  != None:
#    print( elemento.itertext() );
#    print( elemento.text );
#innerhtml lxml.etree._Element


