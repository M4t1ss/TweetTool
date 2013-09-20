<?php

if($_POST['submit_stream']) //ja piespiests sâkt vâkðanu
{
require_once('includes/twitteroauth/twitteroauth.php');
require_once('includes/Phirehose.php');
require_once('includes/OauthPhirehose.php');
	//twitter autentificçðanâs dati
	define("TWITTER_CONSUMER_KEY", $conskey);
	define("TWITTER_CONSUMER_SECRET", $conssecret);
	define("CONSUMER_KEY", $conskey);
	define("CONSUMER_SECRET", $conssecret);
	define("OAUTH_TOKEN", $oauthtoken);
	define("OAUTH_SECRET", $oauthsecret);
	//Apkopo iesûtîtos mainîgos
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$database = $_POST['database'];
	$keywords = $_POST['Keywords'];
	$seconds = $_POST['Seconds'];
	$minutes = $_POST['Minutes'];
	$hours = $_POST['Hours'];
	$days = $_POST['Days'];
	$time = $seconds+$minutes*60+$hours*3600+$days*86400+time();
	$db_table_prefix=str_replace(" ","",str_replace(",","_",$keywords))."_".time();
	error_reporting(0);
	ignore_user_abort(true);
	set_time_limit($time-time());
	//Kills previous process if any
	//include('kill.php');
	//nomaina datubâzes nosaukumu
	$db_name = strip_tags($_POST['database']);
	$config = MyConfig::read('includes/settings.php');
	$config['db_database'] = $db_name;
	$config['start_time'] = time();
	$config['end_time'] = $time;
	$config['keywords'] = $keywords;
	$config['pid'] = getmypid(); 
	MyConfig::write('includes/settings.php', $config);
	//aizver esoðo pieslçgumu DB
	mysql_close($connection);
	//pieslçdzamies jaunajai DB un izveido tabulu
	$config = MyConfig::read('includes/settings.php');
	$db_server = $config['db_server'];
	$db_user = $config['db_user'];
	$db_password = $config['db_password'];
	$db_database = $config['db_database'];
	$connection = @mysql_connect($db_server, $db_user, $db_password);
	mysql_set_charset("utf8", $connection);
	mysql_select_db($db_database);

   //izdzçð tvîtu tabulu, ja tâda ir, un izveido jaunu
	$file_content = file("includes/table.sql");
	$query = "";
	foreach($file_content as $sql_line){
	  if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
		$query .= $sql_line;
		if (substr(rtrim($query), -1) == ';'){
		  $result = mysql_query($query)or die(mysql_error());
		  $query = "";
		}
	  }
	 }
	//Paziòo par notiekoðo
	echo "<br/>Collecting of tweets has begun! Results will start appearing shortly";
	echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/stats'\",2250);</script>";
	$contentLength = ob_get_length();
	header("Content-Length: $contentLength");
	header('Connection: close');
	ob_end_flush();
	ob_flush();
	flush();
	if (session_id()) session_write_close();

