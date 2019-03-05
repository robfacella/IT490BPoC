<?php

// your code goes here
print("hello world");
print_r(json_decode(file_get_contents("http://www.omdbapi.com/?t=Blade%20Runner&apikey=f0530b1d"), true));
?>
