<?php
include 'includes/tag/classes/wordcloud.class.php';
?>
<h2 style='margin:auto auto; text-align:center;'>Mentioned users</h2><br/>
<script>
$(function() {
    $("#content").load(location.href+" #content>*","");
	setInterval(function() {
    $("#content").load(location.href+" #content>*","");
}, 5000);
});
</script>
<div id="content" style="margin:auto auto;width:80%;word-wrap: break-word;">
<?php
$vardi = mysql_query("SELECT id, tweet_id, mentions.screen_name FROM mentions, tweets where tweets.id = mentions.tweet_id");
if(mysql_num_rows($vardi)==0){
	echo "The database is empty!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/home'\",1250);</script>";
}else{
	$cloud = new wordCloud();
	//jāuztaisa vēl, lai, uzklikojot uz kādu ēdienu, atvērtu visus tvītus, kas to pieminējuši...
	while($r=mysql_fetch_array($vardi)){
		$nom = $r["screen_name"];
		$cloud->addWord(array('word' => $nom, 'url' => 'user/'.urlencode($nom)));
	}
	$cloud->orderBy('size', 'desc');
	$myCloud = $cloud->showCloud('array');
	foreach ($myCloud as $cloudArray) {
	  echo ' &nbsp; <a href="'.$cloudArray['url'].'" class="word size'.$cloudArray['range'].'">@'.$cloudArray['word'].'</a> &nbsp;';
	}
}
?>
</div>