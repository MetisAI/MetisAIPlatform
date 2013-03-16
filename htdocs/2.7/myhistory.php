<!DOCTYPE HTML>
<html>
<head>
	<link href="bootstrap.css" rel="stylesheet">
	<title>PK history</title>
</head>
<body style="padding-top: 50px">
	<!-------------------------------------以下部分为头部导航栏 ---------------------------------->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner" >
			<div class="container-fluid">
				<a class="brand" href="index.html">METIS</a>
				<div class="nav-collapse collapse">
					<p class="navbar-text pull-right">
						<!-- <a href="login.html" class="navbar-link">Login</a> &nbsp -->
						<a href="register.html" class="navbar-link">Register</a>
					</p>
					<p class="navbar-text pull-right" id="login"></p>
					<ul class="nav">
						<li class="active"><a href="index.html">Home</a></li>
						<li><a href="scorelist.html">Ranking</a></li>
						<li><a href="http://localhost:8080/pkhistory.php?page=1">PK history</a></li>
						<li><a href="http://localhost:8080/userhome.php">MySpace</a></li>
						<li><a href="#contact">Contact</a></li>	 
					</ul>
					
				</div>
			</div>
		</div>
    </div>
	<!----------------------------------------------------------------------------------------------->
	<div id="contents">
		<div class="container">
			<h1><center>My pk history</center></h1>
			<?php
				$perNumber=30; //每页显示的记录数
				$page=@$_GET['page']; //获得当前的页面值

				####  $count=mysql_query("select count(*) from user"); //获得记录总数
				$count= 300; //test
				####  $rs=mysql_fetch_array($count);  
				####  $totalNumber=$rs[0];
				$totalNumber= 100;//test
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				if (!isset($page)) {
					$page=1;
				} //如果没有值,则赋值1
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$result=mysql_query("select * from user limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数

				/*
				while ($row=mysql_fetch_array($result)) {
					echo "user_id:".$row[0]."<br>";
					echo "username:".$row[1]."<br>"; //显示数据库的内容
				}
				*/
				$i= 30;
				while ($i>0){
					echo "dragoncat"."<br>" ;
					$i--;
				}
			?>
			<div class="pagination">
				<ul>
					<?php
						if ($page != 1) { //页数不等于1
							?>
							<li class="prev previous_page"><a href="myhistory.php?page=<?php echo $page - 1;?>">上一页</a></li> <!--显示上一页-->
							<?php
						}
						for ($i=1;$i<=$totalPage;$i++) {  //循环显示出页面
							?>
							<li><a href="myhistory.php?page=<?php echo $i;?>"><?php echo $i ;?></a></li>
							<?php
						}
						if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
							?>
							<li><a href="myhistory.php?page=<?php echo $page + 1;?>">下一页</a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
    </div>
</body>
	<!---------------------------导航右上角处理部分----------------------------------------------->
	<!---------------------------后面要用php写、、、、-------------------------------------------->
	<script>//右上角登陆处
		//php接口
		var logined=false;
		var username="dragoncat";
		//
		function insert()
		{
			if (logined){document.getElementById("login").innerHTML ="<a href='userhome.html' class='navbar-link'>"+username+"</a> &nbsp" }
			else document.getElementById("login").innerHTML ="<a href='login.html' class='navbar-link'>Login</a> &nbsp" ;
		}
		window.onload=insert();
	</script>
	<!-------------------------------------------------------------------------------------------->
</html>
