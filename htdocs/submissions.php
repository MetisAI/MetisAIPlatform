<!DOCTYPE html>
<html>
<head>
    <title>Submissions</title>
    <link href='bootstrap/bootstrap.css' rel='stylesheet' >
    <link href='bootstrap/body.css' rel='stylesheet' >

	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">
        $("document").ready(function(){$("body").hide();});
        $.post(
			'check_logined.php',
            function(data)
            {
                if (data == "NO" || data.length>40)
                {
					document.getElementById("register").innerHTML ="<a href='register.html' class='navbar-link'>Register</a> &nbsp" ;
					document.getElementById("login").innerHTML ="<a href='login.html' class='navbar-link'>Login</a> &nbsp" ;
                    $("body").show();
                }
                else
				{
                    document.getElementById("login").innerHTML ="<a href='userhome.html' class='navbar-link'>"+data+"</a> &nbsp";
                    document.getElementById("logout").innerHTML ="&nbsp<a href='#' onclick ='logout()' class='navbar-link'>logout</a>"
                    $("body").show();
                }
            }
        );
        function logout()
        {
            $.post(
                'logout.php',
                function(data){location.href="index.html";}
            );
        }
    </script>
</head>
	
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner" >
			<div class="container-fluid">
				<a class="brand" href="index.html">METIS</a>
				<div class="nav-collapse collapse">
					<p class="navbar-text pull-right" id="logout"></p>
					<p class="navbar-text pull-right" id="register">
					<p class="navbar-text pull-right" id="login"></p>		
					<ul class="nav">
						<li><a href="index.html">Home</a></li>
						<li><a href="games.html">Games</a></li>
						<li><a href="submissions.php">Submissions</a></li>
						<li><a href="aboutme.html">About METIS</a></li>
					</ul>

				</div>
			</div>
		</div>
	</div>
	
	<div id="fbody">
	<div id="container" class="container">
		<br><br><br>
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
					$write.="<tr><td><a href='#'>".$row[1]."</a></td><td></td><td>".$row[0]."</td><td>".$row[2]."</td><td></td><td>";
					if ($row[3]=="pass") $write.=$row[3]."</td></tr>";
					else $write.="<img src='picture/loading.gif'></td></tr>";
				
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
	</div>


	<div id="push"></div>
	<div id="footer">
      <div class="container">
        <center><p>Copyright &copy METIS &nbsp | &nbsp 2013</p></center>
      </div>
    </div>
</body>
</html>