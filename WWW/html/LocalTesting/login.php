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
		<input type = "password" name="passwd" id="passwd" placeholder="Enter Pass...">
		<input type="submit" value="submit" name="submit_btn">

		<br><br><p><a href="register.php">Register</a></p>
		
	</form>
	</div>

<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//boiler plate text for connecting to mysqli
//What if they were already logged in with a valid session?
if(isset($_REQUEST['submit_btn']))
{
		
		//Rabbit of Caerbannog
		$client = new rabbitMQClient("dbRabbitMQLAN.ini","testServer");
		if (isset($argv[1]))
		{
		  $msg = $argv[1];
		}
		else
		{
		  $msg = "login.php testing";
		}

		
		$request = array();
		$request['type'] = "login";
		$request['username'] = $_POST["user"];
		$request['password'] = $_POST["passwd"];
		$request['message'] = $msg;
		$response = $client->send_request($request); //Need a running rabbitMQBroker.php
		echo $response['msg'];
                if ($response['allow'] == false){
		//Login Failed
		  exit();
		}


	//If user is logged-in successfully:
        session_start();
        echo "Tried to start Session..";
	$_SESSION['uname'] = $response['uname'];
        $_SESSION['pwo'] = $response['pwo'];
        $_SESSION['uid'] = $response['uid'];
        //Should session be handled even more by rabbit or is this fine?
	echo "<script>location.href='loggedIn.php'</script>";
}  
?>
</body>

</html>
