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
/////////////////////////////////////////////////////////// Vars

	if(!defined('MyConst')) {
   		die('Direct access not permitted');
	}

   	$mysqli_link = mysqli_connect("$localhost", "$username", "$password") 
   		or die ("<p>Database configuration error on $serverName using $username with $localhost</p>");
   	mysqli_select_db($mysqli_link, "$database") 
   		or die ("<p>Could not select the database!");
   		
?>