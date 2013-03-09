<?php
	$username='root';
	$userpass='dragoncat';
	$dbhost='localhost';
	$dbdatabase='table2';
	$db_connect=mysql_connect($dbhost,$username,$userpass) or die("Unable to connect to the MySQL!");;
	mysql_select_db($dbdatabase,$db_connect);
	
?>