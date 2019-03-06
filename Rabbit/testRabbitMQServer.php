#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // lookup username in database //But it JUST returns true currently...
    // check password
    return true;
    //return false if not valid
}
function doRegister($username,$password,$email)
{
    //Placeholder
    //Mover php for registration here?
}
    
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "test":
          echo "Reached 'test' case.".PHP_EOL;
          echo ("Was sent user:".$request['username'].PHP_EOL);
          return "This might be what the client sees when a msg is processed."; //It IS!!!
          
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']); //doValidate method seems to be undefined.
    case "register":
          return doRegister($request['username'],$request['password'],$request['email']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

