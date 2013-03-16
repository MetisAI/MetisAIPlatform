<?php
	require("dbconnect.php");
	session_start();
	if ($_SESSION["user"]!="")
	{
		echo $_SESSION['user'];
	}
	else 
	{
		echo "NO";
	}
?>