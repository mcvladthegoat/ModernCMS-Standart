<?php
	include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
	echo "<form action=".CMSDIR."/widgets/sqlmini.php method=post>SQL Mini - query<input type=text name=query>&nbsp<input type=submit value=Query>".$_GET["status"]."</form>";
?>