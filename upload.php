<?php

if($_POST['submit']) //ja piespiests sūtīt
{
	//apstrādā failu
	$target_path = "uploads/"; 
	$target_path1 = $target_path . basename($_FILES['attels1']['name']); 
	if(move_uploaded_file($_FILES['attels1']['tmp_name'], $target_path1)) {
	echo "The database ".  basename( $_FILES['attels1']['name']). 
	" was uploaded successfuly";
	} else{
	echo "An error occured! Please try again!";
	}
	
	//nomaina datubāzes nosaukumu
	$db_name = strip_tags($_POST['apraksts']);
	$config = MyConfig::read('includes/settings.php');
	$config['db_database'] = $db_name;
	MyConfig::write('includes/settings.php', $config);
	//aizver esošo pieslēgumu DB
	mysql_close($connection);
	//pieslēdzamies jaunajai DB
	$config = MyConfig::read('includes/settings.php');
	$db_server = $config['db_server'];
	$db_user = $config['db_user'];
	$db_password = $config['db_password'];
	$db_database = $config['db_database'];
	$connection = @mysql_connect($db_server, $db_user, $db_password);
	mysql_set_charset("utf8", $connection);
	mysql_select_db($db_database);
   
   //izpilda ielādētās datubāzes pieprasījumus
	$file_content = file($target_path1);
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
   //apstiprinājums
   echo "<br/>Database Uploaded!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '/riks/stats'\",1250);</script>";
}else{
?>
<h2 style='margin:auto auto; text-align:center;'>Upload database</h2>
<br/>
<form style="margin:auto auto; width:500px;" enctype="multipart/form-data" method="post" action="/riks/?id=upload">
<TABLE>
<TR>
   <TD class="in">Database name:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='apraksts' placeholder="Database name" required autofocus/>
   </TD>
</TR>
<TR>
   <TD class="in">Keywords used:</TD>
   <TD class="in">
   <INPUT TYPE='text' size="52" NAME='keywords' placeholder="Optional" />
   </TD>
</TR>
<TR>
   <TD>SQL file:</TD>
   <TD style="float:left;">
   <INPUT class="file" TYPE='file' NAME='attels1' VALUE='' placeholder="SQL file" required/><br/>
   </TD>
</TR>
<TR>
   <TD class="in"></TD>
   <TD class="in"><INPUT style="float:left;" TYPE="submit" name="submit" value="Upload"/></TD> 
</TR>
</TABLE>
</form>
<?php
}
?>