<?php	
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	if($_SESSION["logged"] != true){header("Location:".SERVERADDR."/moderncms/index.html"); exit();}
	echo "<html><head>
			<title>Modern CMS - Logged in as ".CMSLOGIN.". Main</title>
		<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
		<link href=".SERVERADDR."/moderncms/styles.css rel=stylesheet type=text/css />
		<link rel=shortcut icon href=".SERVERADDR."/images/favicon.jpg type=image/jpg>
		</head>
	<body>
	<script type=text/javascript src=".SERVERADDR."/moderncms/jquery.js></script>
	<style>
		#lefttab{float: left; width:25%;margin-left:26px;}
		#righttab{margin-left:25%;border:1px solid;border-radius:5px;}
	</style>
	<script>
		$(document).ready(remote);
		function remote(){
			$('input[type=button]').not('[value=in]').bind('click', remover);
			$('input[type=button]').not('[value=out]').bind('click', add);
		}
			function add(){	
				$('#yes:last').clone().appendTo('p:last');
				
				remote();
			}
			function remover(){
				$('#yes:last').remove();
			}
		</script>
			
			
			
	<div id=statustop> <p>Logged as <b>".$_SESSION["username"]."</b>&nbsp<a href=quit.php>Quit</a></p>
	</div>
	<br><br><br>
	<p class=header>VK Forum Parser</p><h3><a href=".SERVERADDR."/moderncms/main.php>Go Home</a></h3>
	<div id=lefttab>
	<a href = index.php>Refresh</a>";
	echo "</div><div id=righttab><p>Current connections:</p>"; 
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$i = 1;
	$serveraddr_var = SERVERADDR;
	$vkforumer = mysql_query("SELECT COUNT(*) from vkforummain WHERE `forum`='yes' AND `website`='$serveraddr_var'", $link);
	if(mysql_num_rows($vkforumer)){
		$totalforum = mysql_result($vkforumer, 0);
	}
	echo "<h2>Total forum:".$totalforum."</h2>";
	$vkforumer = mysql_query("SELECT COUNT(*) from vkforummsg WHERE `website`='$serveraddr_var'", $link);
	if(mysql_num_rows($vkforumer)){
		$totalforum = mysql_result($vkforumer, 0);
	}
	echo "<br><h2>Total messages:".$totalforum."</h2>";
	$vkforumer2 = mysql_query("SELECT * from vkparser WHERE `website`='$serveraddr_var'",$link);
	if(mysql_num_rows($vkforumer2)){
		while($out = mysql_fetch_array($vkforumer2)){
			echo $i.". ".$out["group_name"]."&nbsp&nbsptransfers to <b>".$out["category_select"]."</b>&nbsp&nbsp&nbsp<a href=index_2.php?group_name=".$out["group_name"]."><i><b>Upload forum</b></i></a>";
			$i++;
			echo "<br><small><small><i>Notice: if you want to manage VK groups, open App 'VK Parser' on the Main Page</i></small></small>";
		}
	}
	echo "<h3><a href=index_3.php>Export all links to file</a></h3></div>";
	mysql_close();
?>