class FilterTrackConsumer extends OauthPhirehose
{
  public function enqueueStatus($status)
  {
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) {
		//kas notiek ar tvitu
		//	print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "<br/>";
	$config = MyConfig::read('includes/settings.php');
	$db_server = $config['db_server'];
	$db_user = $config['db_user'];
	$db_password = $config['db_password'];
	$db_database = $config['db_database'];
		$remote = @mysql_connect($db_server, $db_user, $db_password);
		mysql_set_charset("utf8", $remote);
		mysql_select_db($db_database, $remote); 
		
		//Attîra datus
		$id = mysql_real_escape_string($data['id']);
		$geo = mysql_real_escape_string($data['place']['name']);
		$text = mysql_real_escape_string($data['text']);
		echo $text."<br/>";
		$screen_name = mysql_real_escape_string($data['user']['screen_name']);
		$user_mentions = $data['entities']['user_mentions'];
			$in_reply = mysql_real_escape_string($data['in_reply_to_screen_name']);
			$source = mysql_real_escape_string($data['source']);
			$screen_name = mysql_real_escape_string($data['user']['screen_name']);
			$profile_img = str_replace("_normal", "", mysql_real_escape_string($data['user']['profile_image_url']));
			$usrid = mysql_real_escape_string($data['user']['id']);
			$usr_url = mysql_real_escape_string($data['user']['url']);
			$usr_name = mysql_real_escape_string($data['user']['name']);
			$usr_desc = mysql_real_escape_string($data['user']['description']);
			$hash = $data['entities']['hashtags'];
			$urls = $data['entities']['urls'];
			$user_mentions = $data['entities']['user_mentions'];
				if ($text!="") {
					$ok_t = mysql_query("INSERT INTO tweets (id ,text ,screen_name, created_at, geo, in_reply_to_screen_name, source) VALUES ('$id', '$text', '$screen_name', NOW(), '$geo', '$in_reply', '$source')",$remote);
					$ok_u = mysql_query("INSERT INTO users (name, profile_image_url, id, url, screen_name, description) VALUES ('$usr_name', '$profile_img', '$usrid', '$usr_url', '$screen_name', '$usr_desc')",$remote);
					
					//Sadala tekstu tokenos un samet datu bâzç
					$tt = explode(" ", $text);
					for ($q = 0; $q < sizeof($tt); $q++){
						//izvâc pieturzîmes
						$tt[$q] = str_replace("?","",$tt[$q]);
						$tt[$q] = str_replace("!","",$tt[$q]);
						$tt[$q] = str_replace(",","",$tt[$q]);
						$tt[$q] = str_replace(".","",$tt[$q]);
						$tt[$q] = str_replace(";","",$tt[$q]);
						$tt[$q] = str_replace(":","",$tt[$q]);
						$tt[$q] = str_replace("{","",$tt[$q]);
						$tt[$q] = str_replace("}","",$tt[$q]);
						$tt[$q] = str_replace("[","",$tt[$q]);
						$tt[$q] = str_replace("]","",$tt[$q]);
						$tt[$q] = str_replace("<","",$tt[$q]);
						$tt[$q] = str_replace(">","",$tt[$q]);
						$tt[$q] = str_replace("/","",$tt[$q]);
						$tt[$q] = str_replace("\\","",$tt[$q]);
						if ($tt[$q] != "_@username" && $tt[$q] != "_@hashtag" && $tt[$q] != "_@URL" && $tt[$q] != "RT" && strlen($tt[$q]) > 1 && !is_numeric($tt[$q])){
							$vaaa = $tt[$q];
							$ok_v = mysql_query("INSERT INTO tokens (tweet_id,token) VALUES ('$id', '$vaaa')",$remote);
						}
					}
					//haðtagi
					if (sizeof($hash)>0) {
						for ($i = 0; $i < sizeof($hash); $i++){
							$hashtag = $hash[$i]['text'];
							$ok_h = mysql_query("INSERT INTO hashtags (text, tweet_id) VALUES ('$hashtag', '$id')",$remote);
						}
					}
					//saites
					if (sizeof($urls)>0) {
						for ($i = 0; $i < sizeof($urls); $i++){
							$url = $urls[$i]['expanded_url'];
							$display_url = $urls[$i]['display_url'];
							$ok_ur = mysql_query("INSERT INTO links (url, tweet_id, display_url) VALUES ('$url', '$id', '$display_url')",$remote);
						}
					}
					// pieminçtie lietotâji
					if (sizeof($user_mentions)>0) {
						for ($i = 0; $i < sizeof($user_mentions); $i++){
							$mention = $user_mentions[$i]['screen_name'];
							$ok_m = mysql_query("INSERT INTO mentions (screen_name, tweet_id) VALUES ('$mention', '$id')",$remote);
						}
					}
				}
		}
    }
  }
	
	while (time()<$time){
		// Start streaming
		$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
		$sc->setTrack(array($keywords));
		$sc->consume();
	}
}else{
?>
<h2 style='margin:auto auto; text-align:center;'>Get tweets from the Twitter stream</h2>
<br/>
<form style="margin:auto auto; width:550px;" enctype="multipart/form-data" method="post" action="<?php echo $tweettool_path; ?>?id=stream">
<TABLE>
   <INPUT TYPE='hidden' size="52" NAME='database' value="<?php echo $db_database; ?>"/>
   <INPUT TYPE='hidden' size="52" NAME='Username' value="<?php echo $tw_user;?>"/>
   <INPUT TYPE='hidden' size="52" NAME='Password' value="<?php echo $tw_pass;?>"/>
<TR>
   <TD>Keywords:</TD>
   <TD>
   <INPUT TYPE='text' size="52" NAME='Keywords' placeholder="Keywords seperated by commas" required />
   </TD>
</TR>
<!--
<TR>
   <TD>Users:</TD>
   <TD>
   <INPUT TYPE='text' size="52" NAME='Users' placeholder="Users to follow" />
   </TD>
</TR>
-->
<TR>
   <TD>How long to collect:</TD>
   <TD>
   <INPUT TYPE='text' size="7" NAME='Days' placeholder="Days"  />
   <INPUT TYPE='text' size="7" NAME='Hours' placeholder="Hours" />
   <INPUT TYPE='text' size="8" NAME='Minutes' placeholder="Minutes" />
   <INPUT TYPE='text' size="8" NAME='Seconds' placeholder="Seconds" required/>
   </TD>
</TR>
<TR>
   <TD></TD>
   <TD><INPUT style="float:left;" TYPE="submit" name="submit_stream" value="Start"/></TD> 
</TR>
</TABLE>
</form>
<?php
}

?>