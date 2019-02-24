#!/usr/bin/php
<?php
//Can We Connect via PHP
include("dbAccount.php");
mysqli_connect($hostname, $username, $password, $database) or die (mysqli_error());
print "Connected.";

?>
