<?php

if($_POST['submit_stream']) //ja piespiests sâkt vâkðanu
{
	//Apkopo iesûtîtos mainîgos
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$database = $_POST['database'];
	$keywords = $_POST['Keywords'];
	$time = $_POST['Time'];
	//nomaina datubâzes nosaukumu
	$db_name = strip_tags($_POST['apraksts']);
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
	$file_content = file("table.sql");
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
	echo "<script type=\"text/javascript\">setTimeout(\"window.location = '/riks/stats'\",2250);</script>";
$contentLength = ob_get_length();
header("Content-Length: $contentLength");
header('Connection: close');
ob_end_flush();
ob_flush();
flush();
if (session_id()) session_write_close();
					
	//Uzsâk vâksanu
	error_reporting(0);
	ignore_user_abort(true);
	set_time_limit($time);
		$opts = array(
			'http'=>array(
				'method'	=>	"POST",
				'content'	=>	'track='.$keywords,
				)
		);

		$context = stream_context_create($opts);
		while (1){
			$instream = fopen('https://'.$username.':'.$password.'@stream.twitter.com/1/statuses/filter.json','r' ,false, $context);
			while(! feof($instream)) {
				if(! ($line = stream_get_line($instream, 20000, "\n"))) {
					continue;
				}else{
					include "includes/init_sql.php";
					$remote = @mysql_connect($db_server, $db_user, $db_password);
					mysql_set_charset("utf8", $remote);
					mysql_select_db($db_database, $remote); 
					$tweet = json_decode($line);
					//Clean the inputs before storing
					$id = mysql_real_escape_string($tweet->{'id'});
					$geo = mysql_real_escape_string($tweet->{'place'}->{'name'});
					$text = mysql_real_escape_string($tweet->{'text'});
					$screen_name = mysql_real_escape_string($tweet->{'user'}->{'screen_name'});
					//We store the new post in the database, to be able to read it later
					if ($text!="") {
					$ok_r = mysql_query("INSERT INTO tweets (id ,text ,screen_name, created_at, geo) VALUES ('$id', '$text', '$screen_name', NOW(), '$geo')",$remote);
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
<form style="margin:auto auto; width:550px;" enctype="multipart/form-data" method="post" action="/riks/?id=stream">
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