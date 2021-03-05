

<?php

include 'includes.php';

// Create cURL connection
$curl_connection = curl_init($enableUrl);

// Set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

// Set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

// Perform our request
$result = curl_exec($curl_connection);

// Close the connection
curl_close($curl_connection);

// Go back to previous page
function goback()
{
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
}
goback();

?>