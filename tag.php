<?php
$vards=urldecode($_GET['vards']);
$vardi = mysql_query("SELECT tweet_id FROM hashtags where text = '$vards'");
if(mysql_num_rows($vardi)==0){
	echo "The database is empty!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/home'\",1250);</script>";
}else{
?>
<div style='text-align:center;margin:auto auto;'>
<h2>#<?php echo $vards; ?></h2>
	<div style="padding:5px;" id="content">Loading...</div>
</div>
<!-- attēls no google image search -->
<script src="https://www.google.com/jsapi?key=ABQIAAAAwNLfFSirmOLKkKGBImYROhR-aFOkHTCPd8GmiU2WFD4CBmb8xhT4K2zPKmh7e3lAi4XgaludyidIAw" type="text/javascript"></script>
<script type="text/javascript">
google.load('search', '1');
function searchComplete(searcher) {
  if (searcher.results && searcher.results.length > 0) {
	var contentDiv = document.getElementById('content');
	contentDiv.innerHTML = '';
	var results = searcher.results;
	  var result = results[0];
	  var imgContainer = document.createElement('div');
	  var newImg = document.createElement('img');
	  newImg.src = result.tbUrl;
	  imgContainer.appendChild(newImg);
	  contentDiv.appendChild(imgContainer);
  }
}
function OnLoad() {
  var imageSearch = new google.search.ImageSearch();
  imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_IMAGESIZE,
							 google.search.ImageSearch.IMAGESIZE_MEDIUM);
  imageSearch.setSearchCompleteCallback(this, searchComplete, [imageSearch]);
  imageSearch.execute("<?php echo $vards;?>");
}
google.setOnLoadCallback(OnLoad);
</script>
<div>
<?php
$krasa=TRUE;
echo "<table id='results' style='margin:auto auto;'>";
echo "<tr>
<th>User</th>
<th>Tweet</th>
</tr>";
while($r=mysql_fetch_array($vardi)){
	$tvits = $r["tweet_id"];
	$tviti = mysql_query("SELECT screen_name, text FROM tweets where id = '$tvits'");
	while($p=mysql_fetch_array($tviti)){
		$niks = $p["screen_name"];
		$teksts = $p["text"];
		if ($krasa==TRUE) {$kr=" class='even'";}else{$kr="";}
		echo '<tr'.$kr.'><td><b><a style="text-decoration:none;color:#658304;" href="/TwitEdiens/draugs/'.$niks.'">'.$niks.'</a></b></td><td>'.$teksts.'</td></tr>';
		$krasa=!$krasa;
	}
}
echo "</table>";
}
?>
</div>