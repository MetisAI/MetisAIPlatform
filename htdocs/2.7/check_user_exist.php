<?php
	require("dbconnect.php");
	$result=mysql_query("SELECT CHECK_USERNAME('".$_POST["user"]."')");
	$ans=mysql_fetch_array($result);
	if ($ans[0]=='N') echo "NO";
	else echo "YES";
	mysql_close();
?>