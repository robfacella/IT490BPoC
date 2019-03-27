#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include("dbAccount.php");
//RabbitMQ Server Run by the Database Server which will take in requests from the Broker.
 $db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
//Need to add AMQP extension to /etc/php/7.0/apache2/php.ini
//also possibly /etc/php/7.0/cli/php.ini
//extension=amqp.so
function getUserProfile($user){
   $db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
   if (mysqli_connect_errno())
   {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
   }
   mysqli_select_db($db, "testdb" ); 
   //error reporting
   error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   ini_set( 'display_errors' , 1 );
   //pull user data
   $s = "select * from users where username = '$user' " ;
   ($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
   $num =mysqli_num_rows($t);
   $response = array();
   if ($num==0){ #If the User does not exist 
	$response['movies'] = " ";
	$response['friends'] = " ";
	   
        $response['message'] = "Looked up a user not in our table.";
   }	   
   while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$response['movies'] = $r[ "favmovies" ];
	$response['friends'] = $r[ "friendslist" ];
	   
        $response['message'] = "Fetched Profile.";
   }
   return $response;
}
function addMovieToUser($user, $movies, $newMovie){
	$db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
        $s = "select * from movies where title = '$newMovie' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
	$num =mysqli_num_rows($t);
        
	if ($num==0){ //not in local movies table 
	 //api pull	
	 $apimovie = str_replace(' ', '_', $newMovie); //changes the newMovie to a new variable that replaces spaces with underscores
	 $movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $apimovie . "&apikey=f0530b1d"), true);
	 print_r($movieInfo);//Outputs info on movie into console
	
	 //Checks movie info to be sure this is indeed a movie and not a TV show
	 if($movieInfo["Response"] == "True"){
		if ($movieInfo["Type"] == "movie") {
			print("This is a movie and we can proceed".PHP_EOL);
			//adds movie to db
			$newMovie= $movieInfo["Title"];
			$mt = $movieInfo["Title"];
			$my = $movieInfo["Year"];
			$mra = $movieInfo["Rated"];
			$mre = $movieInfo["Released"];
			$mg = $movieInfo["Genre"];
			$ma = $movieInfo["Actors"];
			$mp = $movieInfo["Poster"];
			$s = "select * from movies where title = '$mt' ";
	                ($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
	                $num =mysqli_num_rows($t);
        
	                if ($num==0){ //REALLY not in local movies table 
		 	$s = "INSERT INTO movies (title, year, rated, released, genre, actors, poster) 
			VALUES('$mt','$my','$mra','$mre','$mg','$ma','$mp')";
			($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );}
	        }else{
		        print("API did not return a movie. returned a type of: ".PHP_EOL);
		        print($movieInfo["Type"]);
	 }}else{
		print("API did not respond, try again later. ".PHP_EOL);
	 }	
	 //echo "false";
	}
	
	$movies = $movies . ", " . $newMovie;
	$s = "update users set favmovies = '$movies' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
   $response = array();	
   $response['message'] = "Fetched Profile.";
   
   return $response;
}
function addFriend($user, $friends, $newFriend){
	$db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
	$friends = $friends . ", " . $newFriend;
	$s = "update users set friendslist = '$friends' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
	
	$response = array();
	$response['message'] = "FRIENDS";
	return $response;
}
//////////////////////////////////////////////////////////////////////////////
function moviePage($movieID){
   //this is set up to get data from a local database, needs to be changed to work with rabbit
   $db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error()); 
   if (mysqli_connect_errno())
   {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
   }
   mysqli_select_db($db, "testdb" ); 
   //error reporting
   error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
   ini_set( 'display_errors' , 1 );

   //pull user data
   $s = "select * from movies where movieid = '$movieID' " ;
   ($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );

   $mPage = array(); 
	
   while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$mPage['title'] = $r[ "title" ];
	$mPage['year'] = $r[ "year" ];
	$mPage['rating'] = $r[ "rated" ];
	$mPage['genre'] = $r[ "genre" ];
	$mPage['actors'] = $r[ "actors" ];
   }
   if (isset ($mPage['title'])){	
      $mPage['message'] = "Fetched data on " . $mPage['title'] . " from the Database.";
   }else{$mPage['message'] = "Title not found for that Movie ID.";}
   return $mPage;
}
function doLogout($username, $pwo)
{
    $lout = array();
    $lout['message']="Logged out '$username'.";
    echo $lout['message'].PHP_EOL;
    return $lout;
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
  //I think this is like McHugh's "gatekeeper" 
  // lookup 'Logged-In' Account in database
  $db = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
  // check password
  $authe = array();
  $authe['isValid'] = false;
  if (mysqli_connect_errno())
  {
     $authe['msg'] = "Failed to connect to MySQL: " . mysqli_connect_error();
     echo $authe['msg'].PHP_EOL;
     return $authe;
  }
  mysqli_select_db($db, "testdb"); 
  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  ini_set( 'display_errors' , 1 );
  //Validate Login from session provided credentials if they are in the db
  $uname = sanitize($username);
  $pword = sanitize($password); 
  if (!auth ($uname,$pword)){
     $authe['msg'] = "Invalid session credentials, please Login again.";
     echo $authe['msg'].PHP_EOL;
     return $authe; 
  } 
  //Return false by default if not valid.  (Declared earlier in function.)
  $authe['isValid'] = true;
  $authe['msg'] = "Session Validated.";  
  $authe['uname'] = $uname;
  $authe['pwo'] = $pword;
  //$authe['sessionId'] =;//From OG doValidate case, track valid session with this instead of user&pass combo???
  echo $authe['msg'].PHP_EOL;
  return $authe;
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
     echo $authe['msg'].PHP_EOL;
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
     echo $authe['msg'].PHP_EOL;//Change to tried to login with
     return $authe; 
  }
  
  //return false by default if not valid  
  $authe['allow'] = true;
  $authe['msg'] = "Logging In: $uname ";  
  $authe['uname'] = $uname;
  $authe['pwo'] = $pword;
  echo $authe['msg'].PHP_EOL;
  //pull user data (ID)
  $s = "select * from users where username = '$uname' " ;
  ($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
  while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$authe['uid'] = $r[ "userid" ];
  }
  return $authe;
    
}


