		<div data-role="collapsible" data-theme="a" data-content-theme="b" >
    		<h4>Impact Data Legend</h4>
    		<p style="text-align: justify; font-size: 0.8em;">
				<strong>FoRs</strong><br />The field(s) of research in the 2012 ERA Draft for this journal. Hover your cursor over the FoR code for the full field name.<br /><br />
				<strong>Q</strong><br />Quartile Rank. This is a Rank by Journal Impact Factor expressed as a quartile of the whole category. Top ranked journals are in the first quartile, which is 1. Please note that these categories do not necessarily align with ARC fields of research and that some journals may be in more than one category.<br /><br />
				<strong>5YR IF</strong><br />The 5-year journal Impact Factor is the average number of times articles from the journal published in the past five years have been cited in the year. It is caclulated by dividing the number of citations in the year by the total number of articles published in the five previous years. Although Impact Factors are based on cites to articles published in the previous two years, a base of five years may be more appropriate for journals in certain fields because the body of citations may not be large enough to make reasonable comparisons, publication schedules may be consistently late, or it may take longer than two years to disseminate and respond to published works.<br /><br />
				<strong>IF</strong><br />The Thomson Reuters impact factor is a measure of the frequency with which the 'average article' in a journal has been cited in a particular year or period. The annual JCR impact factor is a ratio between citations and recent citable items published. Thus, the impact factor of a journal is calculated by dividing the number of current year citations to the source items published in that journal during the previous two years.<br /><br />
				<strong>SNIP</strong><br />SNIP or Source Normalized Impact per Paper is an index of citation impact calculated by Journal Metrics. The SNIP value measures contextual citation impact by weighting citations based on the total number of citations in a subject field. This means that the impact of a single citation is given higher value in subject areas where citations are less likely, and vice versa. A field with journals having high SNIPs will have a high world standard.<br /><br />
				<strong>ABDC</strong><br />In 2007, Australian Business Deans Council established a Journal Quality list for use by its member business schools. The aim of this initial list was to overcome the regional and discipline bias of international lists. The current list comprises 2,767 different journal titles, divided into four categories of quality, A*: 6.9%; A: 20.8%; B: 28.4%; and C: 43.9% journals. In each Field of Research (FoR) group, journals deemed NOT to reach the quality threshold level are not listed. The FoR that corresponds with the ABDC value can be viewed by hovering the mouse cursor over the rank.<br /><br />
				<strong>OA</strong><br />This indicates that the journal is indexed on the Directory of Open Access publications.
			</p>
		</div>
		<ul style="font-size: 0.9em !important; line-height: 1.4em;">
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=" style="text-decoration: none !important; <?php if(($Order == "")) { echo "color: #800000 !important;"; } ?>">Order by Journal Title</a></li>
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=IF" style="text-decoration: none !important; <?php if(($Order == "IF")) { echo "color: #800000 !important;"; } ?>">Order by Impact Factor</a></li>
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=5YR" style="text-decoration: none !important; <?php if(($Order == "5YR")) { echo "color: #800000 !important;"; } ?>">Order by Impact Factor (5 Yr)</a></li>
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=SNIP" style="text-decoration: none !important; <?php if(($Order == "SNIP")) { echo "color: #800000 !important;"; } ?>">Order by SNIP</a></li>
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=ABDC" style="text-decoration: none !important; <?php if(($Order == "ABDC")) { echo "color: #800000 !important;"; } ?>">Order by ABDC</a></li>
			<li><a href="./_journals.php?FoRs=<?php echo $FoRs; ?>&Order=OA" style="text-decoration: none !important; <?php if(($Order == "OA")) { echo "color: #800000 !important;"; } ?>">Order by Open Access</a></li>
		</ul>
		<ul data-role="listview" data-filter="true" data-inset="true" style="-webkit-box-shadow: none; box-shadow: none;" <?php if(($Order == "")) { echo "data-autodividers=\"true\""; } ?> >
