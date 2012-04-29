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
$(function () {
	// we use an inline data source in the example, usually data would
	// be fetched from a server
	var data = [], totalPoints = 300;
	function getRandomData() {
		if (data.length > 0)
			data = data.slice(1);
		// do a random walk
		while (data.length < totalPoints) {
		var Q;
			$.get("<?php echo $tweettool_path; ?>includes/count.php", function(rezultats) {
				$('#stage').html(rezultats);
			});
			Q = document.getElementById("stage");
			var y = parseInt(Q.innerHTML);
			data.push(y);
		}
		// zip the generated y values with the x values
		var res = [];
		for (var i = 0; i < data.length; ++i)
			res.push([i, data[i]])
		return res;
	}
	// setup control widget
	var updateInterval = 50;
	// setup plot
	var options = {
		series: { shadowSize: 0 }, // drawing is faster without shadows
		yaxis: { min: 0, max: 100 },
		xaxis: { show: false }
	};
	var plot = $.plot($("#placeholder"), [ getRandomData() ], options);
	function update() {
		plot.setData([ getRandomData() ]);
		// since the axes don't change, we don't need to call plot.setupGrid()
		plot.draw();
		setTimeout(update, updateInterval);
	}
	update();
});
</script>
<div style="margin:auto auto;width:980px;">
<p style="font-weight:bold; padding-left:30px;">Tweet count in the last 30 seconds (<span id="stage">0</span>):</p>
<div class="tweet" style="width:420px;height:150px; margin-left:25px;background-color:rgba(255, 255, 255,0.7);">
<div id="placeholder" style="width:420px;height:150px;"></div>
</div>
<div id="content">
<div style="float:left; padding-left:30px;">
<p style="font-weight:bold; width:430px;">Progress:</p>
<div style='width:395px;margin-top:-10px;' class="meter">
	<span style="width: 
	<?php 
	$proc=((time()-$config['start_time'])/($config['end_time']-$config['start_time'])*100);
	if($proc>100){echo 100;}else{echo $proc;} ?>%">
	</span>
</div>
<div style='width:430px;'>
<div class="tweet" style='background-color:rgba(255, 255, 255,0.7);color:black;margin-left:0px;'>
<?php
//Latest 10 tweets
$latest = mysql_query("SELECT * FROM tweets ORDER BY created_at DESC limit 0, 10");
//All tweets
$kopa = mysql_query("SELECT count( * ) skaits FROM tweets");
//Tweets with location data
$geo = mysql_query("SELECT count( geo ) skaits FROM tweets where geo!=''");
//Locations
$geod = mysql_query("SELECT count( nosaukums ) skaits FROM vietas");
//Countries
$valst = mysql_query("SELECT count( distinct valsts ) skaits FROM vietas");
//Tweet authors
$scrnme = mysql_query("SELECT count( distinct screen_name ) skaits FROM tweets");
//Hashtags
$hash = mysql_query("SELECT count( * ) skaits FROM hashtags");
//Mentioned users
$ment = mysql_query("SELECT count( * ) skaits FROM mentions");
//Links
$link = mysql_query("SELECT count( * ) skaits FROM links");

$r=mysql_fetch_array($kopa);
$tvkopa = $r["skaits"];
echo "Tweets all together - <b>".$tvkopa."</b>.<br/>";
$r=mysql_fetch_array($scrnme);
echo "Tweet authors - <b>".$r["skaits"]."</b>.<br/>";
$r=mysql_fetch_array($geo);
$atrviet = $r["skaits"];
echo "<b>".$atrviet."</b> - tweets with location data.<br/>";
$r=mysql_fetch_array($geod);
$q=mysql_fetch_array($valst);
echo "All together there are <b>".$r["skaits"]."</b> different locations in <b>".$q["skaits"]."</b> countries.<br/>";
$r=mysql_fetch_array($hash);
$lv = $r["skaits"];
echo "There are <b>".$r["skaits"]."</b> hashtags in the tweets.<br/>";
$r=mysql_fetch_array($ment);
$lv = $r["skaits"];
echo "There are <b>".$r["skaits"]."</b> users mentioned in the tweets.<br/>";
$r=mysql_fetch_array($link);
$lv = $r["skaits"];
echo "There are <b>".$r["skaits"]."</b> links in the tweets.<br/>";
?>
</div>
</div>
</div>
<div style='margin-top:-230px;float:left;width:500px;'>
<p style="text-align:left;font-weight:bold;">Tweet stream:</p>
<?php
while($p=mysql_fetch_array($latest)){
	$username = $p["screen_name"];
	$text = $p["text"];
	$ttime = $p["created_at"];
	$via = $p["source"];
?>
<div class="tweet">
<div style="color:white;font-weight:bold; font-size:0.7em; border-bottom:1px dashed black;padding:4px;"><?php echo "@".$username;?> via <?php echo $via;?> ( <?php echo $ttime;?> )</div>
<?php echo $text;?><br/>
</div>
<?php
}
?>
</div>
</div>
</div>