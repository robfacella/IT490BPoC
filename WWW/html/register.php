<html>
<head>
//Think that we can combine the HTML into the PHP and save a file in the directory...
	<meta charset="utf-8">
	<title>Registration</title>
</head>
<script>
//CTest for matching password fields.//Verify Password == confirmed password
</script>
<body>
	<div class="container">
	<h1>BPoC Registration</h1>
	<form action="" method="POST">
		<p>Choose your Username: </p> <input type="text" name="user" id="user" required="required" placeholder="enter username">

		<p>Enter a Password: </p> <input type="password" name="pass" id="pass" required="required" placeholder="Passwd">
		<p>Conf Passwd: </p> <input type="password" name="confPass" id="confPass" required="required" placeholder="Confirm Pass">

		<p>eMail: </p> <input type="text" name="email" id="email" required="required" placeholder="enter email">
		<input type="submit" name="submit" value="Regi">

	</form>
	</div>
<?php


	$user;
	$email;
	$pass;
	$confPass;

	//Connect to db
	
	//On reg button click
	//Check fields are set
	
	//if{

	//}

	//hash password before storing

	//sql statement to store data

	//sql query with statement and db



?>
</body>
</html>
