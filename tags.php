<?php
include 'includes/tag/classes/wordcloud.class.php';
?>
<h2 style='margin:auto auto; text-align:center;'>Tag cloud</h2><br/>
<div>
<?php
$vardi = mysql_query("SELECT id, tweet_id, hashtags.text FROM hashtags, tweets where tweets.id = hashtags.tweet_id");

$cloud = new wordCloud();
//jāuztaisa vēl, lai, uzklikojot uz kādu ēdienu, atvērtu visus tvītus, kas to pieminējuši...
while($r=mysql_fetch_array($vardi)){
	$nom = $r["text"];
	$cloud->addWord(array('word' => $nom, 'url' => 'tag/'.urlencode($nom)));
}
$myCloud = $cloud->showCloud('array');
foreach ($myCloud as $cloudArray) {
  echo ' &nbsp; <a href="'.$cloudArray['url'].'" class="word size'.$cloudArray['range'].'">'.$cloudArray['word'].'</a> &nbsp;';
}
?>
</div>