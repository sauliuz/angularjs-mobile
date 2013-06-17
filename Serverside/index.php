<?php
/*

 Created as an example of server side functionality
 needed for YummyThings mobile app tutorial on
 www.htmlcenter.com

 Serves only as prototype, you'll need something
 much more sophisticated for live implementation.
 Use at your own risk!

 by Saul Zukauskas // @sauliuz
 www.popularowl.com

*/


// Simple tweak to allow from any origin
// Credits to http://stackoverflow.com/questions/8719276/cors-with-php-headers
//
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}

///////////////////////////////////////
// SETUP //////////////////////////////
///////////////////////////////////////

// API credentials
//
$apikey = "8j3emzn44rnb2f77bqvjuy9s";

// Number of itens in response 
$returnitems = 5;

///////////////////////////////////////

$url = "http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?page_limit=".$returnitems."&page=1&country=uk&apikey=".$apikey;



	// Building string for GET request
	//
	$requeststr = $url;


	// CURL for communicating with web service
	//
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$requeststr);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);


	$response = curl_exec($ch);
	echo $response;


	// We will do some heavy lifting on the server side
	// // parse JSON and send back already prepared html with
	// // only the elements we have to add to fields
	// //
	// $response_decoded = json_decode($response, true);

	// for ($i=1; $i<=$returnitems; $i++) {

		
	// 	$returnstring = $returnstring."<li><p><img src='".
	// 		$response_decoded['matches'][$i]['smallImageUrls']['0']."' /> ".
	// 		$response_decoded['matches'][$i]['recipeName'].", it has ".count($response_decoded['matches'][$i]['ingredients'])." ingridients.</p></li>";
	// }

	// echo $returnstring;


?>
