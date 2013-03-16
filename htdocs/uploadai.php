<?php
    $prog = $_POST['prog'];
    require("dbconnect.php");
    session_start();
    $username = $_SESSION["user"];
    $result1 = mysql_query("select * from taccount where username = '$username'");
    $ans1 = mysql_fetch_array($result1);
    $uid=$ans1['UID'];
    $result_version = mysql_query("select * from tProg where UID = '$uid' order by version desc");
    if (empty($result_version)) $version=1;
    else
    {
        $ans_version=mysql_fetch_array($result_version);
        $version=$ans_version['version']+1;
    }

    $time  = date('Y-m-d H:i:s',time());

	$result=mysql_query("insert into tProg(UID,code,version,submitted_on,status_code) value ('$uid','$prog','$version','$time',0)");
?>