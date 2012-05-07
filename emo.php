<?php
//kopskaits visi
$kopa = mysql_query("SELECT count(*) skaits FROM `tweets`");
$r=mysql_fetch_array($kopa);
$kopskaits = $r["skaits"];
//pozitīvie
$kopa = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  (`text` LIKE '%:D%' OR `text` LIKE '%:)%' OR `text` LIKE '%(:%' OR `text` LIKE '%;)%' OR `text` LIKE '%;]%' OR `text` LIKE '%:-)%' OR `text` LIKE '%:]%' OR `text` LIKE '%[:%' OR `text` LIKE '%:D%' OR `text` LIKE '%;D%' OR `text` LIKE '%xD%' OR `text` LIKE '%:^_^%' OR `text` LIKE '%:^^%' OR `text` LIKE '%:8)%' OR `text` LIKE '%:P%' OR `text` LIKE '%:*%' OR `text` LIKE '%;*%')");
$r=mysql_fetch_array($kopa);
$poz = $r["skaits"];
//negatīvie
$kopa = mysql_query("SELECT count( * ) skaits FROM tweets where (`text` LIKE '%:S%' OR `text` LIKE '%:(%' OR `text` LIKE '%):%' OR `text` LIKE '%:-(%' OR `text` LIKE '%:[%' OR `text` LIKE '%]:%' OR `text` LIKE '%;(%' OR `text` LIKE '%);%' OR `text` LIKE '%];%' OR `text` LIKE '%;[%' OR `text` LIKE '%:@%' OR `text` LIKE '%:/%' OR `text` LIKE '%:|%' OR `text` LIKE '%:?%' OR `text` LIKE '%:-_-%' OR `text` LIKE '%:O%' OR `text` LIKE '%O:%')");
$r=mysql_fetch_array($kopa);
$neg = $r["skaits"];
//ar smaidiņiem
$arsm = $neg+$poz;
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:)%'");
$r1=mysql_fetch_array($g1);
$s0 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%(:%'");
$r1=mysql_fetch_array($g1);
$s1 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;)%'");
$r1=mysql_fetch_array($g1);
$s2 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;]%'");
$r1=mysql_fetch_array($g1);
$s3 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:-%)'");
$r1=mysql_fetch_array($g1);
$s4 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:]%'");
$r1=mysql_fetch_array($g1);
$s5 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:D%'");
$r1=mysql_fetch_array($g1);
$s6 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;D%'");
$r1=mysql_fetch_array($g1);
$s7 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%xD%'");
$r1=mysql_fetch_array($g1);
$s8 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:P%'");
$r1=mysql_fetch_array($g1);
$s9 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:*%'");
$r1=mysql_fetch_array($g1);
$s10 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;*%'");
$r1=mysql_fetch_array($g1);
$s11 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%^_^%'");
$r1=mysql_fetch_array($g1);
$s12 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%^^%'");
$r1=mysql_fetch_array($g1);
$s13 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%8)%'");
$r1=mysql_fetch_array($g1);
$s14 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:O%'");
$r1=mysql_fetch_array($g1);
$s15 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%O:%'");
$r1=mysql_fetch_array($g1);
$s16 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:S%'");
$r1=mysql_fetch_array($g1);
$s17 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:(%'");
$r1=mysql_fetch_array($g1);
$s18 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%):%'");
$r1=mysql_fetch_array($g1);
$s19 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%]:%'");
$r1=mysql_fetch_array($g1);
$s20 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;(%'");
$r1=mysql_fetch_array($g1);
$s21 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%;[%'");
$r1=mysql_fetch_array($g1);
$s22 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:@%'");
$r1=mysql_fetch_array($g1);
$s23 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:/%'");
$r1=mysql_fetch_array($g1);
$s24 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%:|%'");
$r1=mysql_fetch_array($g1);
$s25 = $r1["skaits"];
//Smaidiņš
$g1 = mysql_query("SELECT count(*) skaits FROM `tweets` WHERE  `text` LIKE '%-_-%'");
$r1=mysql_fetch_array($g1);
$s26 = $r1["skaits"];
?>
<h2 style='margin:auto auto; text-align:center;'>Emoticon statistics</h2>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      var chart;
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['With emoticons', <?php echo $arsm; ?>],
        ['Without emoticons', <?php echo $kopskaits - $arsm; ?>]
		]);
      var options = {'title':'Tweets with emoticons',
                     'width':470,
                     'height':300,
                     'backgroundColor':'transparent',
                     'is3D':'true'};
      chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
	  }
</script>
    <script type="text/javascript">
	var chart1;
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        ['Positive', <?php echo $poz; ?>],
        ['Negative', <?php echo $neg; ?>]]);
      var options = {'title':'Mood',
                     'width':470,
                     'height':300,
                     'backgroundColor':'transparent',
                     'is3D':'true'};
      chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
      chart1.draw(data, options);
	  }
</script>
    <script type="text/javascript">
	var chart2;
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        [':)', <?php echo $s0; ?>],
        ['(:', <?php echo $s1; ?>],
        [';)', <?php echo $s2; ?>],
        [';]', <?php echo $s3; ?>],
        [':-)', <?php echo $s4; ?>],
        [':]', <?php echo $s5; ?>],
        [':D', <?php echo $s6; ?>],
        [';D', <?php echo $s7; ?>],
        ['xD', <?php echo $s8; ?>],
        [':P', <?php echo $s9; ?>],
        [':*', <?php echo $s10; ?>],
        [';*', <?php echo $s11; ?>],
        ['^_^', <?php echo $s12; ?>],
        ['^^', <?php echo $s13; ?>],
        ['8)', <?php echo $s14; ?>]
        ]);
      var options = {'title':'Positive emoticons',
                     'width':470,
                     'height':300,
                     'backgroundColor':'transparent',
                     'is3D':'true'};
      chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
      chart2.draw(data, options);
	  }
</script>
    <script type="text/javascript">
	var chart3;
      google.load('visualization', '1.0', {'packages':['corechart']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');
      data.addRows([
        [':O', <?php echo $s15; ?>],
        ['O:', <?php echo $s16; ?>],
        [':S', <?php echo $s17; ?>],
        [':(', <?php echo $s18; ?>],
        ['):', <?php echo $s19; ?>],
        [']:', <?php echo $s20; ?>],
        [';(', <?php echo $s21; ?>],
        [';[', <?php echo $s22; ?>],
        [':@', <?php echo $s23; ?>],
        [':/', <?php echo $s24; ?>],
        [':|', <?php echo $s25; ?>],
        ['-_-', <?php echo $s26; ?>]
        ]);
      var options = {'title':'Negative emoticons',
                     'width':470,
                     'height':300,
                     'backgroundColor':'transparent',
                     'is3D':'true'};
      chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
      chart3.draw(data, options);
	  }
</script>
<br/>
<div style="margin:auto auto;width:980px;">
	<div class="tweet" style="width:450px;float:left;" id="chart_div"></div>
	<div class="tweet" style="width:450px;float:right;" id="chart_div1"></div>
	<div class="tweet" style="width:450px;float:left;" id="chart_div2"></div>
	<div class="tweet" style="width:450px;float:right;" id="chart_div3"></div>
</div>