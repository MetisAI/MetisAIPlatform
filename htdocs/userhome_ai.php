<?php

	require("dbconnect.php");
	session_start();
	$username = $_SESSION['user'];
	$result = mysql_query("select * from taccount where username = '$username'");
	$ans1 = mysql_fetch_array($result);
	$userid = $ans1[0];
	
	$result2 = mysql_query("select * from tprog where UID = '$userid'");
	//$ans2 = mysql_fetch_array($result2);
	$num = mysql_num_rows($result2);
	for ( $i = 0; $i < $num ; $i++ ) $ans2[$i] = mysql_fetch_array($result2);
	
	$userai = array(
		'num' => $num,
		'userid' => $userid,
		'ai' => $ans2	
	);


	
	//header('Content-Type:text/json');
	echo json_encode($userai);

?>