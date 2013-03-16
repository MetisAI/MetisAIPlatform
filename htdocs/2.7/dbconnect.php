<?php
	$username='root';
	$userpass='000000';
	$dbhost='localhost:3306';
	$dbdatabase='db_ai';
	$db_connect=mysql_connect($dbhost,$username,$userpass) or die("Unable to connect to the MySQL!");;
	mysql_select_db($dbdatabase,$db_connect);

?>