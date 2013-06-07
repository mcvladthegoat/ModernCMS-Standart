<?php	
	session_start();
	if($_SESSION["logged"] != true){header("Location:".SERVERADDR."/moderncms/index.html"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
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
		<p class=header>RSS Parser</p><h3><a href=".SERVERADDR."/moderncms/main.php>Go Home</a></h3>
	<div id=lefttab>
	<a href = index.php>Refresh</a>";
	echo "</div><div id=righttab><p>Current connections:</p>"; 
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$i = 1;
	$serveraddr_var = SERVERADDR;
	$rss_get = mysql_query("SELECT * from rssparser WHERE website = '$serveraddr_var'", $link);
	if(mysql_num_rows($rss_get)){
		while($out = mysql_fetch_array($rss_get)){
			echo $i.". ".$out["site_addr"]."&nbsp&nbsptransfers to <b>".$out["category_select"]."</b>&nbsp&nbsp&nbsp<a href=index_2.php?func=group_del&group_name=".$out["site_addr"]."><i><u>Delete this select</u></i></a>&nbsp&nbsp<a href=index_3.php?group_name=".$out["site_addr"]."><i><b>Upload all news</b></i></a>";
			$i++;
			echo "<br>";
		}
	}
	echo "<br>";
	echo SERVERADDR;
	echo "<p>Add new RSS XML file:</p>";
	echo "<form action=index_2.php?func=group_create method=POST>
			<p>Full adress-><input type=text name=group_name></p>
			<p>Category to export(sysname)-><input type=text name=category_select></p>
			<input type=submit value='set up'>
			</form>";
	mysql_close($link);
?>