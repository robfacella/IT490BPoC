#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("dbAccount.php");
//Need to add AMQP extension to /etc/php/7.0/apache2/php.ini
//also possibly /etc/php/7.0/cli/php.ini
//extension=amqp.so
function doLogin($username,$password)
{
    return true;
    //return false if not valid
}
function doRegister($user,$pass,$email)
{
    $conSQL = mysqli_connect($hostname, $dbuser, $dbpass, $database) or die (mysqli_error());
    $user=mysqli_real_escape_string($conSQL, $user);     
    $email=mysqli_real_escape_string($conSQL, $email);
    $pass=mysqli_real_escape_string($conSQL, $pass);

    // lookup username in database //But it JUST returns true currently...
    // check password
    //If username does NOT exist in users table:
    $squee = "select * from users where username = '$user'";
    echo $squee;
    ($query = mysqli_query($conSQL,$squee))  or die (mysqli_error( $conSQL));
    $nRows=mysqli_num_rows($query);
    if($nRows==0){
    //try to add to table
    //Should hash password before storing
    $query2="INSERT INTO users(username, email, password) VALUES('$user','$email', '$pass')";
    echo $query2;
    $attempt=mysqli_query($conSQL, $query2);
    if($attempt){
        return "Registered user: $user ...";
    }else{
        return "How you even get here?!";}
    //If username DOES already exist in users table:
    }else {   
  	return "Sorry, that username is already registered.";
    }
    return false;
}
    
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type']) //Log as it's own case or logging within each case? Or both?
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

