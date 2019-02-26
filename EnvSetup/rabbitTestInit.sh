#!/bin/bash

#use rabbitctl to initilize RabbitMQ with info require for example to work.


rabbitmqctl add_user test test
rabbitmqctl set_user_tags test administrator

rabbitmqctl add_vhost TESTHOST
rabbitmqctl set_permissions -p TESTHOST test ".*" ".*" ".*"

#ToDO
#add exchange: "TESTEXCHANGE" {Topic Durable No No}
#add queue: "TESTQUEUE" {Durable No} {Bindings: [FROM: TESTEXCHANGE, RKey: *]}
