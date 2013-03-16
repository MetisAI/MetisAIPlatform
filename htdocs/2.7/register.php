<?php
	require("dbconnect.php");
	$result=mysql_query("call pSignup('".$_POST["user"]."','".$_POST["pass"]."','".$_POST["email"]."','default','default');")  or die("Query failed:" .mysql_error());
	echo "success";
?>