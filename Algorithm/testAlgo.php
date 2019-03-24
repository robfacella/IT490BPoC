#!/bin/php
<?php
  //Here is where we initalize our fake users
  //initalize user stats
  //get user input on movie
  //add to user stats
  //check stats against stats of other users, find closest matching user
  //check found user's movies for unseen movies
  //suggest movie closest to stats

  $currentUser = new userProfile();
  userProfile.addMovie($movieInfo, $rating);

  class userProfile {
    //int
    public $userID;
    public $statNames = array('Genre', 'Director', 'Actors');

    //array of arrays with keys
    //each internal array is [Name of Object, Numerical Value]
    //For Example, [Sci-fi, .5]
    public $weighedStats = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
    public $unweighedStats = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
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
    public function setMovieCount($userCount){
      $movieCount = $userCount;
    }

    //$newMovie is an array formatted like the API pulls
    //[Genre, "Sci-fi, Fantasy, Etc."]
    //The names of each key is in $statNames
    //$rating is either -1, -0.5, 0, 0.5, or 1
    //Aligns with the star value, with -1 being one star and 1 being five
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

  //Both of these are arrays of userProfile classes
  //the first is the users who are a part of the group watching
  //the second is an array of all other users
  function recommendMovie($usersToWatch, $otherUsers){
    $statNames = array('Genre', 'Director', 'Actors');
    $groupStatsWeighed = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
    $groupStatsUnweighed = array('Genre'=> array(), 'Director'=>array(),/* 'Year'=>array(),*/ 'Actors'=>array());
    $maxStatName = array();
    $maxStatNumber = array(0, 0, 0);
    $matchingUsers = array();

    //same as adding movies just with multiple users
    foreach ($usersToWatch as $userAdding) {
      foreach($statNames as $currentStat){
        //iterate through all genres to add
        foreach($groupStatsUnweighed[$currentStat] as &$oldStat){
          foreach($userAdding as $userStat){
            //check if genre already exists in user stats
            //if so, add to existing array
            if ($oldStat[0] == $userStat[0]){
              $oldStat[1] = $oldStat[1] + $userStat[1];
            }
            else{
              //genre doesn't exist in stats, add
              array_push($groupStatsUnweighed[$currentStat], array($userStat[0] , $userStat[]));
            }
          }
          //clear weighed stats' original array
          unset($groupStatsWeighed[$currentStat]);
          //set weighed to unweighed
          $groupStatsWeighed[$currentStat] = $groupStatsUnweighed[$currentStat];
          //iterate through entries
          foreach ($groupStatsWeighed[$currentStat] as &$valueToBeWeighed) {
            //average entries
            $valueToBeWeighed[1] = $valueToBeWeighed[1]/count($usersToWatch);
          }
          unset($valueToBeWeighed);
        }
        unset($oldStat);
      }
    }

    //Here is where database stuff will come into play.
    $iterationCount = 0;
    foreach ($statNames as $currentStat) {
      foreach ($groupStatsWeighed[$currentStat] as $currentSort) {
        //check if next value is higher
        if($currentSort[1] > $maxStatNumber[$iterationCount]){
          $maxStatName[$iterationCount] = $currentSort[0];
          $maxStatNumber[$iterationCount] = $currentSort[1];
        }
        //if two values are the same, randomly pick one to keep
        elseif ($currentSort[1] = $maxStatNumber[$iterationCount]) {
          $rando = rand(0,1);
          if($rando = 1){
            $maxStatName[$iterationCount] = $currentSort[0];
            $maxStatNumber[$iterationCount] = $currentSort[1];
          }
        }
      }
      $iterationCount++;
    }

    $x = 0;
    foreach ($otherUsers as $currentOther) {
      $otherStatName = array();
      $otherStatName = array(0, 0, 0);
      $iterationCount = 0;
      foreach ($statNames as $currentStat) {
        foreach ($currentOther->$weighedStats[$currentStat] as $currentSort) {
          //check if next value is higher
          if($currentSort[1] > $otherStatNumber[$iterationCount]){
            $otherStatName[$iterationCount] = $currentSort[0];
            $otherStatNumber[$iterationCount] = $currentSort[1];
          }
          //if two values are the same, randomly pick one to keep
          elseif ($currentSort[1] = $otherStatNumber[$iterationCount]) {
            $rando = rand(0,1);
            if($rando = 1){
              $otherStatName[$iterationCount] = $currentSort[0];
              $otherStatNumber[$iterationCount] = $currentSort[1];
            }
          }
        }
        $iterationCount++;

        if($otherStatName[0] == $maxStatName[1]){
          $matchingUsers[$x] = $currentOther->$userID;
          $x++;
        }
      }
    }

    //Once we have a selected user(s), go through the database and pick out all movies
    //that have max genre, remove any already seen,
    //then pick one randomly
  }

/*  //create temp user for current session
  $currentUser = new userProfile();
  $looper = True;
  //check if button pressed
  while ($looper){
    echo "Do you want to add another movie?".PHP_EOL;
    $input = rtrim(fgets(STDIN));
    if ($input = "y") {
      echo 'OK! What movie would you like to add?'.PHP_EOL;
      $input = rtrim(fgets(STDIN));
      $movieInfo = json_decode(file_get_contents("http://www.omdbapi.com/?t=" . $input . "&apikey=f0530b1d"), true);

      //Outputs info on movie into console
      print_r($movieInfo);

      //Checks movie info to be sure this is indeed a movie and not a TV show
      if($movieInfo["Response"] == "True"){
        if ($movieInfo["Type"] == "movie") {
          $currentUser.addMovie($movieInfo, 1);
          print_r($currentUser->$weighedStats);
        }
      }
    }
}*/
?>