<?php

//////////////////////// Build Query			
			
	if(($Order == "")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY Title ASC"; 
	}
			
	if(($Order == "IF")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY ";
		$query .= "case when IF_2012 in('', '0') ";
		$query .= "then 1 else 0 end, ";
		$query .= "convert(`IF_2012`, decimal(5,3)) DESC";
	}
			
	if(($Order == "5YR")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY ";
		$query .= "case when 5YR_IMPACT_FACTOR in('', '0') ";
		$query .= "then 1 else 0 end, ";
		$query .= "convert(`5YR_IMPACT_FACTOR`, decimal(5,3)) DESC";
	}
			
	if(($Order == "SNIP")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY ";
		$query .= "case when SNIP_2013 in('', '0') ";
		$query .= "then 1 else 0 end, ";
		$query .= "convert(`SNIP_2013`, decimal(5,3)) DESC";
	} 
			
	if(($Order == "ABDC")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY ";
		$query .= "case when ABDC_Rank in('', '0') ";
		$query .= "then 1 else 0 end, ABDC_Rank ASC, Title ASC";
	}
			
	if(($Order == "OA")) {
		$query = "SELECT * ";
		$query .= "FROM 2017_journals_final_list ";
		$query .= "WHERE ";
		$query .= "Title LIKE \"%$journalFind\" ";
		$query .= "ORDER BY ";
		$query .= "OpenAccess DESC, Title ASC";
	}
			
