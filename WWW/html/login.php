<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Login</title>
</head>

<body>
	<div class="container">
	<h1>BPoC Sign-In<h1><br>
	<form method="post" action="">
		<p>Username</p>
		<input type ="text" name="user" id="user" placeholder="Username...">

		<p>Pass</p>
		<input type = "password" name="password" id="password" placeholder="Enter Pass...">
		<input type="submit" value="submit" name="submit_btn">

		<br><br><p>Register</p>
		
	</form>
	</div>

<?php
include("dbAccount.php");
//boiler plate text for connecting to mysqli
$db = mysqli_connect($dbhostname, $dbuser,$dbpass, $dbdatabase); //needs to be variables that reference the dbaccount file $username replaces "root" and $password replaces " "
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
if(isset($_REQUEST['submit_btn']))
    {
		$uname = sanitize('user');
		$pword = sanitize('password'); 
		if (!auth ($uname,$pword)){
			echo "Wrong login credentials, please try again.";
			exit(); 
		} 
		// add what happens if user is logged in here
		// Session Start Placeholder..
	        session_start();
	        echo "Tried to start Session..";
		$_SESSION['uname'] = $uname;
		echo "<script>location.href='loggedIn.php'</script>";
	}
//Sanitize data to prevent SQLInjection
function sanitize($var){
    global $db;
    $temp = $_POST[$var];
    $temp = trim ( $temp ) ;
    $temp = mysqli_real_escape_string($db, $temp);
    return $temp; 
}

//auth function
function auth($user, $pass){
    global $db;
    $s = "select * from users where username = '$user' and password = '$pass'"; //change to use the database name
    echo "$s <br> <br>";
    ($t = mysqli_query($db,$s)) or die (mysqli_error( $db));
    $num =mysqli_num_rows($t);
    if ($num==0){ return false;}
		return true;
}

?>
</body>

</html>
