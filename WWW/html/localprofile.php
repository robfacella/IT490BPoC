<?php
//pulls the profile name from the url
$user = $_GET["user"];
//this is set up to get data from a local database, needs to be changed to work with rabbit
$db = mysqli_connect("localhost", "root","", "testdb");
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
mysqli_select_db($db, "testdb" );
//error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set( 'display_errors' , 1 );

//pull user data
$s = "select * from accounts where username = '$user' " ;
($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
while ( $r = mysqli_fetch_array ( $t, MYSQLI_ASSOC) ) {
	$movies = $r[ "movies" ];
	$friends = $r[ "friends" ];
}
?>

<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Profile</title>
</head>

<body>
	<div class="container">
	<h1><?php echo $user; ?>'s Profile<h1><br>
	<form method="post" action="">
		Insert Profile jargon here <br>

		<form method="post" action"">
		Movie list: <?php echo $movies; ?> <br>
		Add watched movies <input type="text" name="newMovie"> <br>
		<input type="submit" value="submit" name="msubmit_btn"> <br> <br>
		</form>

		<form method="post" action"">
		Friends list: <?php echo $friends; ?> <br>
		Add friends <input type="text" name="newFriend"> <br>
		<input type="submit" value="submit" name="fsubmit_btn"> <br> <br>
		</form>

	</form>
	</div>
</body>

</html>
<?php
class userProfile {
    //int
    public $userID;
    public $statNames = array('Genre', 'Director', 'Actors');

    //array of arrays with keys
    //each internal array has a key named after the genre loading a rating
    public $weighedStats = array('Genre'=> array('Sci-fi'=>0), 'Director'=>array('Alfred Hitchcock'=>0),/* 'Year'=>array(),*/ 'Actors'=>array('Tom Cruise'=>0));
    public $unweighedStats = array('Genre'=> array('Sci-fi'=>0), 'Director'=>array('Alfred Hitchcock'=>0),/* 'Year'=>array(),*/ 'Actors'=>array('Tom Cruise'=>0));
    public $movieCount = 0;

    //Array of strings
    public $movieList = array();

    //functions to set info from database
    public function setWeighedStats($userStats){
      $weighedStats = $userStats;
    }
    public function setUserID($inputID){
      $userID = $inputID;
    }
    public function setMovieList($userList){
      $movieList = $userList;
    }
    public function setMovieCount(){
      $movieCount = count($this->movieList);
    }

    //$newMovie is an array formatted like the API pulls
    //[Genre, "Sci-fi, Fantasy, Etc."]
    //The names of each key is in $statNames
    //$rating is either -1, -0.5, 0, 0.5, or 1
    //Aligns with the star value, with -1 being one star and 1 being five
    public function addMovie($newMovie, $rating){
      //iterate movie count for correct average
      $this->movieCount++;
      //add movie to list of movies
      array_push($this->movieList, $newMovie["Title"]);

      //looping through entry names to save space
      while($currentStat = current($this->statNames)){
        //seperate the genre of the new movie into an array
        $explodedEntry = explode(',', $newMovie[$currentStat]);
        //iterate through all genres to add
        foreach($explodedEntry as $explodedStat){
          //check if genre already exists in user stats
          //if so, add to existing array
          if (array_key_exists($explodedStat, $this->unweighedStats[$currentStat])){
            $this->unweighedStats[$currentStat][$explodedStat] = $this->unweighedStats[$currentStat][$explodedStat] + $rating;
          }
          else{
            //genre doesn't exist in stats, add
            $this->unweighedStats[$currentStat][$explodedStat] = $rating;
          }
        }
        //clear weighed stats' original array
        unset($this->weighedStats[$currentStat]);
        //set weighed to unweighed
        $this->weighedStats[$currentStat] = $this->unweighedStats[$currentStat];
        //iterate through entries
        while($valueToBeWeighed = current($this->weighedStats[$currentStat])) {
          //average entries
          current($this->weighedStats[$currentStat]) = $valueToBeWeighed/$this->movieCount;
          next($this->weighedStats[$currentStat]);
        }
        next($this->statNames);
      }
    }
  }

  //Both of these are arrays of userProfile classes
  //the first is the users who are a part of the group watching
  //the second is an array of all other users
  function recommendMovie($usersToWatch, $otherUsers){
    $statNames = array('Genre', 'Director', 'Actors');
    $groupStatsWeighed = array('Genre'=> array('Sci-fi'=>0), 'Director'=>array('Alfred Hitchcock'=>0),/* 'Year'=>array(),*/ 'Actors'=>array('Tom Cruise'=>0));
    $groupStatsUnweighed = array('Genre'=> array('Sci-fi'=>0), 'Director'=>array('Alfred Hitchcock'=>0),/* 'Year'=>array(),*/ 'Actors'=>array('Tom Cruise'=>0));
    $maxStatName = array();
    $maxStatNumber = array(0, 0, 0);
    $matchingUsers = array();

    //same as adding movies just with multiple users
    foreach ($usersToWatch as $userAdding) {
      foreach($statNames as $currentStat){
        //iterate through all genres to add
        while($oldStat = current($groupStatsUnweighed[$currentStat])){
          while($userStat = current($userAdding)){
            //check if genre already exists in user stats
            //if so, add to existing array
            if (array_key_exists(key($userAdding), $groupStatsUnweighed[$currentStat])){
              current($groupStatsUnweighed[$currentStat]) = $oldStat + $userStat;
            }
            else{
              //genre doesn't exist in stats, add
              $groupStatsUnweighed[$currentStat][key($userAdding)] = $userStat;
            }
            next($userAdding);
          }
          //clear weighed stats' original array
          unset($groupStatsWeighed[$currentStat]);
          //set weighed to unweighed
          $groupStatsWeighed[$currentStat] = $groupStatsUnweighed[$currentStat];
          //iterate through entries
          while($valueToBeWeighed = current($this->groupStatsWeighed[$currentStat])) {
            //average entries
            current($this->groupStatsWeighed[$currentStat]) = $valueToBeWeighed/count($usersToWatch);
            next($this->groupStatsWeighed[$currentStat]);
          }
          next($groupStatsUnweighed[$currentStat]);
        }
      }
    }

    //Here is where database stuff will come into play.
    $iterationCount = 0;
    foreach ($statNames as $currentStat) {
      while($currentSort = current($groupStatsWeighed[$currentStat])) {
        //check if next value is higher
        if($currentSort > $maxStatNumber[$iterationCount]){
          $maxStatName[$iterationCount] = key($groupStatsWeighed[$currentStat]);
          $maxStatNumber[$iterationCount] = $currentSort;
        }
        //if two values are the same, randomly pick one to keep
        elseif ($currentSort = $maxStatNumber[$iterationCount]) {
          $rando = rand(0,1);
          if($rando = 1){
            $maxStatName[$iterationCount] = key($groupStatsWeighed[$currentStat]);
            $maxStatNumber[$iterationCount] = $currentSort;
          }
        }
        next($groupStatsWeighed[$currentStat]);
      }
      $iterationCount++;
    }

    $x = 0;
    foreach ($otherUsers as $currentOther) {
      $otherStatName = array();
      $otherStatName = array(0, 0, 0);
      $iterationCount = 0;
      foreach ($statNames as $currentStat) {
        while($currentSort = current($currentOther->$weighedStats[$currentStat])) {
          //check if next value is higher
          if($currentSort > $otherStatNumber[$iterationCount]){
            $otherStatName[$iterationCount] = key($currentOther->$weighedStats[$currentStat]);
            $otherStatNumber[$iterationCount] = $currentSort;
          }
          //if two values are the same, randomly pick one to keep
          elseif ($currentSort[1] = $otherStatNumber[$iterationCount]) {
            $rando = rand(0,1);
            if($rando = 1){
              $otherStatName[$iterationCount] = key($currentOther->$weighedStats[$currentStat]);
              $otherStatNumber[$iterationCount] = $currentSort;
            }
          }
          next($currentOther->$weighedStats[$currentStat]);
        }
        $iterationCount++;

        if($otherStatName[0] == $maxStatName[0]){
          $matchingUsers[$x] = $currentOther->$userID;
          $x++;
        }
      }
    }
    //ADAM!
    //Once we have a selected user(s), go through the database and pick out all movies
    //that have max genre, remove any already seen,
    //then pick one randomly
  }

if(isset($_REQUEST['msubmit_btn']))
{
	$newMovie =  $_POST["newMovie"];
	$s = "select * from movies where title = '$newMovie' " ;
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
	$num =mysqli_num_rows($t);
    if ($num==0){
	//not in movies db
	//api pull
	//changes the newMovie to a new variable that replaces spaces with underscores
	$apimovie = str_replace(' ', '_', $newMovie);
	$movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $apimovie . "&apikey=f0530b1d"), true);

	//Outputs info on movie into console
	print_r($movieInfo);

	//Checks movie info to be sure this is indeed a movie and not a TV show
	if($movieInfo["Response"] == "True"){
		if ($movieInfo["Type"] == "movie") {
			print("This is a movie and we can proceed".PHP_EOL);
			//adds movie to db
			$newMovie= $movieInfo["Title"];
			$mt = $movieInfo["Title"];
			$my = $movieInfo["Year"];
			$mra = $movieInfo["Rated"];
			$mre = $movieInfo["Released"];
			$mg = $movieInfo["Genre"];
			$ma = $movieInfo["Actors"];
			$mp = $movieInfo["Poster"];
		 	$s = "INSERT INTO movies (title, year, rated, released, genre, actors, poster)
			VALUES('$mt','$my','$mra','$mre','$mg','$ma','$mp')";
			($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
			$rating = 1;
      //ADAM!
      //THIS IS WHERE THE DATABASE NEEDS TO PULL THE STATS
			$currentUser = new userProfile();
			$currentUser->addMovie($movieInfo, $rating);
      //THIS IS WHERE THE DATABASE NEEDS TO SAVE THE STATS
			print_r($currentUser->weighedStats['Genre']);
		}
	else{
		print("API did not return a movie. returned a type of: ".PHP_EOL);
		print($movieInfo["Type"]);
	}
	}else{
		print("API did not respond, try again later. ".PHP_EOL);
	}
		echo "false";
	}
	$movies = $movies . ", " . $newMovie;
	$s = "update accounts set movies = '$movies' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );


}
if(isset($_REQUEST['fsubmit_btn']))
{
	$newFriend =  $_POST["newFriend"];
	$friends = $friends . ", " . $newFriend;
	$s = "update accounts set friends = '$friends' where username = '$user' ";
	($t = mysqli_query($db, $s) ) or die ( mysqli_error( $db ) );
}
?>
