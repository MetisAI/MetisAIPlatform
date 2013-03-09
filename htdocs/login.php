<?php
	
	$username=$_POST['user'];
	$password=$_POST['pwd'];
	require("dbconnect.php");
	
	$result=mysql_query("SELECT chk_acc_info('$username','$password')");
	$ans=mysql_fetch_array($result);
	if ($ans[0] != 0)
	{
		session_start();
		$_SESSION["user"] = $_POST['user'];
		echo "YES";
	} else echo "NO";
	
?>
