#!/bin/bash

apt-get install apache2 -y


wordir=$(pwd) 
echo "use: nano /etc/apache2/sites-available/000-default.conf"
echo "Change: /var/www/html"
echo "To: "
echo "$wordir""/WWW/html"


