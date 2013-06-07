<?php
	//Database installer
	//include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	$link = mysql_connect("localhost", "root", ""); //If you have another MySQL login & password, change it here
	mysql_select_db("buildzone", $link);
	if($link == true){
		$install1 = mysql_query("CREATE TABLE apps (name TEXT NOT NULL, position INT(11) NOT NULL, sysname TEXT NOT NULL, img_link TEXT NOT NULL, button_size INT(11) NOT NULL);", $link);
		$install1_1 = mysql_query("INSERT INTO apps VALUES('Create', 1, 'create_new', 'create_new', 1);", $link);
		$install1_2 = mysql_query("INSERT INTO apps VALUES('Create Top',2, 'create_top', 'create_top',1);", $link);
			$install1_3 = mysql_query("INSERT INTO apps VALUES('Full Content Manage', 3, 'fullconman','fullconman', 2);", $link);
		$install1_4 = mysql_query("INSERT INTO apps VALUES('MySQL Explorer', 4, 'mysqlexpl', 'mysqlexpl',1);", $link);
		$install1_5 = mysql_query("INSERT INTO apps VALUES('Settings', 5, 'settings', 'settings', 1);", $link);
		$install1_6 = mysql_query("INSERT INTO apps VALUES('Apps', 6, 'apps','apps',1);", $link);
		$install2 = mysql_query("CREATE TABLE categories (name TEXT NOT NULL, sys_name TEXt NOT NULL, img_link TEXT NOT NULL);", $link);
		$install3 = mysql_query("CREATE TABLE news (id INT(11) NOT NULL, name TEXT NOT NULL, content TEXT NOT NULL, category TEXT NOT NULL, date DATE NOT NULL, important TEXT NOT NULL); ", $link);
		$install4 = mysql_query("CREATE TABLE topnews (id INT(11) NOT NULL, name TEXT NOT NULL, content TEXT NOT NULL, category TEXT NOT NULL, date DATE NOT NULL); ", $link);
		$install5 = mysql_query("CREATE TABLE widgets (name TEXT NOT NULL, progname TEXT NOT NULL, position INT(11) NOT NULL, active TEXT NOT NULL);", $link);
		mysql_close($link);		echo "GOOD";
		echo mysql_error(), mysql_errno();
	}
	else{
		echo "Something Wrong. Mysql Installation Abort.";
	}
?>
