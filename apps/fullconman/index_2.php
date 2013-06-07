<?php
	session_start();
	if($_SESSION["logged"] != true){header("Location: http://testzone.mcvlad.jino.ru/moderncms/index.html"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	if($_GET["func"] == "news-del"){
			$query = mysql_query("DELETE from news where id='$_GET[id]' AND website = '$serveraddr_var'", $link);
			header("Location: index.php");
	}
	if($_GET["func"] == "cat-del"){
		$query = mysql_query("DELETE from categories where sys_name='$_GET[name]' AND website = '$serveraddr_var'", $link);
		header("Location: index.php?menu=categories");
	}
	if($_GET["func"] == "cat-create"){
		$query = mysql_query("INSERT INTO categories VALUES('$_POST[name]', '$_POST[sysname]', '', '$serveraddr_var')", $link);
			header("Location: index.php?menu=categories");
	}
?>