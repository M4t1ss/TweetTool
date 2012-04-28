<h2 style='text-align:center;'>Tweet statistics</h2>
<script>
$(function() {
	setInterval(function() {
    $("#content").load(location.href+" #content>*","");
}, 1000);
});
$(function() {
	$(".meter > span").each(function() {
		$(this)
			.data("origWidth", $(this).width())
			.width(0)
			.animate({
				width: $(this).data("origWidth")
			}, 1200);
	});
});
</script>
<div id="content">
<p style='text-align:center;'>Progress:</p>
<div style='margin:auto auto; width:350px;' class="meter">
	<span style="width: 
	<?php 
	$proc=((time()-$config['start_time'])/($config['end_time']-$config['start_time'])*100);
	if($proc>100){echo 100;}else{echo $proc;} ?>%">
	</span>
</div>
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
</div>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	var chart2;
      google.load('visualization', '1.0', {'packages':['corechart']});
</script>