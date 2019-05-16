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
//echo "Session still valid at least...";
$request['type'] = "getMovie";
$request['username'] = $user;
$request['message'] = "Fetching movie 1 for ". $user . "'s Party.";
$response = rabbits($request);
$RecoTitle = $response['RecoTitle'];
$posterURL = $response['url'];
//////////////////////////////////
$request['message'] = "Fetching movie 2 for ". $user . "'s Party.";
$response = rabbits($request);
$RecoTitle2 = $response['RecoTitle'];
$posterURL2 = $response['url'];
///////////////////////////////////
$request['message'] = "Fetching movie 3 for ". $user . "'s Party.";
$response = rabbits($request);
$RecoTitle3 = $response['RecoTitle'];
$posterURL3 = $response['url'];
////////////////////////////////////
$request['message'] = "Fetching movie 4 for ". $user . "'s Party.";
$response = rabbits($request);
$RecoTitle4 = $response['RecoTitle'];
$posterURL4 = $response['url'];
////////////////////////////////////
$request['message'] = "Fetching movie 5 for ". $user . "'s Party.";
$response = rabbits($request);
$RecoTitle5 = $response['RecoTitle'];
$posterURL5 = $response['url'];

?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
	<style type="text/css">
h1{
    font-family: 'Roboto Slab', serif;
}
body {
    font-family: 'Roboto', sans-serif;
	background-color: #CCC;
}
</style>
	<title>Profile</title>
</head>

<body>
	<div class="container">
	<p><img src="BPoC logo.png" width="227" height="135"></p>
    <h1><?php echo $user; ?>'s Profile</h1><br>
	<br><a href='loggedIn.php'><input type=button value=Home name=Home></a>
	<form method="post" action="">
		Discover more Brilliant Picks<br>
		<h2>You should check this movie out: <?php echo $RecoTitle; ?></h2><br><br>
		
		<form method="post" action"">
		Movie List: <?php echo $movies; ?> <br>
		Add Watched Movies: <input type="text" name="newMovie"> <br>
		<input type="submit" value="submit" name="msubmit_btn"> <br> <br>
		</form>
		
		<form method="post" action"">
		Friends List: <?php echo $friends; ?> <br>
		Add friends: <input type="text" name="newFriend"> <br>
		<input type="submit" value="submit" name="fsubmit_btn"> <br> <br>
		</form>
		
	</form>
		<br><a href='logout.php'><input type=button value=logout name=logout></a>
		<img src="<?php echo $posterURL; ?>" alt="Recommended Movie">
	</div>
</body>

</html>

<?php 
if(isset($_REQUEST['msubmit_btn']))
{
	$newMovie =  $_POST["newMovie"];
	$request = array();
        $request['type'] = "addMovieToUser";
        $request['username'] = $user;
        $request['movies'] = $movies;
        $request['newMovie'] = $newMovie;
	$request['message'] = "Attempting to add movie '" . $newMovie . "' to " . $user . "'s Movie list...";
	$response = rabbits($request);
	//Refresh Page
}
if(isset($_REQUEST['fsubmit_btn']))
{
	$newFriend =  $_POST["newFriend"];
        $request = array();
        $request['type'] = "addFriend";
        $request['username'] = $user;
        $request['friends'] = $friends;
        $request['newFriend'] = $newFriend;
	$request['message'] = "Attempting to add friend '" . $newFriend . "' to " . $user . "'s Friend list...";
	$response = rabbits($request);
	//Refresh Page
}
?>
