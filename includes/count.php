<?php
$lidz = date('Y-m-d H:i:s', time());
$no = date('Y-m-d H:i:s', (time()-30));

//Read the configuration
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
$config = MyConfig::read('settings.php');
//Connect to the database
$db_server = $config['db_server'];
$db_user = $config['db_user'];
$db_password = $config['db_password'];
$db_database = $config['db_database'];
mysql_connect($db_server, $db_user, $db_password);
mysql_set_charset("utf8");
mysql_select_db($db_database);
//All tweets
$kopa = mysql_query("SELECT count( * ) skaits FROM tweets where created_at between '$no' and '$lidz'");
$r=mysql_fetch_array($kopa);
$tvkopa = $r["skaits"];
?><?php echo $tvkopa; ?>