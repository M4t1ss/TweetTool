<?php
$table = $_GET['table'];
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

$fp = fopen("../uploads/dump.csv", "w");

$res = mysql_query("SELECT * FROM $table");

// fetch a row and write the column names out to the file
$row = mysql_fetch_assoc($res);
$line = "";
$comma = "";
foreach($row as $name => $value) {
    $line .= $comma . '"' . str_replace('"', '""', $name) . '"';
    $comma = ";";
}
$line .= "\n";
fputs($fp, $line);

// remove the result pointer back to the start
mysql_data_seek($res, 0);

// and loop through the actual data
while($row = mysql_fetch_assoc($res)) {
   
    $line = "";
    $comma = "";
    foreach($row as $value) {
        $line .= $comma . '"' . str_replace('"', '""', $value) . '"';
        $comma = ";";
    }
    $line .= "\n";
    fputs($fp, $line);
}

fclose($fp);

ob_start('ob_gzhandler');
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$table.'.csv"');
echo readfile("../uploads/dump.csv");
?>