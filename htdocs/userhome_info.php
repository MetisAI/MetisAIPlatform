<?php
	require("dbconnect.php");
	$username = $_POST['user'];
 	$result = mysql_query("select * from taccount where username = '$username'");
	$ans=mysql_fetch_array($result);
	echo $ans[3];
	
?>