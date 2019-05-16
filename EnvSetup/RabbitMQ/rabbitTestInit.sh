#!/bin/bash

#use rabbitctl to initilize RabbitMQ with info require for example to work.


rabbitmqctl add_user test test
rabbitmqctl set_user_tags test administrator

rabbitmqctl add_vhost TESTHOST
rabbitmqctl set_permissions -p TESTHOST test ".*" ".*" ".*"

#ToDO
#install rabbitmqadmin
###add exchange: "TESTEXCHANGE" {Topic Durable No No}
./rabbitmqadmin declare exchange name=TESTEXCHANGE type=topic [durable=false]
###add queue: "TESTQUEUE" {Durable No} {Bindings: [FROM: TESTEXCHANGE, RKey: *]}
./rabbitmqadmin declare queue name=TESTQUEUE [durable=false]

sudo apt-get install libapache2-mod-php7.0 php7.0-mysql php7.0-curl php7.0-json
