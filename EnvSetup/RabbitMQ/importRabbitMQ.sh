#!/bin/bash

echo "Going to need sudo for this script. To reset the service 'rabbitmq-server'." #or will we...
echo "Clearing local /usr/lib/rabbitmq"
rm -r /usr/lib/rabbitmq*

echo "Copying files from this repository's RabbitMQ/librabbitmq directory to /usr/lib/rabbitmq"
cp -r librabbitmq/. /usr/lib/rabbitmq
echo "Copied..."

echo "Restarting rabbitmq server..."
service rabbitmq-server restart
echo "DONE."
