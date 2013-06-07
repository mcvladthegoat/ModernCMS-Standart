<?php
	$widget = mysql_query("SELECT * from widgets ORDER BY position", $link);
	
	if(mysql_num_rows($widget)){
		while($out = mysql_fetch_array($widget)){
			echo "<div class=widget>";
			include_once(CMSDIR."/widgets/".$out["progname"]."_1.php");
			echo "</div>\n";
		}
	}

?>
	