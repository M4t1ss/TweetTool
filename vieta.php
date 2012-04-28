<?php
$vards=urldecode($_GET['vieta']);
?>
<h2 style='margin:auto auto; text-align:center;'><?php echo $vards; ?></h2>
<br/>
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
<div style="margin:auto auto; width:100px;">
	<div style="padding:5px;" id="content">Ielādē...</div> 
</div>
<div >
<?php
//Pieslēgums DB
$tviti = mysql_query("SELECT screen_name, text FROM tweets where geo = '$vards'");
if(mysql_num_rows($tviti)==0){
	echo "The database is empty!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/home'\",1250);</script>";
}else{

$krasa=TRUE;
echo "<table id='results' style='margin:auto auto;'>";
echo "<tr>
<th>User</th>
<th>Tweet</th>
</tr>";
while($p=mysql_fetch_array($tviti)){
	$niks = $p["screen_name"];
	$teksts = $p["text"];
	if ($krasa==TRUE) {$kr=" class='even'";}else{$kr="";}
	echo '<tr'.$kr.'><td><b><a style="text-decoration:none;color:#207DAC;" href="<?php echo $tweettool_path; ?>draugs/'.$niks.'">'.$niks.'</a></b></td><td>'.$teksts.'</td></tr>';
	$krasa=!$krasa;
}
echo "</table>";
}
?>
</div>