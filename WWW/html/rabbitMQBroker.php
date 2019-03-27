#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("dbAccount.php");
//RabbitMQ Broker (and will be central logger)
$db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
//Need to add AMQP extension to /etc/php/7.0/apache2/php.ini
//also possibly /etc/php/7.0/cli/php.ini
//extension=amqp.so
function logger($msg){
  $logfile = fopen("centralLog.txt", "a") or die("Unable to open Log!!");
  if (!isset ($msg)){
	$msg = "Public Service Announcement: This is only a test.\n";
  }
  #logMsg would be a timestamp + the message which the server is logging... should server or log itself generate the time stamp? may be a moot point.
  echo "$msg".PHP_EOL;
  $logMsg = 'Date['. date('Y-m-d') .'] Time['. date('H:i:s') .']: '."$msg"."\n";
  fwrite($logfile, $logMsg);
  fclose($logfile);
}

function logCase($msg)
{
   #Literally JUST take the $request['message'] from a client & log it.
   logger($msg);
   return true;
}

function getUserProfile($user){
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "getUserProfile";
    $request['username'] = $user;
    $request['message'] = "Fetching User Page for < $user > from the remote database...";
    $msg = $request['message']." - Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['message']);
    
    return $response;
}
function addFriend($user, $friends, $newFriend){
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "addFriend";
    $request['username'] = $user;
    $request['friends'] = $friends;
    $request['newFriend'] = $newFriend;
    $request['message'] = "Attempting to add friend '" . $newFriend . "' to " . $user . "'s Friend list...";
    $msg = $request['message']." - Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['message']);
    
    return $response;	
}
function addMovieToUser($user, $movies, $newMovie){
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "addMovieToUser";
    $request['username'] = $user;
    $request['movies'] = $movies;
    $request['newMovie'] = $newMovie;
    $request['message'] = "Attempting to add movie '" . $newMovie . "' to " . $user . "'s Movie list...";
    $msg = $request['message']." - Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['message']);
    
    return $response;	
}
function moviePage($movieID)
{
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "moviePage";
    $request['movieID'] = $movieID;
    $request['message'] = "Fetching Movie's Page for < $movieID > from the remote database...";
    $msg = $request['message']." - Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['message']);
    
    return $response;
}

function doLogout($username, $pwo)
{
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "logout";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = "Checking validation of user: $username at the remote database...";
    $msg = $request['message']." Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['message']);
    
    return $response;
}
//Auth Function from Pabianm's login.php
function auth($user, $pass){
    global $db;
    $s = "select * from users where username = '$user' and password = '$pass'"; //change to use the database name
    //echo "$s <br>".PHP_EOL;
    ($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
    $num =mysqli_num_rows($t);
    if ($num==0){ return false;}
		return true;
}
//Sanitize data to prevent SQLInjection from Pabianm's login.php
function sanitize($var){
    global $db;
    $temp = trim ( $var ) ;
    $temp = mysqli_real_escape_string($db, $temp);
    return $temp; 
}
function doValidate($username,$password){
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "validate_session";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = "Checking validation of user: $username at the remote database...";
    $msg = $request['message']." Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['msg']);
    return $response;
}
function doLogin($username,$password)
{
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "login";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = "Sending request to login user: $user to the remote database...";
    $msg = $request['message']." Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    logger($response['msg']);
    
    return $response;
}


function doRegister($user,$pass,$email)
{
    $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
    $request = array();
    $request['type'] = "register";
    $request['username'] = $user;
    $request['password'] = $pass;
    $request['email'] = $email;
    $request['message'] = "Sending request to register user: $user to the remote database...";
    $msg = "Sending Message to DB...";
    logger($msg);
    $response = $client->send_request($request);
    $msg = "Sent Message to DB...";
    logger($msg);
    if($response['attempt']){
	$msg = $response['msg'];
	logger($msg);
        return $response;
    }else{
	$msg = "ERROR Running query, try again later...";
	logger($msg);
        return $response;
        //If username did already exist in users table OR other error with DB..
      }
}
    
function requestProcessor($request)
{
  #echo "received request".PHP_EOL;
  logger("received request");
  var_dump($request);
  if(!isset($request['type']))
  {
    $msg = "ERROR: unsupported message type";
    logger($msg);
    #echo $msg.PHP_EOL;
    return $msg;
  }
  switch ($request['type']) //Log as it's own case or logging within each case? Or both?
  {
    case "test":
          echo "Reached 'test' case.".PHP_EOL;
          echo ("Was sent user:".$request['username'].PHP_EOL);
          return "This might be what the client sees when a msg is processed."; //It IS!!!
          
    case "login":
      return doLogin($request['username'],$request['password']);
    case "moviePage":
        //Fetch Data from OUR movie database..
        return moviePage($request['movieID']);
    case "getUserProfile":
        //Fetch User's Profile Page.
        return getUserProfile($request['username']);
    case "addMovieToUser":
	return addMovieToUser($request['username'], $request['movies'], $request['newMovie']);
    case "addFriend":
        return addFriend($request['username'], $request['friends'], $request['newFriend']);
		  
    case "validate_session":
      //return doValidate($request['sessionId']); //doValidate method seems to be undefined.
          return doValidate($request['username'],$request['password']);
    case "register":
          return doRegister($request['username'],$request['password'],$request['email']);
    case "logout":
	  return doLogout($request['username'],$request['password']);
    case "logCase":
		  return logCase($request['message']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("brokerRabbitMQ.ini","testServer");

#echo "brokerRabbitMQServer BEGIN".PHP_EOL;
logger("brokerRabbitMQServer BEGIN");
$server->process_requests('requestProcessor');
#echo "brokerRabbitMQServer END".PHP_EOL;
logger("brokerRabbitMQServer END");
exit();
?>

