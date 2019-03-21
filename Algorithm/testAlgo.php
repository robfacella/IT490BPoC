<html>
<body>
<form id="form1" name="form1" method="post" action="">
  <label for="movieInput">Movie Title</label>
  <input type="text" name="movieInput" id="movieInput" />
</form>
<form action="testAlgo.php" method="post">
    <input type="button" name="addMovie" value="Add Movie" />
</form>
<?php
  //Here is where we initalize our fake users
  //initalize user stats
  //get user input on movie
  //add to user stats
  //it should automatically update movie suggestion but for now just loop until user is finished
  //check stats against stats of other users, find closest matching user
  //check found user's movies for unseen movies
  //suggest movie closest to stats

  //use this to output info
  function print_r2($val){
          echo '<pre>';
          print_r($val);
          echo  '</pre>';
  }

  class userProfile {
    public $statNames = array('Genre', 'Director', 'Actors');
    public $weighedStats = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
    public $unweighedStats = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
    public $movieCount = 0;
    public $movieList = array();

    //functions to set info from database
    public function setWeighedStats($userStats){
      $weighedStats = $userStats;
    }
    public function setMovieList($userList){
      $movieList = $userList;
    }
    public function setMovieCount($userCount){
      $movieCount = $userCount;
    }

    public function addMovie($newMovie, $rating){
      //iterate movie count for correct average
      $movieCount++;
      //add movie to list of movies
      array_push($movieList, $newMovie["Title"]);

      //looping through entry names to save space
      foreach($statNames as $currentStat){
        //seperate the genre of the new movie into an array
        $explodedEntry = explode(',', $newMovie[$currentStat]);
        //iterate through all genres to add
        foreach($unweighedStats[$currentStat] as &$oldStat){
          foreach($explodedEntry as $explodedStat){
            //check if genre already exists in user stats
            //if so, add to existing array
            if ($oldStat[0] == $explodedStat){
              $oldStat[1] = $oldStat[1] + $rating;
            }
            else{
              //genre doesn't exist in stats, add
              array_push($unweighedStats[$currentStat], array($explodedStat , $rating));
            }
          }
          //clear weighed stats' original array
          unset($weighedStats[$currentStat]);
          //set weighed to unweighed
          $weighedStats[$currentStat] = $unweighedStats[$currentStat];
          //iterate through entries
          foreach ($weighedStats[$currentStat] as &$valueToBeWeighed) {
            //average entries
            $valueToBeWeighed[1] = $valueToBeWeighed[1]/$movieCount;
          }
          unset($valueToBeWeighed);
        }
        unset($oldStat);
      }
    }
  }

  //create temp user for current session
  $currentUser = new userProfile();

  //check if button pressed
  if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['addMovie'])){
    echo 'Button Pressed'.PHP_EOL;
    $movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $msg . "&apikey=f0530b1d"), true);

    //Outputs info on movie into console
    print_r2($movieInfo);

    //Checks movie info to be sure this is indeed a movie and not a TV show
    if($movieInfo["Response"] == "True"){
      if ($movieInfo["Type"] == "movie") {
        $currentUser.addMovie($movieInfo, 1);
        print_r2($currentUser->$weighedStats);
      }
    }
  }
?>
</body>
</html>
