<?php
	session_start();
	if($_SESSION["logged"] != true){header("Location: http://testzone.mcvlad.jino.ru/moderncms/index.html"); exit();}
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$date = date("Y.m.d H:m:s");
	$categories = implode($_POST['categories']);
	$publish = mysql_query("INSERT INTO topnews VALUES('', '$_POST[my_name]', '$categories','$date', '$_POST[text]', '$serveraddr_var')", $link);
	$getsome = mysql_query("SELECT id from topnews WHERE name = '$_POST[my_name]' AND website = '$serveraddr_var'", $link);
	if(mysql_num_rows($getsome)){
		while($out = mysql_fetch_array($getsome)){
			$id = $out["id"];
		}
	}
			
foreach($_FILES['images']['name'] as $k=>$f) {
  if (!$_FILES['images']['error'][$k]) {
    if (is_uploaded_file($_FILES['images']['tmp_name'][$k])) {
      move_uploaded_file($_FILES['images']['tmp_name'][$k], $_SERVER['DOCUMENT_ROOT']."/".$_FILES['images']['name'][$k]);
	  rename("photos/".$_FILES['images']['name'][$k], $_SERVER['DOCUMENT_ROOT']."/".$id."_".$k.".jpg");
    }
  }
}