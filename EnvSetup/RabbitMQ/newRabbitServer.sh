
#!/bin/bash

#Get RabbitMQ Server started for testing.
sudo apt install rabbitmq-server -y
sudo ./importRabbitMQ.sh

sudo apt-get install php -y
sudo apt-get install php-amqp -y
sudo apt-get install php-amqplib -y
#sudo cd /etc/php/7.0/cli/conf.d/
#sudo ln -s /etc/php/mods-available/amqp.ini
sudo cp amqp.ini /etc/php/7.0/cli/conf.d/amqp.ini
sudo apt install curl -y


sudo rabbitmq-plugins enable rabbitmq_management
