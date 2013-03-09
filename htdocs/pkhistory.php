<!DOCTYPE HTML>
<html>
<head>
	<link href="bootstrap/bootstrap.css" rel="stylesheet">
	<title>PK history</title>
	<style>
		iframe {
			width:100%;
			height: 45px;
	    }
		body {
			padding-top: 50px;
		}
	</style>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<iframe name="headf" id="headf" src="head.html" frameborder=0 scrolling="no"></iframe>
	</div>
	
	<div id="contents">
		<div class="container">
			<h1><center>PK history</center></h1>
			<?php
				$perNumber=30; //每页显示的记录数
				$page=@$_GET['page']; //获得当前的页面值
				require("dbconnect.php");
				$count=mysql_query("select count(*) from tbattle"); //获得记录总数
				
				$rs=mysql_fetch_array($count);
				$totalNumber=$rs[0];
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				if (!isset($page)) {
					$page=1;
				} //如果没有值,则赋值1
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$result=mysql_query("select * from tbattle limit $startCount,$perNumber"); //根据前面的计算出开始的记录和记录数

				
				while ($row=mysql_fetch_array($result)) {
					echo "user_id1:".$row[0].".VS.";
					echo "user_id2:".$row[1]."<br>"; //显示数据库的内容
				}
			?>
			<div class="pagination">
				<ul>
					<?php
						if ($page != 1) { //页数不等于1
							?>
							<li class="prev previous_page"><a href="pkhistory.php?page=<?php echo $page - 1;?>">上一页</a></li> <!--显示上一页-->
							<?php
						}
						for ($i=1;$i<=$totalPage;$i++) {  //循环显示出页面
							?>
							<li><a href="pkhistory.php?page=<?php echo $i;?>"><?php echo $i ;?></a></li>
							<?php
						}
						if ($page<$totalPage) { //如果page小于总页数,显示下一页链接
							?>
							<li><a href="pkhistory.php?page=<?php echo $page + 1;?>">下一页</a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
    </div>
</body>
</html>
