<?php

if($_POST['submit']) //ja piespiests saglabāt
{	
	//nomaina datubāzes nosaukumu
	$config['db_server'] = $_POST['database_host'];
	$config['db_user'] = $_POST['database_username'];
	$config['db_password'] = $_POST['database_password'];
	$config['db_database'] = $_POST['database_name'];
	$config['twitter_username'] = $_POST['twitter_username'];
	$config['twitter_password'] = $_POST['twitter_password'];
	MyConfig::write('includes/settings.php', $config);
	
   //apstiprinājums
   echo "<br/>Settings saved!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '/<?php echo $tweettool_path; ?>/stats'\",1250);</script>";
}else{
?>
<h2 style='margin:auto auto; text-align:center;'>Configure settings</h2>
<br/>
<form style="margin:auto auto; width:500px;" enctype="multipart/form-data" method="post" action="/<?php echo $tweettool_path; ?>/?id=configure">
<TABLE>
<TR>
   <TD class="in">Database name:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='database_name' placeholder="Database name" value="<?php echo $db_database;?>" required autofocus/>
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
   <TD class="in"></TD>
   <TD class="in"><INPUT style="float:left;" TYPE="submit" name="submit" value="Save"/></TD> 
</TR>
</TABLE>
</form>
<?php
}
?>