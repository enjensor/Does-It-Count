<?php
	define('MyConst', TRUE);
	include("./_header.php");

/////////////////////////////////////////////////////////// Start

?>
<div data-role="content">
	<div class="content-primary">
		<p style="text-align: center; padding-bottom: 12px;">
			<a href="./index.php" data-transition="fade" data-inline="true">
				<img src="./assets/images/wsu_banner_trans.png" width="90%" id="bannerImage">
			</a>
		</p>
		<p>
			<form method="GET" action="_search.php">
     			<input type="search" name="journalFind" id="journalFind" value="" placeholder="Search Journals by Title Terms ...">
			</form>
		</p>
		<p class="blurb"  style="padding-top: 12px;">Disseminating research findings is a key aspect of the research process. Dissemination assists with passing on the benefits of research, increasing exposure to the work, sharing of data and building a researcher’s profile. Western Sydney University Library assists in the process of disseminating research through Journal Finder. This tool is to help all Western Sydney University researchers publish their work in relevant high quality journals by providing Australian and international contextual information on how a journal counts towards a particular field.</p> 
		<p class="blurb">At its core, the service provides researchers with information about journal FoRs (fields of research as per the ARC disciplinary matrix and journal list) and their journal impact trends. Journal Finder also draws data from major citation research assets like Scopus or Thomas Reuters, and display relative citation impact trends with respect to known national citation benchmarks in a field of research. Given the issues of the impact factor and how it is derived, it remains important to align or contrast this information with other measures of journal evaluation. Journal Finder provides information then that is within Australian contexts and with regards to conventional and alternative impact metrics plus Federal Government lists.</p>
		<p>&nbsp;</p>
	</div>
</div>
<?php

/////////////////////////////////////////////////////////// Finish

	include("_footer.php");

?>