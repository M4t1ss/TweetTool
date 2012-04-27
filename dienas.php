<h2 style='margin:auto auto; text-align:center;'>Tweet calendar</h2>
<br/>
<h3>Time of day</h3>
<div style='margin:auto auto;width:500px;'>
<?php
$q = mysql_query("SELECT created_at FROM `tweets`");
while($r=mysql_fetch_array($q)){
	$laiks=$r["created_at"];
	$laiks=strtotime($laiks);
	$diena=date("D", $laiks);
	$laiks=date("G", $laiks);
	$dienas[$diena][skaits]++;
	$stundas[$laiks][skaits]++;
	if($stundas[$laiks][skaits]>$max) $max=$stundas[$laiks][skaits];
	if($dienas[$diena][skaits]>$maxd) $maxd=$dienas[$diena][skaits];
}

//izdrukā populārākās stundas
for($zb=0;$zb<24;$zb++) {
$percent = round($stundas[$zb][skaits]/$max*100);
if ($percent>0){
	?>
	<script type="text/javascript">
		$(function(){
			$("#progressbar<?php echo $zb;?>").progressbar({
				value: <?php echo $percent;?>
			});		
		});
	</script>
	<a href="/<?php echo $tweettool_path; ?>/grupa/<?php echo $zb;?>"><div style=" font: 50% 'Trebuchet MS', sans-serif;" id="progressbar<?php echo $zb;?>"></div>
	<div class="sk"><?php echo $zb.":00 - ".($zb+1).":00";?></div>
	</a>
	<br/>
	<?php
	}
}
?>
</div>
<br/>
<h3>Days</h3>
<div style='margin:auto auto;width:500px;'>
<?php
$theDate = '2011-10-31';
$timeStamp = StrToTime($theDate);
//izdrukā populārākās dienas
for($zb=0;$zb<7;$zb++) {
$ddd = date('D', $timeStamp); 
$timeStamp = StrToTime('+1 days', $timeStamp);
$percent = round($dienas[$ddd][skaits]/$maxd*100);
if ($percent>0){
?>
<script type="text/javascript">
	$(function(){
		$("#progressbar<?php echo $ddd;?>").progressbar({
			value: <?php echo $percent;?>
		});		
	});
</script>
<a href="/<?php echo $tweettool_path; ?>/grupa/<?php echo $ddd;?>"><div style=" font: 50% 'Trebuchet MS', sans-serif;" id="progressbar<?php echo $ddd;?>"></div>
<div class="sk"><?php
switch ($ddd) {
    case 'Mon':
        echo "Monday";
        break;
    case 'Tue':
        echo "Tuesday";
        break;
    case 'Wed':
        echo "Wedensday";
        break;
    case 'Thu':
        echo "Thursday";
        break;
    case 'Fri':
        echo "Friday";
        break;
    case 'Sat':
        echo "Saturday";
        break;
    case 'Sun':
        echo "Sunday";
        break;
}
?></div></a>
<br/>
<?php
}
}
?>
</div>