<?php

include 'includes.php';

// Assign the results of the POST to a variable
$disableTime = $_POST['disableTime'];

// Convert disableTime (mins) to seconds
$secondsToDisable = $disableTime * 60;

//Create new $piHole URL with secondsToDisable variable
$disableUrl = $piHole . "/api.php?disable=" . $secondsToDisable . "&auth=" . $apiKey;

//create cURL connection
$curl_connection = curl_init($disableUrl);

//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

//perform our request
$result = curl_exec($curl_connection);

//close the connection
curl_close($curl_connection);

#method to go to previous page
function goback()
{
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
}

goback();

?>

