<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
</head>
<script>
//Test for matching password fields.//Verify Password == confirmed password
function checkPasses(){
	var pword = document.getElementById("passwd");
	var cpswd = document.getElementById("confPass");
	if(pword.value != cpswd.value){
		document.getElementById("nonConf").style.display="block";
		cpswd.value="";
	}
	if(pword.value == cpswd.value){
		document.getElementById("nonConf").style.display="none";
	}
	
}
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

	if(isset($_POST["submit"])){
		$user=$_POST["user"];
		$email=$_POST["email"];
		$pass=$_POST["passwd"];
	//	$confPass;

		//echo $user;
		//echo $email;
		//

	}

	//hash password before storing

	//sql statement to store data

	//sql query with statement and db



?>
</body>
</html>
