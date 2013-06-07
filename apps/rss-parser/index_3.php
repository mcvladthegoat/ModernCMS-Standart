<?php
  //RSS Parser
  include_once($_SERVER["DOCUMENT_ROOT"]."/moderncms/conf.php"); //All settings in conf.php
  if(!isset($_GET)){header("Location: index.php"); exit();}
  $link = mysql_connect(SQLADDR, SQLLOGIN, SQLPWD);
  mysql_select_db(SQLDB, $link);
  $day = date("Y-m-d");
      $i = 0;
      $obj = simplexml_load_string(file_get_contents($_GET["group_name"]));
      while($obj->channel->item[$i]->title != ""){
        $title = $obj->channel->item[$i]->title;
        $indoor = $obj->channel->item[$i]->description;
        $check = mysql_query("SELECT * from news WHERE content = '$indoor' AND website = '$serveraddr_var'", $link);
        if(mysql_num_rows($check) == ""){
          $inserter = mysql_query("INSERT INTO news VALUES('','$title', '$indoor', '','$day', '', '$serveraddr_var')", $link);
      }
      $i++;
      }
      header("Location: index.php");
?>