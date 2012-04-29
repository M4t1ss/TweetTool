<h2 style='margin:auto auto; text-align:center;'>Lets get started</h2>
<br/>
<div style='margin:auto auto; text-align:center; font-weight:bold;'>
	<a class="htooltip" href="upload"><span>Upload a database file</span><img title="Upload a database file" src="<?php echo $tweettool_path; ?>img/database.png"/></a>	or
	<a class="htooltip" href="stream"><span>Get tweets from the Twitter stream</span><img title="Get tweets from the Twitter stream" src="<?php echo $tweettool_path; ?>img/stream.png"/></a>
	<br/><br/>
</div>
<div style='margin:auto auto; width:200px; font-weight:bold;'>
<?php
$tweets = mysql_query("SELECT * FROM tweets");
$hashtags = mysql_query("SELECT * FROM hashtags");
$links = mysql_query("SELECT * FROM links");
$mentions = mysql_query("SELECT * FROM mentions");
$tokens = mysql_query("SELECT * FROM tokens");
$users = mysql_query("SELECT * FROM users");
if(mysql_num_rows($tweets)>0){
	echo "<p>Export to CSV: ";
	echo "<select onchange=\"if(this.options[this.selectedIndex].value != ''){window.top.location.href=this.options[this.selectedIndex].value}\">";
	echo "<option></option>";
	echo "<option value='includes/tocsv.php?table=tweets'>Tweets</option>";
	if(mysql_num_rows($hashtags)>0) echo "<option value='includes/tocsv.php?table=hashtags'>Hashtags</option>";
	if(mysql_num_rows($links)>0) echo "<option value='includes/tocsv.php?table=links'>Links</option>";
	if(mysql_num_rows($mentions)>0) echo "<option value='includes/tocsv.php?table=mentions'>Mentions</option>";
	if(mysql_num_rows($tokens)>0) echo "<option value='includes/tocsv.php?table=tokens'>Tokens</option>";
	if(mysql_num_rows($users)>0) echo "<option value='includes/tocsv.php?table=users'>Users</option>";
	echo "</select>";
	echo "</p>";
}
?>
</div>