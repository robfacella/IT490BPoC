#!/bin/bash

apt-get install apache2 -y
apt-get install libapache2-mod-php7.0 -y
#php7.0-curl && ...-json   ??Maybe??

wordir=$(pwd) 
##echo "use: nano /etc/apache2/sites-available/000-default.conf"

echo "Copying files fromthis repository's WWW/html directory to /var/www/html"
cp -r WWW/html/. /var/www/html
echo "Copied..."

echo "Restarting apache2 server..."
service apache2 restart
echo "DONE."
