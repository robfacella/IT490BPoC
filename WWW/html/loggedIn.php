<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
  session_start();
  //Need to work on Validation through rabbitMQ
  //if either Session 'uname' or 'pwo' are unset then we don't even need to ccheck validation because it cannot be a valid session.
  if((!isset($_SESSION['uname']))  || (!isset($_SESSION['pwo'])))
  {   //Redirect to login page
      session_destroy(); //Will remove other session information if it was set somehow.
      echo "<script>location.href='login.php'</script>";
  }
  ///////
  //Check Session Validity
  $client = new rabbitMQClient("dbRabbitMQ.ini","testServer");
  if (isset($argv[1]))
  {
     $msg = $argv[1];
  }
  else
  {
     $msg = "logout.php testing";	
  }    
  $request = array();
  $request['type'] = "validate_session";
  $request['username'] = $_SESSION['uname'];
  $request['password'] = $_SESSION['pwo'];
  $request['message'] = $msg;
  $response = $client->send_request($request); //Need a running rabbitMQServer.php
  echo $response['msg'];
  if ($response['isValid'] == false){
     //Validation Failed
     session_destroy(); //Remove Session Data from Session discovered to be invalid.
     echo "<script>location.href='login.php'</script>";
     exit();
  }
  ///////    
  if(isset($_SESSION['uname']))
  {
  //Welcome the User
    echo "<h1>Welcome ".$_SESSION['uname']." to BPoC</h1>";
    
    echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";
  }
?>
