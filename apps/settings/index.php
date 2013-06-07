<?php
	//Settings APP
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
	<script type=text/javascript src="<?php echo SERVERADDR; ?>"/moderncms/jquery.js></script>
	<div id="statustop"> <p>Logged as <b><?php echo $_SESSION["username"];?></b>&nbsp <a href="quit.php">Quit</a></p>
</div>
<br><br><br>
<p class="header">Settings</p><h3><a href="<?php echo SERVERADDR;?>/moderncms/main.php">Go Home</a></h3>
<div id="lefttab">
<p>Choose here:</p>
<?php
	$link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD); //If you have another MySQL login & password, change it here
	mysql_select_db(SQLDB, $link);
?>
			<a href=index.php?menu=appearance>Appearance</a><br>
			<a href=index.php?menu=connection>Connection (Config)</a><br>
			<a href=index.php?menu=users>Users (CMS)</a><br>
			<a href=index.php?menu=update>Update (check)</a><br></div>
<?php
	if((!isset($_GET["menu"])) || ($_GET["menu"] == "appearance")){
		echo "<div id='righttab'><h2>Appearance</h2>";
		echo "<form action='index.php?menu=change_background' METHOD=POST enctype=multipart/form-data><p><b>Background:</b></p><p>&nbsp&nbspUpload image: &nbsp
			
			<input type='file' name='filename'>&nbsp<input type='submit' value='Try to change'>
			</form></p><hr>";
	}
	if($_GET["menu"] == "change_background"){
	    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
    		move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER["DOCUMENT_ROOT"]."/moderncms/images/background.jpg");
    		echo "<div id='righttab'><h2>Appearance</h2>";
			echo "<form action='index.php?menu=change_background' METHOD=POST enctype=multipart/form-data><p><b>Background:</b></p><p>&nbsp&nbspUpload image: &nbsp
			
			<input type='file' name='filename'>&nbsp<input type='submit' value='Try to change'>
			<br>&nbsp&nbsp<i><font color=GREEN>Successfully changed, reload page to check</font></i></p></form><hr>";
    	}
    
    	else{
    		echo "<div id='righttab'><h2>Appearance</h2>";
			echo "<form action='index.php?menu=change_background' METHOD=POST enctype=multipart/form-data><p><b>Background:</b></p><p>&nbsp&nbspUpload image: &nbsp
			
			<input type='file' name='filename'>&nbsp<input type='submit' value='Try to change'>
			<i><font color=RED>Error</font></i></p></form><hr>";
    	}
	}
	if($_GET["menu"] == "connection"){
		echo "<div id='righttab'><h2>Connection</h2>";
		echo "<form action='index.php?menu=change_connection' METHOD=POST><p><b>MySQL Login</b><input type='text' name='sqllogin' value='".SQLLOGIN."'></p><p><b>MySQL Password</b><input type='text' name='sqlpwd' value='".SQLPWD."'></p><p><b>MySQL Database</b><input type='text' value='".SQLADDR."'></p><p><b>CMS Login</b><input type='text' name='cmslogin' value='".CMSLOGIN."'></p><p><b>CMS Password</b><input type='text' name='cmspwd' value='".CMSPWD."</p></form>";
	}
	if($_GET["menu"] == 'change_connection'){
		change_connection();
	}
	if($_GET["menu"] == "update"){
		echo "<div id='righttab'><h2>Updates already installed</h2><br></div>";
	}
?>