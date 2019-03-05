<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
</head>
<script>
var pword = document.getElementById("passwd");
var cpswd = document.getElementById("confPass");
//Test for matching password fields.//Verify Password == confirmed password
function checkPasses(){

	if(pword.value != cpswd.value){
		document.getElementById("nonConf").style.display="block";
		cpswd.value="";
	}if(pword.value == cpswd.value){
		document.getElementById("nonConf").style.display="none";
	}	
}
pword.onchange = checkPasses;
cpswd.onkeyup = checkPasses;
</script>
<body>
	<div class="container">
	<h1>BPoC Registration</h1>
	<form action="" method="POST">
		<p>Choose your Username: </p> <input type="text" name="user" id="user" required="required" placeholder="enter username">

		<p>Enter a Password: </p> <input type="password" name="passwd" id="passwd" required="required" placeholder="Passwd">
		<p>Conf Passwd: </p> <input type="password" name="confPass" id="confPass" required="required" placeholder="Confirm Pass">
		<span style="display:none;font-family:'Times New Roman', Georgia, Serif;" id="nonConf">Passwords do not match </span>

		<p>eMail: </p> <input type="text" name="email" id="email" required="required" placeholder="enter email">
		<input type="submit" name="submit" value="Regi">

	</form>
	</div>
<?php
include("dbAccount.php");
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$conSQL = mysqli_connect($hostname, $username, $password, $database) or die (mysqli_error());


	if(isset($_POST["submit"])){
		$user=mysqli_real_escape_string($conSQL, $_POST["user"]);
		$email=mysqli_real_escape_string($conSQL, $_POST["email"]);
		$pass=mysqli_real_escape_string($conSQL, $_POST["passwd"]);

		//Rabbit of Caerbannog
		$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
		if (isset($argv[1]))
		{
		  $msg = $argv[1];
		}
		else
		{
		  $msg = "register_php testing";
		}

		$request = array();
		$request['type'] = "Register";
		$request['username'] = $user;
		$request['password'] = $pass;
		$request['email'] = $email;
		$request['message'] = $msg;
		//$response = $client->send_request($request);
		//$response = $client->publish($request);
		//if($response == true){

		  //If username does NOT exist in users table:
		  $query=mysqli_query($conSQL,"SELECT * FROM users where username=$user");
		  echo "$query";
		  $nRows=mysqli_num_rows($query);
		  if($nRows==0){
		  //try to add to table
		    $query2="INSERT INTO users(username, email, password) VALUES('$user','$email', '$pass')";
		    $attempt=mysqli_query($conSQL, $query2);
		    if($attempt){
		        echo "Registered user: $user ...";
		    }else{
		        echo "How you even get here?!";}
		  //If username DOES already exist in users table:
		  }else {   
		  	echo "Sorry, that username is already registered.";
		  }
		//}
		//else{
	  	//   echo "Caged Bunnies which run the server ran away while you were at summer camp.";}
	}

	//Should hash password before storing


?>
</body>
</html>
