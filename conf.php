<?php
	//Объявление основных параметров SQL, каталогов и адресов.
	define("SQLLOGIN", "root");
	define("SQLADDR", "localhost");
	define("SQLPWD", "");
	define("SQLDB", "buildzone");
	define("CMSLOGIN", "admin", true);
	define("CMSPWD", "1234", true);
	define("SERVERADDR", "http://localhost");
	define("CMSDIR", $_SERVER["DOCUMENT_ROOT"]."/moderncms");
	$serveraddr_var = SERVERADDR; // Пришлось сделать для SQL запросов
?>