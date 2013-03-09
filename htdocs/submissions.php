<!DOCTYPE html>
<html>
<head>
    <title>Submissions</title>
    <link rel='stylesheet' href='bootstrap/bootstrap.css' />
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
		iframe {
		width:100%;
		height: 45px;
	  }
	   #footer {
        height: 60px;
        background-color: #f5f5f5;
      }
	  #push {height: 300px;}
    </style>
</head>
<body> 
	<div class="navbar navbar-inverse navbar-fixed-top">
		<iframe name="headf" id="headf" src="head.html" frameborder=0 scrolling="no"></iframe>
	</div>

	<div id="container" class="container">
		<center><h1>Submissions</h1></center>
		  <table class="table table-striped">
			<thead>
				<tr><th>User</th><th>Game</th><th>Version</th><th>Submit Date</th><th>Size</th><th>Status</th></tr>
			</thead>
			<tbody>
			<?php
				$perNumber=30; 
				$page=@$_GET['page']; 
				require("dbconnect.php");
				$count=mysql_query("select count(*) from tprog"); 
				
				$rs=mysql_fetch_array($count);
				$totalNumber=$rs[0];
				$totalPage=ceil($totalNumber/$perNumber); 
				if (!isset($page)) {
					$page=1;
				} 
				$startCount=($page-1)*$perNumber; 
				$result=mysql_query("select * from tprog limit $startCount,$perNumber");
				
				$write=""; 
				while ($row=mysql_fetch_array($result)) {
					$write.="<tr><td><a href='#'>".$row[1]."</a></td><td></td><td>".$row[0]."</td><td>".$row[2]."</td><td></td><td>".$row[3]."</td></tr>";
				}
				echo $write;	
			?>
			</tbody>
		  </table>

			<div class="pagination">
				<ul>
					<?php
						if ($page != 1) { 
							?>
							<li class="prev previous_page"><a href="pkhistory.php?page=<?php echo $page - 1;?>">上一页</a></li> <!--显示上一页-->
							<?php
						}
						for ($i=1;$i<=$totalPage;$i++) {  
							?>
							<li><a href="pkhistory.php?page=<?php echo $i;?>"><?php echo $i ;?></a></li>
							<?php
						}
						if ($page<$totalPage) { 
							?>
							<li><a href="pkhistory.php?page=<?php echo $page + 1;?>">下一页</a></li>
							<?php
						}
					?>
				</ul>
			</div>
	</div>
	<div id="push"></div>
	<div id="footer">
      <div class="container">
        <center><p>Copyright &copy METIS &nbsp | &nbsp 2013</p></center>
      </div>
    </div>
</body>
</html>