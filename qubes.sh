#!/bin/bash

rm -r /var/www/html
ln -s /home/user/desenv/hacker/site /var/www/html
chown -R user:root /var/www/html

echo 'User user' >> /etc/apache2/apache2.conf
echo 'Group user' >> /etc/apache2/apache2.conf

systemctl stop apache2.service
systemctl start apache2.service
systemctl status apache2.service