<?php
	require("dbconnect.php");
	$username=$_POST['user'];
	$email=$_POST['email'];
	
	$result=mysql_query("SELECT CHECK_USERNAME('$username')");
	$ans=mysql_fetch_array($result);
	if ($ans[0]=='N') echo "NO";
	else echo "YES";
	mysql_close();	
?>