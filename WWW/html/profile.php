<?php
//pulls the profile name from the url
$user = $_GET["user"];
//this is set up to get data from a local database, needs to be changed to work with rabbit
$db = mysqli_connect("localhost", "root","", "testdb"); 
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
$s = "select * from accounts where username = '$user' " ;
($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$movies = $r[ "movies" ];
	$friends = $r[ "friends" ];
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
		<?php echo $user; ?>'s favorite movies are : <?php echo $movies; ?>		<br>
		Friends list: <?php echo $friends; ?>
	</form>
	</div>
</body>

</html>
