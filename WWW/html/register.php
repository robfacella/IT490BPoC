<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
	<meta charset="utf-8">
	<title>Registration</title>
<style type="text/css">
h1{
    font-family: 'Roboto Slab', serif;
}
body {
    font-family: 'Roboto', sans-serif;
	background-color: #CCC;
}
</style>
</head>

	
<body>
	<div class="container">
	<h1><img src="BPoC logo.png" width="227" height="135"></h1>
	<h1>BPoC Registration</h1>
	<form action="" method="POST">
	  <p>Choose your Username: </p> <input type="text" name="user" id="user" required="required" placeholder="enter username">

		<p>Enter a Password: </p> <input type="password" name="passwd" id="passwd" required="required" placeholder="Passwd">
		<p>Conf Passwd: </p> <input type="password" name="confPass" id="confPass" required="required" placeholder="Confirm Pass">
		<span style="display:none;font-family:'Times New Roman', Georgia, Serif;" id="nonConf">Passwords do not match </span>

		<p>eMail: </p> <input type="text" name="email" id="email" required="required" placeholder="enter email">
		<input type="submit" name="submit" value="Regi">
		
		<br><br><br><p><a href="login.php">Existing user login...</a></p>

	</form>
	</div>
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );


	if(isset($_POST["submit"])){
		if($_POST["passwd"] == $_POST["confPass"];)
		{
			//Rabbit of Caerbannog
			$client = new rabbitMQClient("brokerRabbitMQ.ini","testServer");
			if (isset($argv[1]))
			{
			  $msg = $argv[1];
			}
			else
			{
			  $msg = "register.php testing";
			}


			$request = array();
			$request['type'] = "register";
			$request['username'] = $_POST["user"];
			$request['password'] = $_POST["passwd"];
			$request['email'] = $_POST["email"];
			$request['message'] = $msg;
			$response = $client->send_request($request); //Need a running rabbitMQServer.php
			//$response = $client->publish($request);
			echo $response['msg'];

			if ($response['attempt'] == false){
			//Registration Failed
			  exit();
			}
			else{
				echo "<script>location.href='login.php'</script>";
				//Take em to the login.
			}
		}
		else{
			//Registration Password does not match Confirmation Password
			exit();
		}
	}


?>
</body>
</html>
