#!/usr/bin/php
<?php

// your code goes here
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Blade Runner";
}

$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $msg . "&apikey=f0530b1d"), true);
print_r($movieInfo);
if($movieInfo["Response"] == "True"){
  if ($movieInfo["Type"] == "movie") {
    print("This is a movie and we can proceed".PHP_EOL);
    print($movieInfo["Year"]);
    $serverInfo = mysqli_connect("192.168.8.235", "testuser", "password", "testdb");
    $SQLquery = "INSERT INTO movies(Title, Year, Rated, Released, Genre, Director, Actors, Poster) VALUES (".$movieInfo["Title"].", ".$movieInfo["Year"].", ".$movieInfo["Rated"].", ".$movieInfo["Released"].", ".$movieInfo["Genre"].", ".$movieInfo["Director"].", ".$movieInfo["Actors"].", ".$movieInfo["Poster"].")";
    mysql_query($SQLquery);
    $serverInfo->close;
  }
}

?>
