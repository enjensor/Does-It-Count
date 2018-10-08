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
/////////////////////////////////////////////////////////// Header
//
//	
//	session_start();
//	define('MyConst', TRUE);
//	include("./admin/config.php");
//	include("./admin/era.dbconnect.php");
//	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
//	header("Cache-Control: post-check=0, pre-check=0", false);
//	header("Pragma: no-cache");
//	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
//	
//////////////// GET Vars
//
//	$eraid = $_GET["eraid"];
//	$ISSNa = $_GET['ISSNa'];
//	$shortversion = $_GET['shortversion'];
//
//////////////// Vars
	
	$unixTime = "1537866000"; // 25 September 2018
	$context = stream_context_create(array('http' 
		=> array('header' => 'Accept: application/xml')));
	$contextTwo = stream_context_create(array('http' 
		=> array('header' => 'Accept: application/xml')));
	$url = "http://www.sherpa.ac.uk/romeo/api29.php?issn=".$ISSNa."&ak=AurhiRrRl5g";
	$urlTwo = "http://www.oaklist.qut.edu.au/api/basic?query=".$ISSNa;
	$fSherpa = "n";
	$fOaklist = "n";
	$data_page = "";
	$data_pageTwo = "";
	$doAPAIS_ERIH = "y";
	$apaisC = "";
	$apais = "No";
	$erih = "No";
	$erihD = "";
	$jTitle = "";
	$loaded = "";
	
//////////////// Check SHERPA data for pre-existing record

	if(($ISSNa != "")) {
		$query = "SELECT ";
		$query .= "* ";
		$query .= "FROM data_sherpa ";
		$query .= "WHERE ISSN = \"$ISSNa\" ";
		$query .= "AND Last_Updated > $unixTime";
		$mysqli_result = mysqli_query($mysqli_link, $query);
		while($row = mysqli_fetch_row($mysqli_result)) {
			$data_page = $row[2];
			$fSherpa = "y";
			$loaded = "Cached Version";	
			if(preg_match("/Archiving Policies/i",$data_page) && ($eraid != "")) {
				$queryB = "UPDATE ";
				$queryB .= "2017_journals_final_list ";
				$queryB .= "SET OpenAccess = \"Yes\" ";
				$queryB .= "WHERE ERAID = \"$eraid\" ";
				$mysqli_resultB = mysqli_query($mysqli_link, $queryB);
			}		
		}
		if($fSherpa != "y"){
			$query = "DELETE FROM ";
			$query .= "data_sherpa ";
			$query .= "WHERE ISSN = \"$ISSNa\" ";
			$query .= "AND Last_Updated < $unixTime";
			$mysqli_result = mysqli_query($mysqli_link, $query);
		}
	} else {

//		echo "<br />No Valid Data";
//		die();

	}
	
