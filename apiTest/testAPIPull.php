#!/usr/bin/php
<?php

// your code goes here
//Make sure there actually is input, otherwise return Blade Runner
//NOTE: Make sure that the ENTIRE input is taken, otherwise it just searches for first word
//EXAMPLE: Pulp Fiction searched only for "Pulp"

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Blade Runner";
}

//Add user input into the API URL
$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $msg . "&apikey=f0530b1d"), true);

//Outputs info on movie into console
print_r($movieInfo);

//Checks movie info to be sure this is indeed a movie and not a TV show
if($movieInfo["Response"] == "True"){
  if ($movieInfo["Type"] == "movie") {
    print("This is a movie and we can proceed".PHP_EOL);
    print($movieInfo["Year"]);
    //This is where it needs to go into the database.
    /*
    $serverInfo = mysqli_connect("127.0.0.1", "root", "root", "testdb") or die (mysqli_error());
    $SQLquery = "INSERT INTO movies(Title, Year, Rated, Released, Genre, Director, Actors, Poster) VALUES(".$movieInfo["Title"].", ".$movieInfo["Year"].", ".$movieInfo["Rated"].", ".$movieInfo["Released"].", ".$movieInfo["Genre"].", ".$movieInfo["Director"].", ".$movieInfo["Actors"].", ".$movieInfo["Poster"].");";
    echo $SQLquery;
    mysql_query($SQLquery);
    $serverInfo->close;*/
  }
}

?>
