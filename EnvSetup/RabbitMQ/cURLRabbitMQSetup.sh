#!/bin/bash

#cURL didn't work either but RabbitMQ can be manually setup remotely through the web interface.

rabbitmqctl add_user test test
rabbitmqctl set_user_tags test administrator
###########

#curl -i -u guest:guest -H "content-type:application/json" -XPUT http://localhost:15672/api/vhosts/TESTHOST

#curl -i -u guest:guest -H "content-type:application/json" -XPUT -d'{"type":"topic","durable":true}' http://localhost:15672/api/exchanges/TESTHOST/TESTEXCHANGE

#curl -i -u guest:guest -H "content-type:application/json" -XPUT -d'{"auto_delete":false,"durable":true,"arguments":{},"node":"rabbit@rabbit"}'  http://localhost:15672/api/queues/TESTHOST/TESTQUEUE

############
rabbitmqctl set_permissions -p TESTHOST test ".*" ".*" ".*"
############
#curl -i -u guest:guest -H "content-type:application/json" -XPUT -d'{"routing_key":"*", "arguments":{}}' http://localhost:15672/api/bindings/TESTHOST/e/TESTEXCHANGE/q/TESTQUEUE