//////////////// Read SHERPA RoMEO XML Source
	
	if(($fSherpa != "y")) {
		$foundS = "";
		$xml = file_get_contents($url, false, $context);
		$sherpa = simplexml_load_string($xml);
		if(($sherpa) && ($ISSNa)) {
	
//////////////// Start SHERPA RoMEO capture

			ob_start();
			$fSherpa = $sherpa->publishers->publisher->preprints->prearchiving[0];
			if(($fSherpa != "")) {
				
//////////////// Header
				
				$foundS = "y";
				echo "<div id=\"srDisplay\">";
				
//////////////// Parse archiving policies
				
				echo "<p><strong>Archiving Policies</strong></p>";
				echo "<ul>";
				echo "<li>".ucwords($sherpa->publishers->publisher->preprints->prearchiving[0]);
				echo "archive pre-print</li>";
				echo "<li>".ucwords($sherpa->publishers->publisher->postprints->postarchiving[0]);
				echo "archive post-print</li>";
				echo "<li>".ucwords($sherpa->publishers->publisher->pdfversion->pdfarchiving[0]);
				echo "archive publisher version</li>";
				echo "</ul>";
	
//////////////// Parse archiving conditions
	
				$c = count($sherpa->publishers->publisher->conditions->condition);
				if(($c > 0)) {
					echo "<p><strong>Open Access Conditions</strong></p>";
					echo "<ul>";
					for($a=0;$a<$c;$a++) {
						if(($sherpa->publishers->publisher->conditions->condition[$a] != "") && ($sherpa->publishers->publisher->conditions->condition[$a] != " ")) {
							echo "<li>".$sherpa->publishers->publisher->conditions->condition[$a]."</li>";
						}
					}
					echo "</ul>";
					echo "</p>";
				}
		
//////////////// Parse copyright conditions

				$c = count($sherpa->publishers->publisher->copyrightlinks->copyrightlink);
				if(($c > 0)) {
					echo "<p><strong>Publisher Policies</strong></p>";
					echo "<ul>";
					for($a=0;$a<$c;$a++) {
						$cText = ucwords($sherpa->publishers->publisher->copyrightlinks->copyrightlink[$a]->copyrightlinktext[0]);
						if(($cText != "") && ($cText != " ")) {
							$cUrl = $sherpa->publishers->publisher->copyrightlinks->copyrightlink[$a]->copyrightlinkurl[0];
							echo "<li><a href=\"$cUrl\" target=\"_blank\">$cText</a></li>";
						}
					}
					echo "</ul>";
				}
				
//////////////// Close SHERPA RoMEO found record parse
				
				echo "</div>";
				$sherpaUpdate = "y";
			} else {
				echo "<div id=\"srDisplay\">";
				echo "<p><strong>No SHERPA/RoMEO Data</strong></p>";
				echo "</div>";
				$sherpaUpdate = "NO";
			}
			
//////////////// Finish SHERPA RoMEO capture
					
			$data_page = ob_get_contents();
			ob_end_clean();
			
//////////////// Update data tables

			if(($sherpaUpdate == "y") && ($eraid != "")) {
				$query = "UPDATE ";
				$query .= "2017_journals_final_list ";
				$query .= "SET OpenAccess = \"Yes\" ";
				$query .= "WHERE ERAID = \"$eraid\" ";
				$mysqli_result = mysqli_query($mysqli_link, $query);
			}

			if(($foundS == "y")) {
				$data_page = htmlentities($data_page, ENT_QUOTES,"UTF-8");
				$phptime = time() + (365 * 24 * 60 * 60);
				$query = "INSERT INTO ";
				$query .= "data_sherpa ";
				$query .= "VALUES (0, \"$ISSNa\", \"$data_page\", \"$phptime\") ";
				$mysqli_result = mysqli_query($mysqli_link, $query);
			}
		}
	}
	
//////////////// Get APAIS and ERIH data
	
	if(($ISSNa != "") && ($doAPAIS_ERIH == "y")) {
		$queryD = "SELECT ";
		$queryD .= "Coverage ";
		$queryD .= "FROM data_apais ";
		$queryD .= "WHERE ISSN = \"$ISSNa\" ";
		$mysqli_resultD = mysqli_query($mysqli_link, $queryD);		
		while($rowD = mysqli_fetch_row($mysqli_resultD)) { 
			$apais = "Yes";
			$apaisC = $rowD[0];
		}
		$queryD = "SELECT ";
		$queryD .= "Discipline, Category_2011 ";
		$queryD .= "FROM data_erih ";
		$queryD .= "WHERE ISSN = \"$ISSNa\" ";
		$queryD .= "AND Category_2011 != \"\" ";
		$mysqli_resultD = mysqli_query($mysqli_link, $queryD);		
		while($rowD = mysqli_fetch_row($mysqli_resultD)) {
			$erihD = $rowD[0]; 
			$erih = "Yes";
		}
	}

//////////////// Display SHERPA RoMEO
			
	$data_page = html_entity_decode($data_page,ENT_QUOTES,"UTF-8");	
	echo $data_page;
	
