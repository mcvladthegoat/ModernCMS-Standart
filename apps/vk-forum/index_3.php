<?php
	session_start();
	if(!isset($_GET)){header("Location: index.php"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php");
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$expforum = fopen('vkforum_links.txt', 'w');
	fclose($expforum);
	$expforum = fopen('vkforum_links.txt', 'a');
	$getforum = mysql_query("SELECT * from vkforummain WHERE `forum`='yes' AND website='$serveraddr_var'", $link);
	if(mysql_num_rows($getforum)){
		while ($out = mysql_fetch_array($getforum)) {
			$buffer = SERVERADDR."/join-discuss.php?name=".urlencode($out["name"]);
			fwrite($expforum, $buffer."\n");
		}
	}
	mysql_close();
	fclose($expforum);
	header("Content-Disposition: attachment; filename=vkforum_links.txt"); 
	header("Content-type: application/octet-stream"); 
	echo file_get_contents('vkforum_links.txt'); 
?>