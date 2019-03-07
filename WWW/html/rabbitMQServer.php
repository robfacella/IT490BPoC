#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("dbAccount.php");
//$db = mysqli_connect($dbhostname, $dbuser,$dbpass, $dbdatabase); //Doesn't like this either..
$db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
//Need to add AMQP extension to /etc/php/7.0/apache2/php.ini
//also possibly /etc/php/7.0/cli/php.ini
//extension=amqp.so
function doValidate(){
   //I think this is like McHugh's "gatekeeper" 
   return true;
}
function doLogout($username, $pwo)
{
    session_start();
    session_destroy();
    $lout = array();
    $lout['msg']="Logged out '$username'.";
    return $lout;
    //return false if not valid
}
//Auth Function from Pabianm's login.php
function auth($user, $pass){
    global $db;
    $s = "select * from users where username = '$user' and password = '$pass'"; //change to use the database name
    echo "$s <br> <br>";
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
function doLogin($username,$password)
{
  // lookup username in database
  $db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
  // check password
  $authe = array();
  $authe['allow'] = false;
  if (mysqli_connect_errno())
  {
     $authe['msg'] = "Failed to connect to MySQL: " . mysqli_connect_error();
     return $authe;
  }
  //print "Successfully connected to MySQL.<br><br>";
  mysqli_select_db($db, "testdb"); 

  //error reporting
  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  ini_set( 'display_errors' , 1 );

  //login with provide credentials if in the db
  $uname = sanitize($username);
  $pword = sanitize($password); 
  if (!auth ($uname,$pword)){
     $authe['msg'] = "Wrong login credentials, please try again.";
     return $authe; 
  } 
  //return false by default if not valid  
  $authe['allow'] = true;
  $authe['msg'] = "Logging In.";  
  $authe['uname'] = $uname;
  $authe['pwo'] = $pword;
  return $authe;
    
}


function doRegister($user,$pass,$email)
{
    
    $conSQL = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
    $user=mysqli_real_escape_string($conSQL, $user);     
    $email=mysqli_real_escape_string($conSQL, $email);
    $pass=mysqli_real_escape_string($conSQL, $pass);

    // lookup username in database
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
    case "logout":
	  return doLogout($request['username'],$request['password']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