//////////////// Display APAIS and ERIH details
	
	echo "<div id=\"apaisDisplay\">";
	echo "<p><strong>Indexed by Australian Public Affairs Information Service</strong></p>";
	echo "<ul>";
	echo "<li>$apais";
	if(($apais == "Yes")) { 
		echo " ($apaisC)"; 
	}
	echo "</li>";
	echo "</ul>";
	echo "<p><strong>Indexed by European Reference Index for the Humanities</strong></p>";
	echo "<ul>";
	echo "<li>$erih";
	if(($erih == "Yes")) { 
		echo " ($erihD)"; 
	}
	echo "</li>";
	echo "</ul>";
	echo "</div>";

	if(($eraidF == "y") && ($fsnip == "y")) {
		echo "<div id=\"chartdivtitle\" style=\"";
		echo "padding: 0px; ";
		echo "font-size: 1.0em; ";
		echo "\">";
		echo "<p><strong>";
		echo "Elsevier &amp; Scopus Source Normalised Impact per Paper (SNIP), ";
		echo "Journal Performance in $mainFOR $mainName</strong>";
		echo "<br />&nbsp;<br />";
		
		echo "<span style=\"";
		echo "height: 1.0em; ";
		echo "width: 1.0em; ";
		echo "background-color: #b26966; ";
		echo "border-radius: 50%; ";
		echo "display: inline-block; ";
		echo "\">";	
		echo "</span>";
		echo "&nbsp;&nbsp;";
		echo "Annual SNIP in Journal<br />";
		
		echo "<span style=\"";
		echo "height: 1.0em; ";
		echo "width: 1.0em; ";
		echo "background-color: #000000; ";
		echo "border-radius: 50%; ";
		echo "display: inline-block; ";
		echo "\">";	
		echo "</span>";
		echo "&nbsp;&nbsp;";
		echo "Annual SNIP in Field of Research<br />";
		
		echo "<span style=\"";
		echo "height: 1.0em; ";
		echo "width: 1.0em; ";
		echo "background-color: #5faf99; ";
		echo "border-radius: 50%; ";
		echo "display: inline-block; ";
		echo "\">";	
		echo "</span>";
		echo "&nbsp;&nbsp;";
		echo "Annual SCImago Journal Rank (SJR)<br />";
		
		echo "<span style=\"";
		echo "height: 1.0em; ";
		echo "width: 1.0em; ";
		echo "background-color: #4158ac; ";
		echo "border-radius: 50%; ";
		echo "display: inline-block; ";
		echo "\">";	
		echo "</span>";
		echo "&nbsp;&nbsp;";
		echo "Annual Impact Per Publication (IPP)<br />&nbsp;";
		
		echo "</p>";
		echo "</div>";
	}

//////////////// Display Chart

	echo "<div id=\"chartdiv\" style=\"";
	echo "height: 400px; ";
	echo "width:100%; ";
	echo "padding: 0px; ";
	echo "border: 0px solid #aaaaaa; ";
	echo "\"></div>";
	echo "<br />&nbsp;<br />&nbsp;";

