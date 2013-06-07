<?php
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	if($_SESSION["logged"] != true){header("Location: ".SERVERADDR."/moderncms/index.html"); exit();}
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	if($_GET["func"] == "group_del"){
		$vkdel = mysql_query("DELETE from rssparser WHERE site_addr='$_GET[group_name]' AND website = '$serveraddr_var'", $link);
		mysql_close($link);
		header("Location: index.php");
		exit();
	}
	if($_GET["func"] == "group_create"){
		$vknew = mysql_query("INSERT into rssparser VALUES('$_POST[group_name]', 'true', '$_POST[category_select]', '$serveraddr_var')", $link);
		mysql_close($link);
		header("Location: index.php");
		exit();
	}
?>