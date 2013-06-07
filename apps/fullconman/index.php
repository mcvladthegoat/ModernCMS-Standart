<?php
	session_start();
	if($_SESSION["logged"] != true){header("Location: index.html"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
?>
<html><head>
	<title>Modern CMS - Logged in as <?php echo CMSLOGIN; ?> Main</title>
	<meta http-equiv="Content-Type" content=text/html; charset=utf-8 />
	<link href="<?php echo SERVERADDR;?>/moderncms/styles.css" rel=stylesheet type=text/css />
	<link rel=shortcut icon href="/images/favicon.jpg" type="image/jpg">
</head>
<body>
	<script type=text/javascript src="<?php echo CMSLOGIN; ?>"/moderncms/jquery.js></script>
	<div id="statustop"> <p>Logged as <b><?php echo $_SESSION["username"];?></b>&nbsp<a href="quit.php">Quit</a></p>
</div>
<br><br><br>
<p class="header">Full Content Manage</p><h3><a href="<?php echo SERVERADDR;?>/moderncms/main.php">Go Home</a></h3>
<div id="lefttab">
<p>Choose here:</p>
<?php
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
?>			<a href=index.php?menu=allnews>All news</a><br>
			<a href=index.php?menu=categories>Categories</a><br>
			<a href=index.php?menu=photogal>Photo Gallery</a><br>
			<a href=index.php?menu=users>Users</a><br>
			<a href=index.php?menu=logo-title>Logo & title</a><br></div>
<?php
	if((!isset($_GET["menu"])) || ($_GET["menu"] == "allnews")){
		echo "<div id='righttab'><p>All news:</p>";
		$getnews = mysql_query("SELECT * from news", $link);
		//$i = 1;
		echo "<table>";
		if(mysql_num_rows($getnews)){
			while($out = mysql_fetch_array($getnews)){	
				echo "<tr><td>".$out["id"].". ".$out["name"]."</td><td>&nbsp&nbsp<i><a href='index_2.php?func=news-edit&id=".$out["id"]."'>Edit</a></td>&nbsp <td> <a href='index_2.php?func=news-del&id=".$out["id"]."'></i><i>Delete</a></td></i><td>&nbspDate: ".$out["date"]."</td></tr><br><br>";

			}
		}
		echo "</p></table></p>";
	}
	if($_GET["menu"] == "categories"){
		echo "<div id=righttab><p>Categories:</p>";
		$getcat = mysql_query("SELECT * from categories", $link);
		if(mysql_num_rows($getcat)){
			while($out = mysql_fetch_array($getcat)){
				echo "<tr><td>".$out["name"]."&nbsp  <a href='index_2.php?func=cat-del&name=".$out["sys_name"]."'></td><td><i>Delete</i></a></td></tr><br>";
			}
		}
		echo "<br>or <u><a href='index.php?menu=cat-create'>Create new category</a></u><br><br>";
		
	}
	if($_GET["menu"] == "cat-create"){
		echo "<div id='createcategory'>
		<h2> Create new category</h2>
		<form action='index_2.php?func=cat-create' method=POST>
		<p>Name:<input type='text' name='name'></p>
		<p>System name: <input type='text' name='sysname'></p>
		<input type='submit' value='Create'>
		</form>
		</div>";
	}
?>