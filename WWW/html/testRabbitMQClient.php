#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();
$request['type'] = "test"; //Should interact with Server.php's Switch-Statement
$request['username'] = "test";
$request['password'] = "test";
$request['message'] = $msg;
$response = $client->send_request($request); //(Response) //$response comes from RabbitMQServer.php 's Switch-Statement.
//$response = $client->publish($request); //One-Way (NO response).

//What does our Client DO with the $response ?
echo "client received response: ".PHP_EOL;
print_r($response);  
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