//////////////// Scripts

	if(($eraidF == "y") && ($fsnip == "y")) {
		
?>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/jquery.jqplot.min.js"></script>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/plugins/jqplot.highlighter.min.js"></script>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/plugins/jqplot.cursor.min.js"></script>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
	<script language="javascript" type="text/javascript" src="./assets/jqplot/plugins/jqplot.dateAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript">
	
		$(document).ready(function(){
			
			var line1=[
				['1999', <?php echo $snip[1999]; ?>], 
				['2000', <?php echo $snip[2000]; ?>], 
				['2001', <?php echo $snip[2001]; ?>], 
				['2002', <?php echo $snip[2002]; ?>],
				['2003', <?php echo $snip[2003]; ?>], 
				['2004', <?php echo $snip[2004]; ?>], 
				['2005', <?php echo $snip[2005]; ?>], 
				['2006', <?php echo $snip[2006]; ?>],
				['2007', <?php echo $snip[2007]; ?>], 
				['2008', <?php echo $snip[2008]; ?>], 
				['2009', <?php echo $snip[2009]; ?>], 
				['2010', <?php echo $snip[2010]; ?>],
				['2011', <?php echo $snip[2011]; ?>], 
				['2012', <?php echo $snip[2012]; ?>],
				['2013', <?php echo $snip[2013]; ?>],
				['2014', <?php echo $snip[2014]; ?>],
				['2015', <?php echo $snip[2015]; ?>],
				['2016', <?php echo $snip[2016]; ?>]
			];

			var line2 = [
				['1999', <?php echo $snipA[1999]; ?>], 
				['2000', <?php echo $snipA[2000]; ?>], 
				['2001', <?php echo $snipA[2001]; ?>], 
				['2002', <?php echo $snipA[2002]; ?>],
				['2003', <?php echo $snipA[2003]; ?>], 
				['2004', <?php echo $snipA[2004]; ?>], 
				['2005', <?php echo $snipA[2005]; ?>], 
				['2006', <?php echo $snipA[2006]; ?>],
				['2007', <?php echo $snipA[2007]; ?>], 
				['2008', <?php echo $snipA[2008]; ?>], 
				['2009', <?php echo $snipA[2009]; ?>], 
				['2010', <?php echo $snipA[2010]; ?>],
				['2011', <?php echo $snipA[2011]; ?>], 
				['2012', <?php echo $snipA[2012]; ?>],
				['2013', <?php echo $snipA[2013]; ?>],
				['2014', <?php echo $snipA[2014]; ?>],
				['2015', <?php echo $snipA[2015]; ?>],
				['2016', <?php echo $snipA[2016]; ?>]
			];	

			var line3=[
				['1999', <?php echo $sjr[1999]; ?>], 
				['2000', <?php echo $sjr[2000]; ?>], 
				['2001', <?php echo $sjr[2001]; ?>], 
				['2002', <?php echo $sjr[2002]; ?>],
				['2003', <?php echo $sjr[2003]; ?>], 
				['2004', <?php echo $sjr[2004]; ?>], 
				['2005', <?php echo $sjr[2005]; ?>], 
				['2006', <?php echo $sjr[2006]; ?>],
				['2007', <?php echo $sjr[2007]; ?>], 
				['2008', <?php echo $sjr[2008]; ?>], 
				['2009', <?php echo $sjr[2009]; ?>], 
				['2010', <?php echo $sjr[2010]; ?>],
				['2011', <?php echo $sjr[2011]; ?>], 
				['2012', <?php echo $sjr[2012]; ?>],
				['2013', <?php echo $sjr[2013]; ?>],
				['2014', <?php echo $sjr[2014]; ?>],
				['2015', <?php echo $sjr[2015]; ?>],
				['2016', <?php echo $sjr[2016]; ?>]
			];		

			var line4=[
				['1999', <?php echo $ipp[1999]; ?>], 
				['2000', <?php echo $ipp[2000]; ?>], 
				['2001', <?php echo $ipp[2001]; ?>], 
				['2002', <?php echo $ipp[2002]; ?>],
				['2003', <?php echo $ipp[2003]; ?>], 
				['2004', <?php echo $ipp[2004]; ?>], 
				['2005', <?php echo $ipp[2005]; ?>], 
				['2006', <?php echo $ipp[2006]; ?>],
				['2007', <?php echo $ipp[2007]; ?>], 
				['2008', <?php echo $ipp[2008]; ?>], 
				['2009', <?php echo $ipp[2009]; ?>], 
				['2010', <?php echo $ipp[2010]; ?>],
				['2011', <?php echo $ipp[2011]; ?>], 
				['2012', <?php echo $ipp[2012]; ?>],
				['2013', <?php echo $ipp[2013]; ?>],
				['2014', <?php echo $ipp[2014]; ?>],
				['2015', <?php echo $ipp[2015]; ?>],
				['2016', <?php echo $ipp[2016]; ?>]
			];		

			var plot1 = $.jqplot('chartdiv', [line1,line2,line3,line4], {
				 axes:{
					xaxis:{
						renderer:$.jqplot.DateAxisRenderer,
						tickOptions:{
							formatString:'%Y'
						},
						min:'1998', 
						max:'2017',
						tickInterval:'4 year',
						label:'Years',
						labelRenderer: $.jqplot.CanvasAxisLabelRenderer
					},
					yaxis:{
						renderer: $.jqplot.CategoryAxisRenderer,
						tickOptions:{
							formatString:'%.3f'
						},
						min:-1,
						tickInterval:'1',
						label:'Impact Factor',
						labelRenderer: $.jqplot.CanvasAxisLabelRenderer
					}
				},
				series: 
				[
					{
						label:'&nbsp;Annual SNIP in Journal&nbsp;',
						color: 'rgba(198,88,88,0.7)',
						rendererOptions: {
							smooth: true,
						},
						markerOptions: { 
							style:"filledCircle",
							color: 'rgba(198,88,88,0.7)',
							lineWidth: 2,
							size: 7
						}
					},
					{
						label:'&nbsp;Annual SNIP in FoR&nbsp;',
						color: 'rgba(64, 64, 64, 0.7)',
						rendererOptions: {
							smooth: true,
						},
						markerOptions: { 
							style:"filledCircle",
							color: 'rgba(64, 64, 64, 0.7)',
							lineWidth: 2,
							size: 7
						}
					},
					{
						label:'&nbsp;Annual SJR&nbsp;',
						color: 'rgba(44, 190, 160, 0.7)',
						rendererOptions: {
							smooth: true,
						},
						markerOptions: { 
							style:"filledCircle",
							color: 'rgba(44, 190, 160, 0.7)',
							lineWidth: 2,
							size: 7
						}
					},
					{
						label:'&nbsp;Annual IPP&nbsp;',
						color: 'rgba(45, 74, 190, 0.7)',
						rendererOptions: {
							smooth: true,
						},
						markerOptions: { 
							style:"filledCircle",
							color: 'rgba(45, 74, 190, 0.7)',
							lineWidth: 2,
							size: 7
						}
					}
				],
				legend: {
					show: false
					// placement: 'outside'
				},
				highlighter: {
					show: true,
					sizeAdjust: 18
				},
				cursor: {
					show: false
				}
			});	
		});
	
    </script>  
<?php	

	}

//////////////// End
//		
//	include("./admin/era.dbdisconnect.php");
//
//////////////// End
	
?>