<?php
//Get the settings
$config = MyConfig::read('includes/settings.php');
$config['end_time'] = time();
MyConfig::write('includes/settings.php', $config);	
//Get the process id
$proc_id = $config['pid'];
if (stristr(PHP_OS, 'WIN')) { 
	//Kill for Windows OS
	function win_kill($p_id){
		if(class_exists(COM)){
			$wmi=new COM("winmgmts:{impersonationLevel=impersonate}!\\\\.\\root\\cimv2");
			$procs=$wmi->ExecQuery("SELECT * FROM Win32_Process WHERE ProcessId='".$p_id."'");
			foreach($procs as $proc)
			$proc->Terminate();
		}
}
win_kill($proc_id);
} else { 
	//Kill for non Windows OS
	shell_exec('kill '.$proc_id);
}
?>