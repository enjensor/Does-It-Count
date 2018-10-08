<?php
	define('MyConst', TRUE);
	include("./_view_header.php");

/////////////////////////////////////////////////////////// Routines

	if(($for4 != "")) {	
		$mainFOR = $for4; 
		$query = "SELECT `2010`, `2010w` ";
		$query .= "FROM 2012_citation_benchmarks ";
		$query .= "WHERE ForCode = \"$mainFOR\" ";
		$mysqli_result = mysqli_query($mysqli_link, $query);
		while($row = mysqli_fetch_row($mysqli_result)) {
			$citationBenchmark = "$row[0]";
			$citationBenchmarkw = "$row[1]";
		}
		$query = "SELECT FoRName4 ";
		$query .= "FROM forname4 ";
		$query .= "WHERE FoRCode = \"$mainFOR\" ";
		$mysqli_result = mysqli_query($mysqli_link, $query);
		while($row = mysqli_fetch_row($mysqli_result)) {
			$mainName = "$row[0]";
		}
	}
	if(($AmeanSnip == "")) { 
		$AmeanSnip = "0"; 
	}
	$eraidF = "";

/////////////////////////////////////////////////////////// Data

	$query = "SELECT * ";
	$query .= "FROM 2017_journals_final_list ";
	$query .= "WHERE ERAID = \"$eraid\" ";
	$mysqli_result = mysqli_query($mysqli_link, $query);
	while($row = mysqli_fetch_row($mysqli_result)) { 
		$snip = array();
		$sjr = array();
		$ipp = array();
		if(($mainFOR == "NA")) {
			$mainFOR = $row[4];
			$mainName = $row[5];
		}
		$apaisC = "";
		$apais = "No";
		$erih = "No";
		$erihD = "";
		$eraidF = "y";
		$pub = "";
		$country = "";
		$ISSNb = $row[10];
		$isbn0 = $row[10];
		$jTitle = $row[2];
		if(($fsnip == "y")) {
			$queryD = "SELECT ";
			$queryD .= "* ";
			$queryD .= "FROM 2017_data_snip_scopus ";
			$queryD .= "WHERE Print_ISSN = \"$row[10]\" ";
			if(($row[11] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[11]\" ";
				$isbn1 = $row[11];
			}
			if(($row[12] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[12]\" ";
				$isbn2 = $row[12];
			}
			if(($row[13] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[13]\" ";
				$isbn3 = $row[13];
			}
			if(($row[14] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[14]\" ";
				$isbn4 = $row[14];
			}
			if(($row[15] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[15]\" ";
				$isbn5 = $row[15];
			}
			if(($row[16] != "")) {
				$queryD = $queryD."OR Print_ISSN = \"$row[16]\" "; 
				$isbn6 = $row[16];
			}
			$queryD .= "ORDER BY ";
			$queryD .= "2014_SNIP DESC ";
			$queryD .= "LIMIT 1";
			$mysqli_resultD = mysqli_query($mysqli_link, $queryD);		
			while($rowD = mysqli_fetch_row($mysqli_resultD)) { 
				$ISSNa = $rowD[3];
				$Scopus_Source_ID = $rowD[1];
			
				for($j=8;$j<62;$j++) {
					$rowD[$j] = preg_replace("/[^0-9\.]/","","$rowD[$j]");
					if(($rowD[$j] == "")) {
						$rowD[$j] = "0";
					}
				}
				$snip[1999] = $rowD[8];
				$snip[2000] = $rowD[11];
				$snip[2001] = $rowD[14];
				$snip[2002] = $rowD[17];
				$snip[2003] = $rowD[20];
				$snip[2004] = $rowD[23];
				$snip[2005] = $rowD[26];
				$snip[2006] = $rowD[29];
				$snip[2007] = $rowD[32];
				$snip[2008] = $rowD[35];
				$snip[2009] = $rowD[38];
				$snip[2010] = $rowD[41];
				$snip[2011] = $rowD[44];
				$snip[2012] = $rowD[47];
				$snip[2013] = $rowD[50];
				$snip[2014] = $rowD[53];
				$snip[2015] = $rowD[56];
				$snip[2016] = $rowD[59];
				$queryE = "SELECT ";
				$queryE .= "SNIP_2015, SNIP_2016 ";
				$queryE .= "FROM ";
				$queryE .= "2017_journals_final_list ";
				$queryE .= "WHERE ";
				$queryE .= "Source_Record_ID = \"$Scopus_Source_ID\" ";
				$mysqli_resultE = mysqli_query($mysqli_link, $queryE);		
				while($rowE = mysqli_fetch_row($mysqli_resultE)) { 
					$snip[2015] = $rowE[0];
					$snip[2016] = $rowE[1];
				}
				$ipp[1999] = $rowD[9];
				$ipp[2000] = $rowD[12];
				$ipp[2001] = $rowD[15];
				$ipp[2002] = $rowD[18];
				$ipp[2003] = $rowD[21];
				$ipp[2004] = $rowD[24];
				$ipp[2005] = $rowD[27];
				$ipp[2006] = $rowD[30];
				$ipp[2007] = $rowD[33];
				$ipp[2008] = $rowD[36];
				$ipp[2009] = $rowD[39];
				$ipp[2010] = $rowD[42];
				$ipp[2011] = $rowD[45];
				$ipp[2012] = $rowD[48];
				$ipp[2013] = $rowD[51];
				$ipp[2014] = $rowD[54];
				$ipp[2015] = $rowD[57];
				$ipp[2016] = $rowD[60];
				$sjr[1999] = $rowD[10];
				$sjr[2000] = $rowD[13];
				$sjr[2001] = $rowD[16];
				$sjr[2002] = $rowD[19];
				$sjr[2003] = $rowD[22];
				$sjr[2004] = $rowD[25];
				$sjr[2005] = $rowD[28];
				$sjr[2006] = $rowD[31];
				$sjr[2007] = $rowD[34];
				$sjr[2008] = $rowD[37];
				$sjr[2009] = $rowD[40];
				$sjr[2010] = $rowD[43];
				$sjr[2011] = $rowD[46];
				$sjr[2012] = $rowD[49];
				$sjr[2013] = $rowD[52];
				$sjr[2014] = $rowD[55];
				$sjr[2015] = $rowD[58];
				$sjr[2016] = $rowD[61];
				$pub = $rowD[5];
				$country = $rowD[7];
			}
		} else {
			$pub = "Not Specified";
			$country = "Not Specified";
		}
		
/////////////////////////////////////////////////////////// SNIP
		
		if(($doARC != "y")) {
			for($x=1999;$x<2017; $x++) {
				$snipA[$x] = "0";
				$query = "SELECT ";
				$query .= "(SUM(".$x."_SNIP) / COUNT(".$x."_SNIP)) ";
				$query .= "AS AverageSnip ";
				$query .= "FROM 2017_journals_snips ";
				$query .= "WHERE (FoR1 = \"$mainFOR\" ";
				$query .= "OR FoR2 = \"$mainFOR\" ";
				$query .= "OR FoR3 = \"$mainFOR\") ";
				$query .= "AND ".$x."_SNIP != \"\" ";
				$query .= "AND ".$x."_SNIP IS NOT NULL ";
				$mysqli_result = mysqli_query($mysqli_link, $query);
				while($row = mysqli_fetch_row($mysqli_result)) {
					$snipA[$x] = $row[0];
					$snipA[$x] = number_format($snipA[$x],3);
				}
			}
		}
		
/////////////////////////////////////////////////////////// APAIS
		
		if(($doAPAIS_ERIH == "y")) {
			$queryD = "SELECT ";
			$queryD .= "Coverage ";
			$queryD .= "FROM data_apais ";
			$queryD .= "WHERE ISSN = \"$row[10]\" ";
			if(($row[11] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[11]\" ";
			}
			if(($row[12] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[12]\" ";
			}
			if(($row[13] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[13]\" ";
			}
			if(($row[14] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[14]\" ";
			}
			if(($row[15] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[15]\" ";
			}
			if(($row[16] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[16]\" "; 
			}
			$mysqli_resultD = mysqli_query($mysqli_link, $queryD);		
			while($rowD = mysqli_fetch_row($mysqli_resultD)) { 
				$apais = "Yes";
				$apaisC = $rowD[0];
			}
		
/////////////////////////////////////////////////////////// ERIH

			$queryD = "SELECT ";
			$queryD .= "Discipline, Category_2011 ";
			$queryD .= "FROM data_erih ";
			$queryD .= "WHERE ( ISSN = \"$row[10]\" ";
			if(($row[11] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[11]\" ";
			}
			if(($row[12] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[12]\" ";
			}
			if(($row[13] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[13]\" ";
			}
			if(($row[14] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[14]\" ";
			}
			if(($row[15] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[15]\" ";
			}
			if(($row[16] != "")) {
				$queryD = $queryD."OR ISSN = \"$row[16]\" "; 
			}
			$queryD = $queryD.") AND Category_2011 != \"\" ";
			$mysqli_resultD = mysqli_query($mysqli_link, $queryD);		
			while($rowD = mysqli_fetch_row($mysqli_resultD)) {
				$erihD = $rowD[0]; 
				$erih = "Yes";
			}
		}
	}

/////////////////////////////////////////////////////////// Start

?>
	<div data-role="page" data-overlay-theme="a" id="journalDetail">
		<div data-role="header" data-id="foo1" data-theme="b">
			<div data-role="navbar">
				<ul>
					<li id="home"><a href="./index.php" data-transition="fade" data-inline="true"><i class="fas fa-home"></i></a></li> 
					<li id="browse"><a href="_browse.php" data-transition="fade" data-inline="true"><i class="far fa-list-alt"></i></a></li>
				</ul>
			</div>
		</div>
		<!-- <div data-role="header" data-theme="c">
			<h2>Detail</h2>
			<a href="#" 
			   data-icon="back" 
			   data-rel="back" 
			   data-iconpos="notext" 
			   data-direction="reverse">Browse</a>
		</div> //-->
		<div data-role="content" data-theme="c" style="font-size: 0.9em !important;">
<?php
			
///////////////////////////// Journal Publications Details			
			
		echo "<div class=\"ui-grid-a\">";
		echo "<div class=\"ui-block-a\" ";
		echo "style=\"color: #000000; ";
		echo "font-size: 0.9em; ";
		echo "text-align: right; ";
		echo "padding-right: 0.7em; ";
		echo "width: 20%;\">";
		echo "<strong>&nbsp;</strong>";
		echo "</div>";
		echo "<div class=\"ui-block-b\" ";
		echo "style=\"color: #000000; font-size: 0.9em;\">";
		echo "<h2>$jTitle</h2>";
		echo "</div>";
		echo "</div>";
			
		if(($pub != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>Pub</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $pub;
			echo "</div>";
			echo "</div>";
		}			
		
		if(($country != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>Country</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo $country;
			echo "</div>";
			echo "</div>";
		}
			
		if(($isbn0 != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>ISSN(S)</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo "$isbn0 $isbn1 $isbn2 ";
			echo "$isbn3 $isbn4 $isbn5 $isbn6";
			echo "</div>";
			echo "</div>";
		}	
			
		if(($mainFOR != "")) {
			echo "<div class=\"ui-grid-a\">";
			echo "<div class=\"ui-block-a\" ";
			echo "style=\"color: #000000; ";
			echo "font-size: 0.9em; ";
			echo "text-align: right; ";
			echo "padding-right: 0.7em; ";
			echo "width: 20%;\">";
			echo "<strong>FoR</strong>";
			echo "</div>";
			echo "<div class=\"ui-block-b\" ";
			echo "style=\"color: #000000; font-size: 0.9em;\">";
			echo "$mainFOR $mainName";
			echo "</div>";
			echo "</div>";
		}

		echo "<div class=\"ui-grid-a\">";
		echo "<div class=\"ui-block-a\" ";
		echo "style=\"color: #000000; ";
		echo "font-size: 0.9em; ";
		echo "text-align: right; ";
		echo "padding-right: 0.7em; ";
		echo "width: 20%;\">";
		echo "<strong>&nbsp;</strong>";
		echo "</div>";
		echo "<div class=\"ui-block-b\" ";
		echo "style=\"color: #000000; font-size: 0.9em;\">";
		echo "&nbsp;<br /><a href=\"#\" data-rel=\"back\" ";
		echo "style=\"text-decoration: none; color: #800000; \">";
		echo "Back to Results List</a>";
		echo "</div>";
		echo "</div>";

///////////////////////////// Open Access Information			
			
		include("_sherpa.php");

///////////////////////////// CLose
			
?>
		</div>
	</div>
<?php

/////////////////////////////////////////////////////////// Finish

	include("./_view_footer.php");

?>