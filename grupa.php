<?php
$emo = $_GET['grupa'];
if ($emo == 'Mon'){
	$vards = 'Mondays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 2 group by created_at desc limit 0, 500");
}else if ($emo == 'Tue'){
	$vards = 'Tuesdays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 3 group by created_at desc limit 0, 500");
}else if ($emo == 'Wed'){
	$vards = 'Wedensdays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 4 group by created_at desc limit 0, 500");
}else if ($emo == 'Thu'){
	$vards = 'Thursdays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 5 group by created_at desc limit 0, 500");
}else if ($emo == 'Fri'){
	$vards = 'Fridays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 6 group by created_at desc limit 0, 500");
}else if ($emo == 'Sat'){
	$vards = 'Saturdays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 7 group by created_at desc limit 0, 500");
}else if ($emo == 'Sun'){
	$vards = 'Sundays';
	$vardi = mysql_query("SELECT text, screen_name FROM tweets where DAYOFWEEK( created_at ) = 1 group by created_at desc limit 0, 500");
}else if ($emo == '0'){
	$vards = '00:00 - 01:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 0  limit 0, 500");
}else if ($emo == '1'){
	$vards = '01:00 - 02:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 1  limit 0, 500");
}else if ($emo == '2'){
	$vards = '02:00 - 03:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 2  limit 0, 500");
}else if ($emo == '3'){
	$vards = '03:00 - 04:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 3  limit 0, 500");
}else if ($emo == '4'){
	$vards = '04:00 - 05:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 4  limit 0, 500");
}else if ($emo == '5'){
	$vards = '05:00 - 06:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 5  limit 0, 500");
}else if ($emo == '6'){
	$vards = '06:00 - 07:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 6  limit 0, 500");
}else if ($emo == '7'){
	$vards = '07:00 - 08:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 7  limit 0, 500");
}else if ($emo == '8'){
	$vards = '08:00 - 09:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 8  limit 0, 500");
}else if ($emo == '9'){
	$vards = '09:00 - 10:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 9  limit 0, 500");
}else if ($emo == '10'){
	$vards = '10:00 - 11:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 10  limit 0, 500");
}else if ($emo == '11'){
	$vards = '11:00 - 12:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 11  limit 0, 500");
}else if ($emo == '12'){
	$vards = '12:00 - 13:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 12  limit 0, 500");
}else if ($emo == '13'){
	$vards = '13:00 - 14:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 13  limit 0, 500");
}else if ($emo == '14'){
	$vards = '14:00 - 15:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 14  limit 0, 500");
}else if ($emo == '15'){
	$vards = '15:00 - 16:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 15  limit 0, 500");
}else if ($emo == '16'){
	$vards = '16:00 - 17:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 16  limit 0, 500");
}else if ($emo == '17'){
	$vards = '17:00 - 18:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 17  limit 0, 500");
}else if ($emo == '18'){
	$vards = '18:00 - 19:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 18  limit 0, 500");
}else if ($emo == '19'){
	$vards = '19:00 - 20:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 19  limit 0, 500");
}else if ($emo == '20'){
	$vards = '20:00 - 21:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 20  limit 0, 500");
}else if ($emo == '21'){
	$vards = '21:00 - 22:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 21  limit 0, 500");
}else if ($emo == '22'){
	$vards = '22:00 - 23:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 22  limit 0, 500");
}else if ($emo == '23'){
	$vards = '23:00 - 24:00 tweeted';
	$vardi = mysql_query("SELECT text, screen_name, created_at FROM tweets having hour( created_at ) = 23  limit 0, 500");
}
?>
<h2 style='margin:auto auto; text-align:center;'><?php echo $vards; ?> tweets (500 latest)</h2>
<br/>
<div>
<?php

$krasa=TRUE;
echo "<table id='results' style='margin:auto auto;'>";
echo "<tr>
<th>User</th>
<th>Tweet</th>
</tr>";
while($r=mysql_fetch_array($vardi)){
	if($emo != 'saldumi' && $emo != 'gala' && $emo != 'piens' && $emo != 'darzeni' && $emo != 'augli' && $emo != 'maize' && $emo != 'alkoholiskie' && $emo != 'bezalkoholiskie'){
		$niks = $r["screen_name"];
		$teksts = $r["text"];
		if ($krasa==TRUE) {$kr=" class='even'";}else{$kr="";}
		echo '<tr'.$kr.'><td><b><a style="text-decoration:none;color:#207DAC;" href="<?php echo $tweettool_path; ?>draugs/'.$niks.'">'.$niks.'</a></b></td><td>'.$teksts.'</td></tr>';
		$krasa=!$krasa;
	}else{
		$tvits = $r["tvits"];
		$tviti = mysql_query("SELECT screen_name, text FROM tweets where id = '$tvits'");
		$p=mysql_fetch_array($tviti);
		$niks = $p["screen_name"];
		$teksts = $p["text"];
		if ($krasa==TRUE) {$kr=" class='even'";}else{$kr="";}
		echo '<tr'.$kr.'><td><b><a style="text-decoration:none;color:#207DAC;" href="<?php echo $tweettool_path; ?>draugs/'.$niks.'">'.$niks.'</a></b></td><td>'.$teksts.'</td></tr>';
		$krasa=!$krasa;
	}
}
echo "</table>";
?>
</div>