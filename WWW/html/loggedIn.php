<?php
  session_start();
  if(isset($_SESSSION['uname']))
  {
  //Welcome the User
    echo "<h1>Welcome ".$_SESSION['uname']." to BPoC</h1>";
    
    echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";
  }
  else{
  //Redirect to login page
		echo "<script>location.href='login.php'</script>";
  }
?>
