#!/bin/bash

#Uncomment to install apache2 and some dependencies...
#apt-get install apache2 -y
#apt-get install libapache2-mod-php7.0 -y

#php7.0-curl && ...-json   ??Maybe??

##echo "use: nano /etc/apache2/sites-available/000-default.conf"
echo "Going to need sudo for this script." #I could set up conditionals to enforce but the fail to copy should be reminder enough..
echo "Clearing local /var/www/html"
rm -r /var/www/html/*

echo "Copying files from this repository's WWW/html directory to /var/www/html"
cp -r html/. /var/www/html
echo "Copied..."

echo "Restarting apache2 server..."
service apache2 restart
echo "DONE."
