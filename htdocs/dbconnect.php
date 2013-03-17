<?php
	$_username='root';
	$_userpass='metis';
	$_dbhost='localhost';
	$_dbdatabase='db_ai';
	$_db_connect=mysql_connect($_dbhost,$_username,$_userpass) or die("Unable to connect to the MySQL!");;
	mysql_select_db($_dbdatabase,$_db_connect);
	
?>