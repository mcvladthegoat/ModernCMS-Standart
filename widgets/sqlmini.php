<?php
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	if($_SESSION["logged"] != true){header("Location: ".SERVERADDR."/moderncms/index.html"); exit();}
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	if(!isset($_POST["query"])){header("Location: ".SERVERADDR."/moderncms/main.php"); exit();}
	$miniquery = mysql_query(strip_tags($_POST["query"]), $link);
	if(mysql_error()){
		header("Location: ".SERVERADDR."/moderncms/main.php?status=failed");
		exit();
	}
	mysql_close();
	header("Location: ".SERVERADDR."/moderncms/main.php?status=accepted");
	exit();
?>