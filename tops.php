<h2 style='margin:auto auto; text-align:center;'>Top users</h2>
<br/>
<div style='margin:auto auto; width:299px;text-align:center;'>
<?php
$krasa=TRUE;
$i=1;
echo "<table style='margin: auto auto;text-align:center;border-spacing:0px;border:1px solid white;'>";
echo "<tr>
<th>Place</th>
<th>Username</th>
<th>Tweets</th>
</tr>";
$q = mysql_query("SELECT screen_name, count( * ) skaits FROM tweets GROUP BY screen_name ORDER BY count( * ) DESC LIMIT 0 , 15");
if(mysql_num_rows($q)==0){
	echo "The database is empty!";
   echo "<script type=\"text/javascript\">setTimeout(\"window.location = '$tweettool_path/home'\",1250);</script>";
}else{
while($r=mysql_fetch_array($q)){
if ($krasa==TRUE) {$kr=" class='even'";}else{$kr="";}
$vards=$r["screen_name"];
$skaits=$r["skaits"];
echo "<tr".$kr."><td>".$i.".</td><td><b><a style='text-decoration:none;color:#207DAC;' href='$tweettool_path/draugs/".$vards."'>".$vards."</a></b></td><td>".$skaits."</td></tr>";
$krasa=!$krasa;
$i++;
}
echo "</table>";
}
?>
</div>