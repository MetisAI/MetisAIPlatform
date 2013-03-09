<?php
	$prog = $_POST['prog'];
	require("dbconnect.php");
	session_start();
	$username = $_SESSION["user"];
	$result1 = mysql_query("select * from taccount where username = '$username'");
	$ans1 = mysql_fetch_array($result1);
	$result=mysql_query("insert into tprog(UID,code) value ('$ans1[0]','$prog')");
?>