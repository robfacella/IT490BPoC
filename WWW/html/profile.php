<?php
//pulls the profile name from the url
$user = $_GET["user"];
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
$s = "select * from users where username = '$user' " ;
($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$movies = $r[ "favmovies" ];
	$friends = $r[ "friendslist" ];
}
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
	$movies = $movies . ", " . $newMovie;
	$s = "update users set favmovies = '$movies' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
if(isset($_REQUEST['fsubmit_btn']))
{
	$newFriend =  $_POST["newFriend"];
	$friends = $friends . ", " . $newFriend;
	$s = "update users set friendslist = '$friends' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
?>