//////////////////////// Do Query			
			
	$mysqli_result = mysqli_query($mysqli_link, $query);
	while($row = mysqli_fetch_row($mysqli_result)) { 
		
//////////////////////// IDs		
		
		$m++;
		$eRaids[$m] = $row[1];
		$metrics = "";
		$fsnip = "n";
		
//////////////////////// Get Metrics		
		
		$snip = number_format((float)$row[39], 3, '.', '');
		$rank = $row[19];
		$quartile = $row[29];
		$quartile = preg_replace("/Q/","","$quartile");
		$qrank = $row[28];
		$qcat = $row[27];
		$OAccess = $row[24];
		$fiveyrif = $row[34];
		$IFscore = number_format((float)$row[25], 3, '.', '');
		$AIscore = number_format((float)$row[26], 3, '.', '');
		$OAccessImg = "";
		if(($OAccess != "")) {
			$OAccessImg = "<i class=\"fas fa-check\"></i>";	
		}
		if(($rank == "No")) { $rank = "";}
		if(($snip == "No") OR ($snip == "0.000")) { $snip = ""; }
		if(($IFscore == "0.000")) { $IFscore = ""; }
		if(($AIscore == "0.000")) { $AIscore = ""; }
		$quartile = rtrim($quartile, "; ");
		$qcat = rtrim($qcat, "; ");
		$qrank = rtrim($qrank, "; ");	
		$quartiles = explode(";",$quartile);
		$qcats = explode(";",$qcat);
		$qranks = explode(";",$qrank);	
		$IFscore = number_format($IFscore,3);
		$fiveyrif = number_format($fiveyrif,3);
		$snip = number_format($snip,3);
		$row[2]= preg_replace("/'/i","\\'","$row[2]");
		$ABDC = $row[30];
		if(($snip != "") OR ($IFscore != "") OR ($fiveyrif != "") OR ($quartiles[0] != "") OR ($OAccess != "") OR ($ABDC != "")) {
			$metrics = "y";
			$fsnip = "y";
		}
		
//////////////////////// Display Metrics List Item	
		
		echo "<li style=\"";
		echo "margin-bottom: 1px; ";
		echo "word-wrap: break-word; ";
		echo "white-space: normal; ";
		echo "color: #000000 !important; ";
		echo "padding-bottom: 3px; ";
		echo "border-top: 0px solid #000000 !important; ";
		echo "border-left: 0px solid #000000 !important; ";
		echo "border-right: 0px solid #000000 !important; ";
		echo "border-bottom: 7px solid #000000 !important; ";
		if(($snip != "")) {
			echo "background-color: #dcdcdc !important; ";
		}
		echo "\">";
		
//////////////////////// Journal Name & Master Link		
		
		echo "<a href=\"./_view.php?";
		echo "eraid=$row[1]&";
		echo "fsnip=$fsnip&";
		echo "for4=$row[4]\" ";
		echo "data-rel=\"page\" ";
		echo "data-transition=\"fade\" ";
		echo ">";
		echo "<h3 style=\"";
		echo "color: #800000; ";
		echo "font-size: 1.1em; ";
		echo "font-weight: 700; ";
		echo "line-height: 1.6em; ";
		echo "width: 90%; ";	
		echo "white-space: normal; ";
		echo "\">".htmlentities($row[2])."</h3>";
		echo "<p style=\"";
		echo "color: #000000 !important; ";
		echo "word-wrap: break-word; ";
		echo "white-space: normal; ";
		echo "width: 90%; ";
		echo "\">";
		
//////////////////////// ISSN(S)
		
		echo "ISSN(S) ";
		for($r=0;$r<7;$r++) {
			$q=(10+$r);
			if(($row[$q] != "") && ($row[$q] != " ")) {
				echo "$row[$q] ";
			}
		}
		echo "<br />";
		
//////////////////////// FoRs		
		
		if(($row[5] != "")) { 
			echo $row[5]." (".$row[4].") "; }
		if(($row[7] != "")) { 
			echo "<br />".$row[7]." (".$row[6].") "; }
		if(($row[9] != "")) { 
			echo "<br />".$row[9]." (".$row[8].") "; }
		
//////////////////////// Q		
		
		if(($quartiles[0] != "")) {
			$q = count($quartiles);
			if($q > 0){
				for($v=0;$v<$q;$v++){					
					echo "<div class=\"ui-grid-a\">";
					echo "<div class=\"ui-block-a\" ";
					echo "style=\"color: #000000; ";
					echo "font-size: 0.9em; ";
					echo "text-align: right; ";
					echo "padding-right: 0.7em; ";
					echo "width: 20%;\">";
					echo "<strong>Q</strong>";
					echo "</div>";
					echo "<div class=\"ui-block-b\" ";
					echo "style=\"color: #000000; font-size: 0.9em;\">";
					echo ucwords(strtolower($qcats[$v]));
					echo "<br />(Quartile ";
					echo $quartiles[$v].", ".$qranks[$v];
					echo ")";
					echo "</div>";
					echo "</div>";
				}
			}
		}
		
//////////////////////// 5YRIF		
		
		if(($fiveyrif != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>5YR IF</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $fiveyrif;
			echo "</div>";
			echo "</div>";
		}
		
//////////////////////// IF
		
		if(($IFscore != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>IF</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $IFscore;
			echo "</div>";
			echo "</div>";
		}
		
//////////////////////// SNIP

		if(($snip != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>SNIP</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $snip;
			echo "</div>";
			echo "</div>";
		}		
		
//////////////////////// ABDC

		if(($ABDC != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>ABDC</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $ABDC;
			echo "</div>";
			echo "</div>";
		}		
		
//////////////////////// QA
		
		if(($OAccessImg != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>OA</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $OAccessImg;
			echo "</div>";
			echo "</div>";
		}	
		
//////////////////////// Library Links
		
		echo "<div class=\"ui-grid-b\" style=\"";
		echo "padding-top: 0.5em; ";
		echo "padding-bottom: 0.5em; ";
		echo "white-space: nowrap; ";
		echo "\">";

///////////// WSU		
		
		echo "<form action=\"";
		echo "http://ulrichsweb.serialssolutions.com/widget/search/\" ";
		echo "method=\"POST\" target=\"_UlrichSearch\" ";
		echo "style=\"";
		echo "margin-top: 0px; ";
		echo "margin-bottom: 0px; ";
		echo "padding: 0px; ";
		echo "padding-left: 0.9em; ";
		echo "\" />";
		echo "<a href=\"";
		echo "https://west-sydney-primo.hosted.exlibrisgroup.com/";
		echo "primo-explore/search?query=title,exact,";
		echo htmlentities($row[2]);
		echo ",AND&pfilter=pfilter,exact,journals,";
		echo "AND&tab=default_tab&search_scope=default_scope&";
		echo "vid=UWS-ALMA&lang=en_US&mode=advanced&offset=0&";
		echo "fn=search";
		echo "\" target=\"_LibrarySearch\" ";
		echo "style=\"";
		echo "margin:0px; ";
		echo "padding: 0px; ";
		echo "\">";
		echo "<img src=\"./assets/images/link_wsu.jpg\" height=\"30\" ";
		echo "border=\"0\" ";
		echo "style=\"";
		echo "margin-top: 0px; ";
		echo "margin-bottom: 0px; ";
		echo "padding: 0px; ";
		echo "padding-right: 0.3em; ";
		echo "border: 0px solid #222222; ";
		echo "\">";
		echo "</a> ";
		
///////////// Ulrichsweb		
		
		echo "<input type=\"hidden\" name=\"query\" value=\"";
		echo $row[10];
		if(($row[11] != "")) { echo " OR ".$row[11]; }
		if(($row[12] != "")) { echo " OR ".$row[12]; }
		echo"\">";
		echo "<input type=\"image\" ";
		echo "src=\"./assets/images/link_ulrichsweb.jpg\" ";
		echo "size=\"30\" alt=\"Search Ulrich Database\" ";
		echo "style=\"";
		echo "margin-top: 0px; ";
		echo "margin-bottom: 0px; ";
		echo "padding: 0px; ";
		echo "width: 30px; ";
		echo "padding-right: 0.3em; ";
		echo "border: 0px solid #222222; ";
		echo "\" /> ";
		
///////////// SJR		
		
		if(($row[33] != "")) {
			echo "<a href=\"http://www.scimagojr.com/journalsearch.php";
			echo "?q=".$row[33]."&tip=iss\" target=\"_SJRSearch\" ";
			echo "style=\"";
			echo "margin: 0px; ";
			echo "padding: 0px;\">";
			echo "<img src=\"./assets/images/link_sjr.jpg\" ";
			echo "height=\"30\" border=\"0\" style=\"";
			echo "margin-top: 0px; ";
			echo "margin-bottom: 0px; ";
			echo "padding: 0px; ";
			echo "padding-right: 0.3em; ";
			echo "border: 0px solid #222222; \">";
			echo "</a> ";
		}
		
///////////// Elsevier
		
		if(($row[32] != "")) {
			echo "<a href=\"";
			echo "http://www.elsevier.com/search-results?query=";
			$searchTitlePub = preg_replace("/\s\s/"," ","$row[2]");
			$searchTitlePub = preg_replace("/\s/","+","$row[2]");
			echo "$searchTitlePub";
			echo "&labels=journals";
			echo "\" target=\"_ElsevierSearch\" ";
			echo "style=\"";
			echo "margin: 0px; ";
			echo "padding: 0px; \">";
			echo "<img src=\"./assets/images/link_elsevier.png\" ";
			echo "height=\"30\" border=\"0\" style=\"";
			echo "margin-top: 0px; ";
			echo "margin-bottom: 0px; ";
			echo "padding: 0px; ";
			echo "padding-right: 0.3em; ";
			echo "border: 0px solid #222222; \">";
			echo "</a> ";
		}
		
///////////// Finish		
		
		echo "</form>";
		
///////////// Close		
		
		echo "</div>";
		
//////////////////////// Close Metrics List Item			
		
		echo "</p>";
		echo "</a>";
		echo "</li>";
		
//////////////////////// Finish Metrics		
		
	}
			
?>
		</ul>