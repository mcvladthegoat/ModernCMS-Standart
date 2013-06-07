<?php
	session_start();
	if($_SESSION["logged"] != true){header("Location: http://testzone.mcvlad.jino.ru/moderncms/index.html"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	echo "<html><head>
			<title>Modern CMS - Logged in as ".CMSLOGIN.". Main</title>
		<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
		<link href=".SERVERADDR."/moderncms/styles.css rel=stylesheet type=text/css />
		<link rel=shortcut icon href=/images/favicon.jpg type=image/jpg>
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
	<p class=header>Create Top</p><h3><a href=".SERVERADDR."/moderncms/main.php>Go Home</a></h3>
	<div id=lefttab>
	<p>Choose current categories:<br>
		<form action=index_2.php method=POST enctype=multipart/form-data>";
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$category = mysql_query("SELECT * FROM categories WHERE website = '$serveraddr_var'", $link);
	if(mysql_num_rows($category)){
			while($out = mysql_fetch_array($category)){
				$name = $out["name"];
				$sysname = $out["sysname"];
			//	$img_link = $out["img_link"];
				echo"
				
	<p><input type=checkbox name=categories[] value=".$sysname.">".$name."</p>";
			}
		}
		echo "</p></div><div id=righttab><p><table><tr><td>Title<input type=text name=my_name><br></td></tr>
		<tr><td><textarea rows=30 cols=70 name=text>Type here what you want for TOP of news</textarea></td></tr>";
		echo "<br><tr><td><input type=submit value=Publish></p></td></tr>
		<tr><td><p>Upload images with your article/news <span id=yes><input type=file name=images[]>&nbsp<input type=button value=in>&nbsp<input type=button value=out><br></span></p></td></tr></table>";
		echo "</form>
			</div></body></html>";
?>