<?php
$tweettool_path = str_replace("index.php","",$_SERVER['PHP_SELF']);
ob_start();
//Uzstādījumi
class MyConfig
{
    public static function read($filename)
    {
        $config = include $filename;
        return $config;
    }
    public static function write($filename, array $config)
    {
        $config = var_export($config, true);
        file_put_contents($filename, "<?php return $config ;");
    }
}
$config = MyConfig::read('includes/settings.php');

if($_GET['id']!="configure"&&(!isset($config['db_server'])||!isset($config['db_user'])||!isset($config['db_password'])||!isset($config['db_database']))){
header('Location: configure');
}else if($_GET['id']=="configure"&&(!isset($config['db_server'])||!isset($config['db_user'])||!isset($config['db_password'])||!isset($config['db_database']))){
}else{
	$db_server = $config['db_server'];
	$db_user = $config['db_user'];
	$db_password = $config['db_password'];
	$db_database = $config['db_database'];
	$tw_user = $config['twitter_username'];
	$tw_pass = $config['twitter_password'];

	$connection = @mysql_connect($db_server, $db_user, $db_password);
	mysql_set_charset("utf8", $connection);
	mysql_select_db($db_database);

	$result = mysql_query("SELECT * FROM tweets");
	if($_GET['id']!="configure"&&$_GET['id']!="home"&&$_GET['id']!="stream"&&$_GET['id']!="upload"&&mysql_num_rows($result)==0){
		header('Location: home');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="lv" lang="lv">
<head>
<title>TweetTool</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="description" content="Apskati ko Tu un profili, kam Tu seko ir tvītojuši par ēšanu."/>
<meta name="keywords" content="TwitterRīks, riks, analīze, Twitter, @M4t1ss, Matīss, Rikters, Matīss Rikters"/>
<meta name="author" content="Matīss Rikters"/>
<link rel="shortcut icon" href="<?php echo $tweettool_path; ?>favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/sorttable.js"></script>
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/paging.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $tweettool_path; ?>includes/jq/css/custom-theme/jquery-ui-1.8.18.custom.css" />	
<link rel="stylesheet" type="text/css" href="<?php echo $tweettool_path; ?>includes/tag/css/wordcloud.css">
<link rel="stylesheet" type="text/css" href="<?php echo $tweettool_path; ?>includes/style.css" />
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery.ui.datepicker-lv.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $tweettool_path; ?>includes/tooltip/style.css" />
<script type="text/javascript">
$(document).ready(function () {
$("#contents").fadeIn(1000);
});
</script>
</head>
<body onload="initialize()">
<h1 style="padding-top:5px;"><img src="<?php echo $tweettool_path; ?>img/tweettool.png" /></h1>
<div id="top">
<a href=""><span style="opacity: 0;">.</span></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>home"><span>Home</span><img title="Home" src="<?php echo $tweettool_path; ?>img/home.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>calendar"><span>Calendar</span><img title="Calendar" src="<?php echo $tweettool_path; ?>img/calendar.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>tags"><span>Hashtags</span><img title="Hashtags" src="<?php echo $tweettool_path; ?>img/calendar.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>users"><span>Mentioned users</span><img title="Mentioned users" src="<?php echo $tweettool_path; ?>img/calendar.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>links"><span>Links</span><img title="Links" src="<?php echo $tweettool_path; ?>img/calendar.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>map"><span>Map</span><img title="Map" src="<?php echo $tweettool_path; ?>img/map.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>top"><span>Top users</span><img title="Top users" src="<?php echo $tweettool_path; ?>img/top.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>stats"><span>Stats</span><img title="Stats" src="<?php echo $tweettool_path; ?>img/stats.png"/></a>
<a class="htooltip" href="<?php echo $tweettool_path; ?>configure"><span>Settings</span><img title="Settings" src="<?php echo $tweettool_path; ?>img/settings.png"/></a>
</div>
<div id="contents" style="display: none;margin-top:5px;margin-bottom:5px;padding:6px;">
<?php $id = $_GET['id']; if ( !$id || $id == "" ) { include "home.php"; } else { include($id.".php"); } ?>
<br class="clear" />
<br/>
</div>
<div id="bottom" style="padding:8px;">
<div style="text-align:center;">&copy; 2012 <a href="http://lielakeda.lv">LielaKeda.lv</a>; <a href="https://twitter.com/#!/LielaKeda">@LielaKeda</a>.</div>
</div>
</body>
</html>