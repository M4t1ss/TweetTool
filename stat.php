<h2 style='margin:auto auto; text-align:center;'>Tweet statistics</h2>
<br/>
<div style='margin:auto auto; width:500px;text-align:center;'>
<?php
//Tvītu kopskaits
$kopa = mysql_query("SELECT count( * ) skaits FROM tweets");
//Tvītu skaits, kuros norādīta atrašānās vieta
$geo = mysql_query("SELECT count( geo ) skaits FROM tweets where geo!=''");
//Tvītu skaits no Latvijas
$geolv = mysql_query("select count(text) skaits from tweets, vietas where vietas.nosaukums = tweets.geo and vietas.valsts = 'Latvia'");
//Dažādās atrašanās vietas
$geod = mysql_query("SELECT count( nosaukums ) skaits FROM vietas");
//Dažādās atrašanās valstis
$valst = mysql_query("SELECT count( distinct valsts ) skaits FROM vietas");
//Twitter lietotāju kopskaits
$scrnme = mysql_query("SELECT count( distinct screen_name ) skaits FROM tweets");

$r=mysql_fetch_array($kopa);
$tvkopa = $r["skaits"];
echo "Tweets all together - <b>".$tvkopa."</b>.<br/>";
$r=mysql_fetch_array($scrnme);
echo "Users all together - <b>".$r["skaits"]."</b>.<br/>";
$r=mysql_fetch_array($geo);
$atrviet = $r["skaits"];
echo "<b>".$atrviet."</b> - tweets with location data.<br/>";
$r=mysql_fetch_array($geolv);
$lv = $r["skaits"];
echo "<b>".$r["skaits"]."</b> - tweets with location data from Latvia.<br/>";
//Tvītu skaits no ārzemēm
$geonlv = $atrviet - $lv;
echo "<b>".$geonlv."</b> - tweets with location data from other countries.<br/>";
$r=mysql_fetch_array($geod);
$q=mysql_fetch_array($valst);
echo "All together there are <b>".$r["skaits"]."</b> different locations in <b>".$q["skaits"]."</b> countries.<br/>";
?>
</div>






<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	var chart2;
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
</script>

<script type="text/javascript">
  function drawVisualization() {
	// Create and populate the data table.
	var data = new google.visualization.DataTable();
	var raw_data = [['All tweets', <?php echo $tvkopa; ?>],
					['Tweets with location data', <?php echo $atrviet; ?>],
					['Tweets from Latvia', <?php echo $lv; ?>],
					['Tweets from other countries', <?php echo $geonlv; ?>]
					];
	var years = [''];
	var options = {'title':'Tweet stats',
				 'width':485,
				 'height':300,
				 'backgroundColor':'transparent',
				 };
	data.addColumn('string', 'Year');
	for (var i = 0; i  < raw_data.length; ++i) {
	  data.addColumn('number', raw_data[i][0]);    
	}
	data.addRows(years.length);
	for (var j = 0; j < years.length; ++j) {    
	  data.setValue(j, 0, years[j].toString());    
	}
	for (var i = 0; i  < raw_data.length; ++i) {
	  for (var j = 1; j  < raw_data[i].length; ++j) {
		data.setValue(j-1, i+1, raw_data[i][j]);    
	  }
	}
	new google.visualization.BarChart(document.getElementById('visualization')).
		draw(data,
			 {	title:"Tweet statistics",
				width:800, height:400,
				hAxis: {title: "Tweets"},
				backgroundColor:'white'
			  }
		);
  }
  google.setOnLoadCallback(drawVisualization);
</script>
<br/>
<div id="grafiks" style="text-align:center;">
    <div id="visualization"></div>
</div>
