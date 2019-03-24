<?php
//pulls the movieid from the url
$mID = $_GET["mID"];
if (is_numeric($mID)==false){
	echo "Error: Movie ID must be an integer";
	exit;
}
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
$s = "select * from movies where movieid = '$mID' " ;
($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$title = $r[ "title" ];
	$year = $r[ "year" ];
	$rating = $r[ "rated" ];
	$genre = $r[ "genre" ];
	$actors = $r[ "actors" ];
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Movie</title>
</head>

<body>
	<div class="container">
	<h1><?php echo $title; ?><h1><br>
	<form method="post" action="">
		Staring: <?php echo $actors; ?> <br>
		Released: <?php echo $year; ?> <br>
		Genre: <?php echo $genre; ?> <br>
		User Rating: <?php echo $rating; ?> <br>
	</form>
	</div>
</body>

</html>
