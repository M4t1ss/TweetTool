<?php

if($_POST['saveset']) //ja piespiests saglabāt
{	
	//nomaina datubāzes nosaukumu
	$config['db_server'] = $_POST['database_host'];
	$config['db_user'] = $_POST['database_username'];
	$config['db_password'] = $_POST['database_password'];
	$config['db_database'] = $_POST['database_name'];
	$config['twitter_username'] = $_POST['twitter_username'];
	$config['twitter_password'] = $_POST['twitter_password'];
	$config['replace_usernames'] = $_POST['group1'];
	$config['replace_hashtags'] = $_POST['group2'];
	$config['replace_links'] = $_POST['group3'];
	MyConfig::write('includes/settings.php', $config);
	if ($_POST['clear']=="Yes"){
		//aizver esošo pieslēgumu DB
		mysql_close($connection);
		//pieslēdzamies jaunajai DB un izveido tabulu
		$config = MyConfig::read('includes/settings.php');
		$db_server = $config['db_server'];
		$db_user = $config['db_user'];
		$db_password = $config['db_password'];
		$db_database = $config['db_database'];
		$connection = @mysql_connect($db_server, $db_user, $db_password);
		mysql_set_charset("utf8", $connection);
		mysql_select_db($db_database);
	   //izdzēš tvītu tabulu, ja tāda ir, un izveido jaunu
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
	}
   //apstiprinājums
   echo "<br/>Settings saved!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/stats'\",1250);</script>";
}else{
?>
<h2 style='margin:auto auto; text-align:center;'>Configure settings</h2>
<br/>
<form style="margin:auto auto; width:700px;" enctype="multipart/form-data" method="post" action="<?php echo $tweettool_path; ?>?id=configure">
<TABLE>
<TR>
   <TD class="in">Database name:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='database_name' placeholder="Database name" value="<?php echo $db_database;?>" required autofocus/>
   </TD>
</TR>
<TR>
   <TD class="in">Clear database:</TD>
   <TD class="in">
   <input type="checkbox" name="clear" value="Yes" checked="yes"/>
   </TD>
</TR>
<TR>
   <TD class="in">Database host:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='database_host' placeholder="localhost" value="<?php echo $db_server;?>" required />
   </TD>
</TR>
<TR>
   <TD class="in">Database user:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='database_username' placeholder="root" value="<?php echo $db_user;?>" required />
   </TD>
</TR>
<TR>
   <TD class="in">Database password:</TD>
   <TD class="in">
   <INPUT TYPE='password' size="52" NAME='database_password' placeholder="password" value="<?php echo $db_password;?>" required />
   </TD>
</TR>
<TR>
   <TD class="in">Twitter username:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='twitter_username' placeholder="username" value="<?php echo $tw_user;?>" />
   </TD>
</TR>
<TR>
   <TD class="in">Twitter password:</TD>
   <TD class="in">
   <INPUT TYPE='password' size="52" NAME='twitter_password' placeholder="password" value="<?php echo $tw_pass;?>" />
   </TD>
</TR>
<TR>
	<TD class="in">Replace usernames with _@user:</TD>
	<TD class="in">
	<input type="radio" name="group1" value="y"<?php if($config['replace_usernames'] == 'y') echo " checked";?>> Yes<br>
	<input type="radio" name="group1" value="n"<?php if($config['replace_usernames'] == 'n') echo " checked";?>> No<br>
	</TD>
</TR>
<TR>
	<TD class="in">Replace hashtags with _@hashtag:</TD>
	<TD class="in">
	<input type="radio" name="group2" value="y"<?php if($config['replace_hashtags'] == 'y') echo " checked";?>> Yes<br>
	<input type="radio" name="group2" value="n"<?php if($config['replace_hashtags'] == 'n') echo " checked";?>> No<br>
	</TD>
</TR>
<TR>
	<TD class="in">Replace links with _@URL:</TD>
	<TD class="in">
	<input type="radio" name="group3" value="y"<?php if($config['replace_links'] == 'y') echo " checked";?>> Yes<br>
	<input type="radio" name="group3" value="n"<?php if($config['replace_links'] == 'n') echo " checked";?>> No<br/>
	</TD>
</TR>
<TR>
   <TD class="in"></TD>
   <TD class="in"><INPUT style="float:left;" TYPE="submit" name="saveset" value="Save"/></TD> 
</TR>
</TABLE>
</form>
<?php
}
?>