<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

$client = new rabbitMQClient("dbRabbitMQLAN.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "logout.php testing";
}
session_start();

$request = array();
$request['type'] = "logout";
if(isset($_SESSION['uname']))
{
  $request['username'] = $_SESSION['uname'];
}
else{
  $request['username'] = "No Session User";
}
if(isset($_SESSION['pwo']))
{
  $request['password'] = $_SESSION['pwo'];
}
else{
  $request['password'] = "No Session Password";
}
$request['message'] = $msg;
echo "Sending Msg...";
$response = $client->send_request($request); //Need a running rabbitMQServer.php

echo $response['msg']; 

if(isset($_SESSION['uname'])||isset($_SESSION['pwo']))
{
  //Destroy Session & Redirect to Login
  session_destroy();    
  echo "<script>location.href='login.php'</script>";
}
//else{
//Redirect to login page anyway?
echo "<script>location.href='login.php'</script>";
//}

?>
