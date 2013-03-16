<?php
	require("dbconnect.php");
	
	$username=$_POST['user'];
	$password=$_POST['pass'];
	$email=$_POST['email'];
	$result=mysql_query("call pSignup('$username','$password','$email','default','default');")  or die("Query failed:" .mysql_error());
	//成功后session保存、、
	//$result=mysql_query("insert into taccount(username,pass) value ('$username','$password')");
	if ($result)
	{
		echo "success";
		session_start();
		$_SESSION['user']=$_POST['user'];
		
	}
?>