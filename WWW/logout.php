<?php
  session_start();
  if(isset($_SESSION['uname']))
  {
  //Destroy Session & Redirect to Login
    session_destroy();    
    echo "<script>location.href='login.php'</script>";
  }
  else{
  //Redirect to login page anyway?
		echo "<script>location.href='login.php'</script>";
  }
?>
