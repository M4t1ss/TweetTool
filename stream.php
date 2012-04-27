<?php

if($_POST['submit_stream']) //ja piespiests sâkt vâkðanu
{
	//Apkopo iesûtîtos mainîgos
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$database = $_POST['database'];
	$keywords = $_POST['Keywords'];
	$time = $_POST['Time'];
	error_reporting(0);
	ignore_user_abort(true);
	set_time_limit($time);
	//nomaina datubâzes nosaukumu
	$db_name = strip_tags($_POST['database']);
	$config = MyConfig::read('includes/settings.php');
	$config['db_database'] = $db_name;
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
	echo "<script type=\"text/javascript\">setTimeout(\"window.location = '/<?php echo $tweettool_path; ?>/stats'\",2250);</script>";
	$contentLength = ob_get_length();
	header("Content-Length: $contentLength");
	header('Connection: close');
	ob_end_flush();
	ob_flush();
	flush();
	if (session_id()) session_write_close();
					
	//Uzsâk vâksanu
		$opts = array(
			'http'=>array(
				'method'	=>	"POST",
				'content'	=>	'track='.$keywords,
				)
		);

		$context = stream_context_create($opts);
		$skaititajs = 0;
		$klasteksts = "";
		while (1){
			$instream = fopen('https://'.$username.':'.$password.'@stream.twitter.com/1/statuses/filter.json','r' ,false, $context);
			while(! feof($instream)) {
				if(! ($line = stream_get_line($instream, 20000, "\n"))) {
					continue;
				}else{
					$remote = @mysql_connect($db_server, $db_user, $db_password);
					mysql_set_charset("utf8", $remote);
					mysql_select_db($db_database, $remote); 
					$tweet = json_decode($line);
					//Savâcam visu vajadzîgo par tvîtu
					$text = mysql_real_escape_string($tweet->{'text'});
					//Attîram tekstu
					$tt = explode(" ", $text);
					$text = "";
					for ($q = 0; $q < sizeof($tt); $q++){
						if (substr($tt[$q], 0, 1)=="@") $tt[$q] = "_@username";
						if (substr($tt[$q], 0, 1)=="#") $tt[$q] = "_@hashtag"; //vai tomçr ðitos neòemt nost?
						if (substr($tt[$q], 0, 4)=="http") $tt[$q] = "_@URL";
						$text.=$tt[$q];
						if ($q!=sizeof($tt)-1)$text.=" ";
					}
					//Lipina tvîtus kopâ, lîdz sakrâjas pietiekami daudz
					if ($skaititajs<50){
						$skaititajs++; $klasteksts.=$text." ";
					//Ja ir pietiekami daudz tvîtu, noskaidro tiem tçmu
					}else if($skaititajs==50){
						$skaititajs++;
						include("includes/functions.php");
						$klase = klasifice($klasteksts);
						$config = MyConfig::read('includes/settings.php');
						$config['theme'] = $klase;
						MyConfig::write('includes/settings.php', $config);
						$vaardi = vardi($klase);
					}
					$id = mysql_real_escape_string($tweet->{'id'});
					$geo = mysql_real_escape_string($tweet->{'place'}->{'name'});
					$in_reply = mysql_real_escape_string($tweet->{'in_reply_to_screen_name'});
					$source = mysql_real_escape_string($tweet->{'source'});
					$screen_name = mysql_real_escape_string($tweet->{'user'}->{'screen_name'});
					$profile_img = str_replace("_normal", "", mysql_real_escape_string($tweet->{'user'}->{'profile_image_url'}));
					$usrid = mysql_real_escape_string($tweet->{'user'}->{'id'});
					$usr_url = mysql_real_escape_string($tweet->{'user'}->{'url'});
					$usr_name = mysql_real_escape_string($tweet->{'user'}->{'name'});
					$usr_desc = mysql_real_escape_string($tweet->{'user'}->{'description'});
					$hash = $tweet->{'entities'}->{'hashtags'};
					$urls = $tweet->{'entities'}->{'urls'};
					$user_mentions = $tweet->{'entities'}->{'user_mentions'};
					//We store the new post in the database, to be able to read it later
					if ($text!="") {
					$ok_t = mysql_query("INSERT INTO tweets (id ,text ,screen_name, created_at, geo, in_reply_to_screen_name, source) VALUES ('$id', '$text', '$screen_name', NOW(), '$geo', '$in_reply', '$source')",$remote);
					$ok_u = mysql_query("INSERT INTO users (name, profile_image_url, id, url, screen_name, description) VALUES ('$usr_name', '$profile_img', '$usrid', '$usr_url', '$screen_name', '$usr_desc')",$remote);
					
					//Sadala tekstu tokenos un samet datu bâzç
					$tt = explode(" ", $text);
					for ($q = 0; $q < sizeof($tt); $q++){
						$ielikts = false;
						if ($tt[$q] != "_@username" && $tt[$q] != "_@hashtag" && $tt[$q] != "_@URL"){
							foreach ($vaardi as $vards) {
								if($tt[$q] == substr($vards,0,strlen($tt[$q]))) {
								///////////////////////////////////////////////////////////////////////////////////
								///Vienîgi ðeit vajag arî nâkamâs daïas ja nu kas.... bet lai pagaidâm ir (yawn)///
								///////////////////////////////////////////////////////////////////////////////////
									$ok_v = mysql_query("INSERT INTO tokens (tweet_id ,token) VALUES ('$id', '$vards')",$remote);
									$ielikts = true;
								}
							}
							$vaaa = $tt[$q];
							if(!$ielikts) $ok_v = mysql_query("INSERT INTO tokens (tweet_id,token) VALUES ('$id', '$vaaa')",$remote);
						}
					}
					//haðtagi
					if (sizeof($hash)>0) {
						for ($i = 0; $i < sizeof($hash); $i++){
							$hashtag = $hash[$i]->{'text'};
							$ok_h = mysql_query("INSERT INTO hashtags (text, tweet_id) VALUES ('$hashtag', '$id')",$remote);
						}
					}
					//saites
					if (sizeof($urls)>0) {
						for ($i = 0; $i < sizeof($urls); $i++){
							$url = $urls[$i]->{'expanded_url'};
							$display_url = $urls[$i]->{'display_url'};
							$ok_ur = mysql_query("INSERT INTO links (url, tweet_id, display_url) VALUES ('$url', '$id', '$display_url')",$remote);
						}
					}
					// pieminçtie lietotâji
					if (sizeof($user_mentions)>0) {
						for ($i = 0; $i < sizeof($user_mentions); $i++){
							$mention = $user_mentions[$i]->{'screen_name'};
							$ok_m = mysql_query("INSERT INTO mentions (screen_name, tweet_id) VALUES ('$mention', '$id')",$remote);
						}
					}
					}
					flush();
					mysql_close($remote);
				}
			}
		}
}else{
?>
<h2 style='margin:auto auto; text-align:center;'>Get tweets from the Twitter stream</h2>
<br/>
<form style="margin:auto auto; width:550px;" enctype="multipart/form-data" method="post" action="/<?php echo $tweettool_path; ?>/?id=stream">
<TABLE>
<TR>
   <TD class="in">Database name:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='database' placeholder="Database name" value="<?php echo $db_database; ?>" required autofocus/>
   </TD>
</TR>
<TR>
   <TD class="in">Twitter username:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='Username' placeholder="Username" value="<?php echo $tw_user;?>" required />
   </TD>
</TR>
<TR>
   <TD class="in">Twitter password:</TD>
   <TD class="in">
   <INPUT TYPE='password' size="52" NAME='Password' placeholder="Password" value="<?php echo $tw_pass;?>" required />
   </TD>
</TR>
<TR>
   <TD class="in">Keywords:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='Keywords' placeholder="Keywords seperated by commas" required />
   </TD>
</TR>
<TR>
   <TD class="in">How long to collect:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='Time' placeholder="Time in seconds" required />
   </TD>
</TR>
<TR>
   <TD class="in"></TD>
   <TD class="in"><INPUT style="float:left;" TYPE="submit" name="submit_stream" value="Start"/></TD> 
</TR>
</TABLE>
</form>
<?php
}
?>