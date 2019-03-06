<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Login</title>
</head>

<body>
	<div class="container">
	<h1>BPoC Sign-In<h1><br>
	<form method="post" action="login.php">
		<p>Username</p>
		<input type ="text" name="user" id="user" placeholder="Username...">

		<p>Pass</p>
		<input type = "password" name="password" id="password" placeholder="Enter Pass...">
		<br><button type="button">Login</button>

		<br><br><p>Register</p>
		
	</form>
	</div>

<?php
include("dbAccount.php");
//$conSQL = mysqli_connect($hostname, $username, $password, $database) or die (mysqli_error());

//boiler plate text for connecting to mysqli
$db = mysqli_connect($hostname, 'root','', $database); //needs to be variables that reference the dbaccount file
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
print "Successfully connected to MySQL.<br><br>";
mysqli_select_db($db, $database ); 

//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

//login with provide credentials if in the db

//$username = $_POST['user'];
//$password = $_POST['pass'];

//Sanitize data to prevent SQLInjection
function sanitize($var){
    global $db;
    $temp = $_GET [ $var ] ;
    $temp = trim ( $temp ) ;
    $temp = mysqli_real_escape_string($db, $temp);
    return $temp; 
}

$username = sanitize('user');
$password = sanitize('pass');

function auth($username, $password){
    global $db;
    $s = "select * from accounts where username = '$username' and password = '$password'"; //change to use the database name
    echo "$s <br> <br>";
    ($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
    $num =mysqli_num_rows($t);
    if ($num==0){ return false;}
		return true;
}




if (!auth ($username,$password)){
	$message = "Wrong login credentials, please try again.";
	exit();
}



//connect to database server and select Accounts table

//Query DB for user and log them in if credentials are correct
//if
//
//else{
//	echo "Login ERROR: Invalid Credentials."
//}

?>
</body>

</html>
