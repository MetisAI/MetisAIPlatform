<?php
	require("dbconnect.php");
	$username=$_POST['user'];
	$email=$_POST['email'];
	
	$result=mysql_query("SELECT CHECK_USERNAME('$username')");
	$ans=mysql_fetch_array($result);
	if ($ans[0]=='N') echo "NO";
	else echo "YES";
	mysql_close();
	/*
	$result=mysql_query("select * from user where User = '$username'");
	if (mysql_num_rows($result)>0) 
		echo "YES";        //用户名已存在
	else echo "NO";     //用户名还没有
	mysql_close();
	*/
	
?>