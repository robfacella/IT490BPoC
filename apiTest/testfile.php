<?php

// your code goes here
$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=The%20Good%20Place&apikey=f0530b1d"), true);
print_r($movieInfo);
if ($movieInfo["Type"] == "movie") {
  print("This is a movie and we can proceed".PHP_EOL);
  print($movieInfo["Title"]);
}
//INSERT INTO Movies (Title, Year, Rated, Genre, Director, Actors, Poster) VALUES ($movieInfo["Title"], $movieInfo["Year"], $movieInfo["Rated"], $movieInfo["Genre"], $movieInfo["Director"], $movieInfo["Actors"], $movieInfo["Poster"])
?>
