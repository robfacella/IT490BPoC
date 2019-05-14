#!/bin/bash
#Backup RabbitMQ Configuration from the Dev Server to the Git Repo
cp * from /usr/lib/rabbitmq to /EnvSetup/RabbitMQ/librabbitmq
echo "Copying files from /usr/lib/rabbitmq to this repository's EnvSetup/RabbitMQ/librabbitmq directory"
cp -r /usr/lib/rabbitmq/. librabbitmq
echo "Copied..."

echo "DONE."
