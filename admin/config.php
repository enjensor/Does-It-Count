<?php 

/////////////////////////////////////////////////////////// Credits
//
//
//	Journal Finder Mobile Toolkit
//	University Library
//	Western Sydney Univeri
//
//	Procedural Scripting: PHP | MySQL | JQuery
//
//	FOR ALL ENQUIRIES ABOUT CODE
//
//	Who:	Dr Jason Ensor
//	Email: 	j.ensor@uws.edu.au | jasondensor@gmail.com
//	Mobile: 0419 674 770
//
//
//  VERSION 0.1
//  13 September 2018
//
//
/////////////////////////////////////////////////////////// Main DB
	
	if(!defined('MyConst')) {
   		die('Direct access not permitted');
	}

	$serverName = $_SERVER["SERVER_NAME"];

	if(($serverName == "localhost")){
		$localhost = "localhost";
		$username = "***";
		$password = "***";
		$database = "era2015";
	}

/////////////////////////////////////////////////////////// Detaint

	$dbc = @mysqli_connect($localhost, $username, $password);

	foreach($_POST as $key => $value) {
		$newVal = trim($value);
    	$newVal = htmlspecialchars($newVal);
    	$newVal = mysqli_real_escape_string($dbc,$newVal);
		$_POST[$key] = $newVal;
	}

	foreach($_GET as $key => $value) {
		$newVal = trim($value);
    	$newVal = htmlspecialchars($newVal);
    	$newVal = mysqli_real_escape_string($dbc,$newVal);
		$_GET[$key] = $newVal;
	}

	if(($_GET["doit"] == "date")) {
		echo gmmktime(0,0,0,2,18,2014);
	}

?>
