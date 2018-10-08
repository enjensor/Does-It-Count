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
/////////////////////////////////////////////////////////// Clean Vars

	session_start();
	include("./admin/config.php");
	include("./admin/era.dbconnect.php");
	mb_internal_encoding("UTF-8");
	if (!mysqli_set_charset($mysqli_link, "utf8")) {
		echo "PROBLEM WITH CHARSET!";
		die;
	}

	$FoRs = trim($_GET["FoRs"]);
	$Order = trim($_GET["Order"]);
	$journalFind = trim($_GET["journalFind"]);
	$_GET = array();
	$_POST = array();

	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

/////////////////////////////////////////////////////////// Start

?>
<!DOCTYPE html>
<html lang="en">
	<head>	
    	<title>Does it Count?</title>
        <meta charset="utf-8">
        <meta name="description" content="Does it Count?" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />  
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<meta name="msapplication-TileColor" content="#ffffff" />
		<meta name="msapplication-TileImage" content="./assets/icons/ms-icon-144x144.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="57x57" href="./assets/icons/apple-icon-57x57.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="60x60" href="./assets/icons/apple-icon-60x60.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="./assets/icons/apple-icon-72x72.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="76x76" href="./assets/icons/apple-icon-76x76.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="114x114" href="./assets/icons/apple-icon-114x114.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="./assets/icons/apple-icon-120x120.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="144x144" href="./assets/icons/apple-icon-144x144.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="152x152" href="./assets/icons/apple-icon-152x152.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="./assets/icons/apple-icon-180x180.png" />
		<link rel="apple-touch-icon" type="image/png" sizes="192x192" href="./assets/icons/apple-icon.png" />
		<link rel="icon" type="image/png" sizes="192x192" href="./assets/icons/android-icon-192x192.png" />
		<link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png" />
		<link rel="icon" type="image/png" sizes="96x96" href="./assets/icons/favicon-96x96.png" />
		<link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-16x16.png" />
        <link rel="icon" type="image/x-icon" sizes="16x16" href="./assets/icons/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" sizes="16x16" href="./assets/icons/favicon.ico" /> 
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
		<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script language="javascript" type="text/javascript">
			
			$(document).bind("mobileinit", function () {
				$.mobile.ajaxEnabled = false;
			});
			
		</script>
		<script language="javascript" type="text/javascript" src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>		
		<style type="text/css" rel="stylesheet">			
			
			.ui-mobile-viewport-transitioning, .ui-mobile-viewport-transitioning .ui-page {
				overflow: visible;
			}
			
			.ui-listview-filter-inset {
				margin-top: 0;
			}
			
			.ui-body-c, .ui-overlay-c {
    			background-image: none !important;
				background-color: #FFFFFF !important;
			}
			
			.ui-li .ui-btn-inner a.ui-link-inherit, .ui-li-static.ui-li  {
				padding-top: 0.3em !important;
			/*	padding-right: 0.9em !important; */
				padding-bottom: 0.3em !important;
				padding-left: 0.9em !important;
				display: block !important;
				font-size: 0.85em !important;
				font-weight: 400 !important;
			}
			
			.ui-btn-up-c {
				border: 1px solid #999999 !important;
				background-image: none !important;
				background-color: #FBFBFB !important;
			}
			
			.ui-fullsize .ui-btn-inner, .ui-fullsize .ui-btn-inner {
				font-size: 0.9em !important;
				font-weight: 500 !important;
			}
			
			.ui-corner-bottom {
				-moz-border-radius-bottomleft: 0em !important;
				-webkit-border-bottom-left-radius: 0em !important;
				border-bottom-left-radius: 0em !important;
				-moz-border-radius-bottomright: 0em !important;
				-webkit-border-bottom-right-radius: 0em !important;
				border-bottom-right-radius: 0em !important;
			}
			
			.ui-corner-top {
				-moz-border-radius-topleft: 0em !important;
				-webkit-border-top-left-radius: 0em !important;
				border-top-left-radius: 0em !important;
				-moz-border-radius-topright: 0em !important;
				-webkit-border-top-right-radius: 0em !important;
				border-top-right-radius: 0em !important;
			}
			
			.collapseContainer {
				background: #FFFFFF !important;
				border: none !important;
				border-bottom: 0px solid #eeeeee !important;
				margin: 0px !important;
			}
			
			.ui-li-divider {
				padding: 0.5em 0.5em 0.5em 0.9em !important;
				font-size: 0.9em !important;
				font-weight: bold !important;
				border: none !important;
				border-bottom: 0px solid #eeeeee !important;
				margin-bottom: 1.0em !important;
				margin-top: 1.0em !important;
				background-color: #932d3a !important;
			}
			
			.ui-listview-filter-inset {
				margin-bottom: 4px !important;
			}
			
			.ui-btn-inner {
				border-top: none !important;
				border-bottom: none !important;
				height: auto !important;
				word-wrap: break-word !important;
				white-space: normal !important;
				line-height: 1.4em !important;
			}
			
			.ui-collapsible-inset .ui-collapsible-heading .ui-btn {
				border-right-width: 0px !important;
    			border-left-width: 0px !important;
				border-top-width: 0px !important;
				border-bottom-width: 0px !important;
			}
			
			.ui-li .ui-btn-text a.ui-link-inherit {
				height: auto !important;
				word-wrap: break-word !important;
			/*	white-space: normal !important; */
				line-height: 1.4em !important;
			}
			
			.ui-collapsible-heading .ui-btn-icon-right .ui-btn-inner {
				padding-left: 30px !important;
				text-indent: -21px !important;
				padding-right: 40px !important;
			}
			
			.header {
				font-family: 'Lato', serif !important;
			}
			
			.mainList {
				background: #FFFFFF !important;
			}
			
			.collapseSpace {
				background: #FFFFFF !important;
				border: none !important;
				border-bottom: 0px solid #eeeeee !important;
				margin: 0px !important;
			}
			
			.collapseItem {
				background: #FFFFFF !important;
				border: none !important;
				border-bottom: 0px solid #eeeeee !important;
				margin: 0px !important;
				padding-top: 0.2em !important;
				color: #800000 !important;
				word-wrap: break-word !important;
				white-space: normal !important;
			}
			
			.collapseItem a {
				color: #800000 !important;
			}
			
			.collapseUL {
				padding-top: 1.0em !important;
				padding-bottom: 1.0em !important;
				padding-left: 16px !important;
			}
			
			.blurb {
				text-align: justify !important;
				font-family: 'Lato', sans-serif !important;
			}
			
			html, body {
				background-color: #FFFFFF !important;
			}
			
		</style>
	</head>   
	<body>
		<div data-role="page" class="type-interior" id="myPage">
			<div data-role="header" data-id="foo1" data-theme="b">
				<div data-role="navbar">
					<ul>
						<li id="home"><a href="./index.php" data-transition="fade" data-inline="true"><i class="fas fa-home"></i></a></li> 
						<li id="browse"><a href="_browse.php" data-transition="fade" data-inline="true"><i class="far fa-list-alt"></i></a></li>
					</ul>
				</div>
			</div>
<?php

/////////////////////////////////////////////////////////// Finish
			
?>