<?php
//pulls the movieid from the url
$mID = $_GET["mID"];
if (is_numeric($mID)==false){
	echo "Error: Movie ID must be an integer";
	exit;
}
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("brokerRabbitMQ.ini","testServer");
$request = array();
$request['type'] = "moviePage";
$request['movieID'] = $movieID;
$request['message'] = "Sending Movie Page for < $movieID > Request to the Broker Host.";
$response = $client->send_request($request);

$title = $response['title'];
$actors = $response['actors'];
$year = $response['year'];
$genre = $response['genre'];
$rating = $response['rating'];

?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<title>Movie</title>
</head>

<body>
	<div class="container">
	<h1><?php echo $title; ?><h1><br>
	<form method="post" action="">
		Staring: <?php echo $actors; ?> <br>
		Released: <?php echo $year; ?> <br>
		Genre: <?php echo $genre; ?> <br>
		User Rating: <?php echo $rating; ?> <br>
	</form>
	</div>
</body>

</html>
