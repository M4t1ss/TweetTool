<?php
$tweettool_path = str_replace("progress.php","",$_SERVER['PHP_SELF']);
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
?>
<link rel="stylesheet" type="text/css" href="<?php echo $tweettool_path; ?>includes/jq/css/custom-theme/jquery-ui-1.8.18.custom.css" />
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $tweettool_path; ?>includes/jq/js/jquery.ui.datepicker-lv.js"></script>
<style>
.ui-progressbar-value { background-image: url(images/pbar-ani.gif); }
</style>
<script>
$(function() {
	$( "#progressbar" ).progressbar({
		value: <?php echo ((time()-$config['start_time'])/($config['end_time']-$config['start_time'])*100) ?>
	});
});
</script>
<h3>Progress:</h3>
<div class="demo"><div style="width:300px;margin:auto auto;text-align:center;" id="progressbar"></div></div>