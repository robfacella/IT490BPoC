#!/bin/bash

curl -i -u guest:guest -H "content-type:application/json" -XPUT http://localhost:15672/api/vhosts/TESTHOST

curl -i -u guest:guest -H "content-type:application/json" -XPUT -d'{"type":"topic","durable":true}' http://localhost:15672/api/exchanges/TESTHOST/TESTEXCHANGE
