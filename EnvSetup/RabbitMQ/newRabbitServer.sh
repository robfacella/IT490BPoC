
#!/bin/bash

#Get RabbitMQ Server started for testing.
sudo apt install rabbitmq-server -y
sudo ./$HOME/IT490BPoC/EnvSetup/RabbitMQ/importRabbitMQ.sh

sudo apt-get install php -y
sudo apt-get install php-amqp -y
sudo apt-get install php-amqplib -y
#sudo cd /etc/php/7.0/cli/conf.d/
#sudo ln -s /etc/php/mods-available/amqp.ini
sudo cp amqp.ini /etc/php/7.0/cli/conf.d/amqp.ini
#sudo apt install curl -y

sudo rabbitmq-plugins enable rabbitmq_management
sudo ./$HOME/IT490BPoC/EnvSetup/RabbitMQ/cURLRabbitMQSetup.sh
sudo ./$HOME/IT490BPoC/EnvSetup/RabbitMQ/rabbitTestInit.sh
echo "Now connect to the web interface for the RabbitMQ server"
echo "Create the following: "
echo "TESTHOST"
echo "TESTEXCHANGE"
echo "^ {TYPE: topic, DURABLE: true}"
echo "TESTQUEUE"
echo "^ {DURABLE: true}"
echo "^^ Binding{FROM: TESTEXCHANGE; Routing Key: *; Args:{} <none>}"
