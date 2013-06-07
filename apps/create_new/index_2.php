<?php
	session_start();
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	if($_SESSION["logged"] != true){header("Location: ".SERVERADDR."/moderncms/index.html"); exit();}
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
	$date = date("Y.m.d");
	$categories = implode($_POST['categories']);
	$publish = mysql_query("INSERT INTO news VALUES('', '$_POST[my_name]', '$_POST[text]' ,'$categories', '$date', 'no', '$serveraddr_var')", $link);
	$getsome = mysql_query("SELECT id from news WHERE name = '$_POST[my_name]' AND website = '$serveraddr_var'", $link);
	if(mysql_num_rows($getsome)){
		while($out = mysql_fetch_array($getsome)){
			$id = $out["id"];
		}
	}
			
foreach($_FILES['images']['name'] as $k=>$f) {
  if (!$_FILES['images']['error'][$k]) {
    if (is_uploaded_file($_FILES['images']['tmp_name'][$k])) {
      move_uploaded_file($_FILES['images']['tmp_name'][$k], "photos/".$_FILES['images']['name'][$k]);
	  rename("photos/".$_FILES['images']['name'][$k], "photos/".$id."_".$k.".jpg");
    }
  }
}
	header("Location: index.php");
?>