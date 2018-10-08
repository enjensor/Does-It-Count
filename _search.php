<?php
	define('MyConst', TRUE);
	include("./_header.php");
	$queryB = "SELECT * FROM forname4 ";
	$queryB .= "WHERE FoRCode = \"$FoRs\" ORDER BY FoRCode ASC"; 
	$mysqli_resultB = mysqli_query($mysqli_link, $queryB);
	while($rowB = mysqli_fetch_row($mysqli_resultB)) {
		$FoRCode = $rowB[1];		
	}

/////////////////////////////////////////////////////////// Start

?>
<!-- <div data-role="header" data-theme="d">
	<h1>Search Results</h1>
	<a href="./index.php" 
	   data-icon="back" 
	   data-iconpos="notext" 
	   data-direction="reverse">Home</a>
</div>
//-->
<div data-role="content">
	<div class="content-primary">
		<p style="text-align: center; padding-bottom: 12px;">
			<a href="./_browse.php" data-transition="fade" data-inline="true">
				<img src="./assets/images/library_seating.jpg" width="100%" id="fieldsImage">
			</a>
		</p>
		<p class="blurb"><strong>Looking for "<?php echo $journalFind; ?>" journals ...</strong></p>
		<?php include("_search_list.php"); ?>
	</div>
</div>
<?php

/////////////////////////////////////////////////////////// Finish

	include("./_footer.php");

?>