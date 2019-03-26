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
	//not in movies db
	//api pull
	//NOTE!!! change the newMovie to a new variable that replaces spaces with underscores
	$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $newMovie . "&apikey=f0530b1d"), true);

	//Outputs info on movie into console
	print_r($movieInfo);

	//Checks movie info to be sure this is indeed a movie and not a TV show
	if($movieInfo["Response"] == "True"){
		if ($movieInfo["Type"] == "movie") {
			print("This is a movie and we can proceed".PHP_EOL);
			//adds movie to db
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
	$s = "update accounts set movies = '$movies' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
if(isset($_REQUEST['fsubmit_btn']))
{
	$newFriend =  $_POST["newFriend"];
	$friends = $friends . ", " . $newFriend;
	$s = "update accounts set friends = '$friends' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
?>
