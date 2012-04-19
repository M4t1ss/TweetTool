<?php

$config = MyConfig::read('settings.php');
$config['db_server'] = 'localhost';
$config['db_user'] = 'root';
$config['db_password'] = 'root';
$config['db_database'] = 'riks_test';
MyConfig::write('settings.php', $config);
   
?>