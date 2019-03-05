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


//connect to database server and select Accounts table

//Query DB for user and log them in if credentials are correct
if

else{
	echo "Login ERROR: Invalid Credentials."
}

?>
</body>

</html>