function doRegister($user,$pass,$email)
{
    
    $conSQL = mysqli_connect("localhost", "testuser", "password", "testdb") or die (mysqli_error());
    $user=mysqli_real_escape_string($conSQL, $user);     
    $email=mysqli_real_escape_string($conSQL, $email);
    $pass=mysqli_real_escape_string($conSQL, $pass);
    $response = array();
    $response['attempt']=false;
    //If username does NOT exist in users table:
    $squee = "select * from users where username = '$user'";
    ($query = mysqli_query($conSQL,$squee))  or die (mysqli_error( $conSQL));
    $nRows=mysqli_num_rows($query);
    if($nRows==0){
    //Try to add to table
    //Should hash password before storing
    $query2="INSERT INTO users(username, email, password) VALUES('$user','$email', '$pass')";
    echo $query2.PHP_EOL;
    $response['attempt']=mysqli_query($conSQL, $query2);
      if($response['attempt']){
	$msg = "Registered user: $user ...";
        $response['msg']=$msg;
	echo $msg.PHP_EOL;
        return $response;
      }else{
	$msg = "ERROR Running query, try again later...";
        $response['msg']=$msg;
	echo $msg.PHP_EOL;
        return $response;
     //If username DOES already exist in users table:
      }
    }
    else {
	$msg = "Sorry, that $user is already a registered username.";
        $response['msg']=$msg;
	echo $msg.PHP_EOL;
        return $response;
    }
}
    
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    $msg = "ERROR: unsupported message type";
    echo $msg.PHP_EOL;
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
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("dbRabbitMQ.ini","testServer");

echo "dbRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "dbRabbitMQServer END".PHP_EOL;
exit();
?>

