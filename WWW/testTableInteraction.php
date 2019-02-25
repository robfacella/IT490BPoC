#!/usr/bin/php
<?php
include("dbAccount.php");
mysqli_connect($hostname, $username, $password, $database) or die (mysqli_error());
print "Connected.\n";



?>
