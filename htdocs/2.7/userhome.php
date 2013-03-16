<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome to your home</title>
    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 50px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
	  .myAI{
		/* background-color:red; */
 		font-size:20px;
		font-family:楷体;
		margin-top: 10px;
		margin-left:30px;
	  }
	  .tablecenter{
		text-align:center;
		width:100%;
	  }
	  input,button {
		border-radius:50% 50% 50% 50%; background-color: white; height: 30px; width:100px; 
	  }
    </style>	
	<script>
		function DeleteAi(var num) 
		{

		}

	</script>
</head>

<body>
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
	<div class="myAI">
		<p style="font-size:30px">mydragoncat</p><br>
		<hr>

		<table class="tablecenter">
			<thead>
				<p><strong>User Information</strong></p>
				<hr>
				<tr>
					<td style="width:15%">User name:</td><td style="width:10%">mydragoncat</td><td></td>
				    <td style="width:15%">Age:</td><td style="width:15%">18</td><td></td>
				</tr>
				<tr>
					<td style="width:15%">School:</td><td style="width:15%">NJU</td><td></td>
				    <td style="width:15%">Major:</td><td style="width:15%">Computer Science</td><td></td>
				</tr>
				<tr>
					<td style="width:15%">Country:</td><td style="width:15%">China</td><td></td>
				    <td style="width:15%">Grade:</td><td style="width:15%">大一</td><td></td>
				</tr>
				<tr>
					<td style="width:15%">Email:</td><td style="width:15%">njuxudong@vip.qq.com</td><td></td>
				    <td style="width:15%">:</td><td style="width:15%">Computer Science</td><td></td>
				</tr>
			</thead>
		</table>
		<hr>

        <table class="tablecenter" >
			<thead>
				<p><strong>My AI</strong></p>
				<hr>
				<th style="width:2%">Num</th>
				<th style="width:15%">Submit time</th>
				<th style="width:10%">Status</th>
				<th style="width:20%">AI name</th>
				<!--  下面三个如果觉得没必要可以删掉 -->
				<th>Win</th>  
				<th>All</th>
				<th>Rate</th>
				<!--    -->
				<th style="width:35%">Delete</th>
			</thead>
			<tr><td>1</td> <td>2013-1-1</td> <td>pass</td> <td><a href="#">学姐学妹</a></td> <td>87</td> <td>100</td> <td>87%</td><td><input type="submit" value="delete" onclick="DeleteAi(1)"/></td></tr>
			<!-- 输出所有提交的AI
			<?php
				$result=mysql_query("select * from user limit $startCount,$perNumber") ;
				while ($row=mysql_fetch_array($result)) {
					echo "<tr><td>1</td> <td>2013-1-1</td> <td>pass</td> <td><a href='#'>学姐学妹</a></td> <td>87</td> <td>100</td> <td>87%</td><td><input type='submit' value='delete' onclick='DeleteAi(1)'/></td></tr> ";
				}
			?>
			-->
		</table>
		<!--------------------------------------------------------------------->
		<center><form method="post" enctype="multipart/form-data">
			<input name="submit_ai" type="file" /><br>
			<input type="submit" value="submit" name='submit_button' />
		</form></center>
		<?php
			if (@$_POST['submit_button'])
			{
				$maxsize =  1  ;  //文件限制
				if ($_FILES['submit_ai']['name']!='')
				{
					$myfile= $_FILES['submit_ai'];
					if ($myfile['size']>0 && $myfile['size']< $maxsize ) 
					{
						$dir = ''; //保存目录
						if (! is_dir($dir))	mkdir($dir);  //创建目录
						$name = $myfile['name'];
						
						$path = '' ; //这里通过处理组合起来文件路径及名字
						$i = move_uploaded_file($myfile['tmp_name'],$path);  //复制上传
						if ($i == ture) echo "<script> alert('Uploaded successfully!'); </script>" ;
						else echo "<script> alert('Failed to upload!'); </scirpt>";	
					}else echo "<script> alert('File is too big!'); </script>";
					
				}
			}
			?>
		<hr>
		<!---------------------------------------------------------------------->
	</div>
	<center><a href="http://localhost:8080/myhistory.php"><h2>My pk history<h2></a></center>
	
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
