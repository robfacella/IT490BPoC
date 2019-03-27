<?php
//pulls the profile name from the url
$user = $_GET["user"];
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function rabbits($request){
	$client = new rabbitMQClient("brokerRabbitMQ.ini","testServer");
        $response = $client->send_request($request); //Need a running rabbitMQBroker.php & DB
	return $response;	
}

session_start();
//if any of these Session vars are unset then we don't even need to ccheck validation because it cannot be a valid session.
if((!isset($_SESSION['uname']))  || (!isset($_SESSION['pwo'])) || (!isset($_SESSION['uid'])))
{   //Redirect to login page
    session_destroy(); //Will remove other session information if it was set somehow.
    echo "<script>location.href='login.php'</script>";
}
if (isset($argv[1]))
{
   $msg = $argv[1];
}
else
{
   $msg = "session validation check";	
}    
$request = array();
$request['type'] = "validate_session";
$request['username'] = $_SESSION['uname'];
$request['password'] = $_SESSION['pwo'];
$request['message'] = $msg;
$response = rabbits($request); //Need a running rabbitMQBroker.php & DB
if ($response['isValid'] == false){
   //Validation Failed
   session_destroy(); //Remove Session Data from Session discovered to be invalid.
   echo "<script>location.href='login.php'</script>";
   exit();
}
echo "Session still valid at least...";
$request['type'] = "getUserProfile";
$request['username'] = $user;
$request['message'] = "Fetching ". $user . "'s Profile Page.";
$response = rabbits($request);

$movies = $response['movies'];
$friends = $response['friends'];
	
	
?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<div class="container">
	<h1><?php echo $user; ?>'s Profile<h1><br>
	<form method="post" action="">
		Insert Profile jargon here <br>
		
		<form method="post" action"">
		Movie list: <?php echo $movies; ?> <br>
		Add watched movies <input type="text" name="newMovie"> <br>
		<input type="submit" value="submit" name="msubmit_btn"> <br> <br>
		</form>
		
		<form method="post" action"">
		Friends list: <?php echo $friends; ?> <br>
		Add friends <input type="text" name="newFriend"> <br>
		<input type="submit" value="submit" name="fsubmit_btn"> <br> <br>
		</form>
		
	</form>
	</div>
</body>

</html>

<?php 
if(isset($_REQUEST['msubmit_btn']))
{
	$newMovie =  $_POST["newMovie"];
	$s = "select * from movies where title = '$newMovie' " ;
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
	$num =mysqli_num_rows($t);
    if ($num==0){ 
	//Not in our "movies" table
	//API pull
	//changes the newMovie to a new variable that replaces spaces with underscores
	$apimovie = str_replace(' ', '_', $newMovie);
	$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $apimovie . "&apikey=f0530b1d"), true);
	//Outputs info on movie into console
	print_r($movieInfo);
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
		 	$s = "INSERT INTO movies (title, year, rated, released, genre, actors, poster) 
			VALUES('$mt','$my','$mra','$mre','$mg','$ma','$mp')";
			($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
		}
	else{
		print("API did not return a movie. returned a type of: ".PHP_EOL);
		print($movieInfo["Type"]);
	}
	}else{
		print("API did not respond, try again later. ".PHP_EOL);
	}	
		echo "false";
	}
	$movies = $movies . ", " . $newMovie;
	$s = "update users set movies = '$movies' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
if(isset($_REQUEST['fsubmit_btn']))
{
	$newFriend =  $_POST["newFriend"];
	$friends = $friends . ", " . $newFriend;
	$s = "update users set friends = '$friends' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
?>
