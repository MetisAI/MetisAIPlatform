<?php
	$pid= $_POST['pid'];
	$userid = $_POST['userid'];
	require("dbconnect.php");

	$result = mysql_query("delete from tprog where PID = $pid and UID = $userid");


?>