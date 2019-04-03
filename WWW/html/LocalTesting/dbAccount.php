<?php
#Debugging
class dbAccount
{
  public $dbhostname = "localhost";
  public $dbuser = "testuser";
  public $dbpass = "password";
  public $dbdatabase = "testdb";
  
  function getHostname()
  {
    return $dbhostname;
  }
}
?>
