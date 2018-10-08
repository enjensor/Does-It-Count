<?php
	define('MyConst', TRUE);
	include("./_header.php");

/////////////////////////////////////////////////////////// Start

?>
<!--
<div data-role="header" data-theme="a">
	<h1>Discplines</h1>
	<a href="./index.php" 
	   data-icon="back" 
	   data-iconpos="notext" 
	   data-direction="reverse">Home</a>
</div>
//-->
<div data-role="content">
	<div class="content-primary">
		<p style="text-align: center; margin-top: 0px;">
			<a href="./index.php" data-transition="fade" data-inline="true">
				<img src="./assets/images/library.jpg" width="100%" id="fieldsImage">
			</a>
		</p>
		<p class="blurb">To view the list of journals associated with a specific field, scroll through the research clusters, tap on the two-digit research group (for example, '14 Economics' under 'Economics and Commerce') and then tap on the four-digit research field. All clusters, groups and fields of research have been organised according to the latest Australia Research Council's Matrix.<br />&nbsp;</p>
		<ul class=\"mainList\" data-role="listview" data-theme="d" data-divider-theme="b">
<?php

		$query = "SELECT * FROM disciplinecluster ORDER BY DisciplineCluster ASC"; 
		$mysqli_result = mysqli_query($mysqli_link, $query);
		while($row = mysqli_fetch_row($mysqli_result)) { 
			echo "<li ";
            echo "class=\"collapseContainer\" ";
            echo "data-role=\"list-divider\" ";
            echo "class=\"ui-listview-outer\">";
            echo "$row[1]";
            echo "</li>\n";
			$queryD = "SELECT * FROM forname2 WHERE DisciplineClusterID = \"$row[2]\" ORDER BY FoRCode ASC"; 
			$mysqli_resultD = mysqli_query($mysqli_link, $queryD);
			while($rowD = mysqli_fetch_row($mysqli_resultD)) {
				echo "<li ";
				echo "class=\"collapseSpace\" ";
				echo "data-role=\"collapsible\" ";
            	echo "data-iconpos=\"right\" ";
                echo "data-shadow=\"false\" ";
            	echo "data-corners=\"false\">";
                echo "<h4>$rowD[0] $rowD[1]</h4>";
                echo "<ul class=\"collapseUL\" ";
                echo "data-role=\"listview\" ";
                echo "data-shadow=\"false\" ";
                echo "data-inset=\"false\" ";
                echo "data-corners=\"false\">";
				if(($rowD[0] != "MD")){
					$queryB = "SELECT * FROM forname4 WHERE DisciplineClusterID = \"$row[2]\" ";
					$queryB .= "AND FoRCode LIKE \"$rowD[0]%\" ORDER BY FoRCode ASC"; 
					$mysqli_resultB = mysqli_query($mysqli_link, $queryB);
					while($rowB = mysqli_fetch_row($mysqli_resultB)) {
						echo "<li ";
						echo "class=\"collapseItem\">";
						echo "<a href=\"_journals.php?FoRs=$rowB[0]\" ";
						echo "data-transition=\"fade\" ";
						echo "data-ajax=\"true\" ";
						echo ">";
						echo "$rowB[0] $rowB[1]";
						echo "</a>";
						echo "</li>";
					} 
				} else {
					echo "<li ";
					echo "class=\"collapseItem\">";
					echo "<a href=\"_journals.php?for=MD\" ";
					echo "data-transition=\"fade\" ";
					echo "data-ajax=\"true\" ";
					echo ">";
					echo "MD Multidisciplinary";
					echo "</a>";
					echo "</li>";
				}
                echo "</ul>";
				echo "</li>";
			}
		}
			
?>
		</ul>
		<p class="blurb">&nbsp;</p>
		<!-- 
		<p class="blurb" style="font-size: 0.8em;">
			<strong>Data Sources</strong><br />
			Ulrich's Periodicals Directory</br>
			The Australian Business Dean's Council List<br />
			Western Sydney University Library Databases<br />
			ARC ERA 2018 Journals List<br />
			ARC ERA 2018 Disciplinary Matrix<br />
			DOAJ Open Access Journal Metadata<br />
			Journal Metrics SNIP & SJR Historical Data<br />
			JCR Impact Factors & Citation Reports<br />
			JCR Impact Factors Excel SCI<br />
			SHERPA/RoMEO Publisher Copyright Policies<br />
			SCImago Journal and Country Rank<br />
			Scopus Journal Metrics 2017<br />
			Elsevier Database
		</p>
		//-->
	</div>
</div>
<?php

/////////////////////////////////////////////////////////// Finish

	include("_footer.php");

?>