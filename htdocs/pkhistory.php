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
				$perNumber=30; //ÿҳ��ʾ�ļ�¼��
				$page=@$_GET['page']; //��õ�ǰ��ҳ��ֵ
				require("dbconnect.php");
				$count=mysql_query("select count(*) from tbattle"); //��ü�¼����
				
				$rs=mysql_fetch_array($count);
				$totalNumber=$rs[0];
				$totalPage=ceil($totalNumber/$perNumber); //�������ҳ��
				if (!isset($page)) {
					$page=1;
				} //���û��ֵ,��ֵ1
				$startCount=($page-1)*$perNumber; //��ҳ��ʼ,���ݴ˷����������ʼ�ļ�¼
				$result=mysql_query("select * from tbattle limit $startCount,$perNumber"); //����ǰ��ļ������ʼ�ļ�¼�ͼ�¼��

				
				while ($row=mysql_fetch_array($result)) {
					echo "user_id1:".$row[0].".VS.";
					echo "user_id2:".$row[1]."<br>"; //��ʾ���ݿ������
				}
			?>
			<div class="pagination">
				<ul>
					<?php
						if ($page != 1) { //ҳ��������1
							?>
							<li class="prev previous_page"><a href="pkhistory.php?page=<?php echo $page - 1;?>">��һҳ</a></li> <!--��ʾ��һҳ-->
							<?php
						}
						for ($i=1;$i<=$totalPage;$i++) {  //ѭ����ʾ��ҳ��
							?>
							<li><a href="pkhistory.php?page=<?php echo $i;?>"><?php echo $i ;?></a></li>
							<?php
						}
						if ($page<$totalPage) { //���pageС����ҳ��,��ʾ��һҳ����
							?>
							<li><a href="pkhistory.php?page=<?php echo $page + 1;?>">��һҳ</a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
    </div>
</body>
</html>
