<?php
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$try = mysql_query("SELECT login, pwd FROM cms_settings", $link);
		if($_SESSION["logged"] !=true){
			if (($_POST["login"] != CMSLOGIN) || ($_POST["pwd"] != CMSPWD)){
				header("Location: index.html");
			}
			$_SESSION["logged"] = true;
			$_SESSION["username"] = CMSLOGIN;
		}
		$numofnews = mysql_query("SELECT COUNT(*) from news", $link);
		//$numofnews_var = mysql_result($numofnews, 0);
		
?>
<html><head>
			<title>Modern CMS - Logged in as <?php echo CMSLOGIN;?> Main</title>
		<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
		<link href=styles.css rel=stylesheet type=text/css />
		<link rel=shortcut icon href=/images/favicon.jpg type=image/jpg>
	</head>
	<body>
	<div id="statustop"> <p>Logged as <b> <?php echo CMSLOGIN;?> </b>&nbsp<a href="quit.php">Quit</a></p>
	</div>&nbsp&nbsp
	<?php
		include_once(CMSDIR."/widgetizer.php");
	?>
	<br><br><br>
	<p class="header">Main</p>
	<p class="header">Total news: <b><?php if($numofnews_var != 0){echo $numofnews_var;} else{echo "not exist";} ?></b></p><br>
	<div class="menu">
	<?php
		$firstportion = mysql_query("SELECT * FROM apps", $link);
		if(mysql_num_rows($firstportion)){
			while($out = mysql_fetch_array($firstportion)){
				$name = $out["name"];
				$position = $out["position"];
				$sysname = $out["sysname"];
				$website = $out["website"];
				$img_link = $out["img_link"];
				$button_size = $out["button_size"];
				
				echo "<a href = apps/".$sysname."/index.php>";
				if($button_size == "1"){
					echo "<img src=images/".$img_link."1.png alt=".$name." width=160 height=160></a>";
				}
				if($button_size == "2"){
					echo "<img src=images/".$img_link."2.png alt=".$name." width=372 height=160></a>";
				}
			}
		}
		echo "<br><br>";
		echo "<div id=statusbottom>";
		if($ajax == "true"){
		}
		else{
			echo "<a href=about.php>About</a>&nbsp&nbsp";
		}
		echo "</div></body></html>";
	
	
?>
		