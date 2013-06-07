<?php
	session_start();
	if($_SESSION["logged"] != true){header("Location: http://testzone.mcvlad.jino.ru/moderncms/index.html"); exit();}
	echo "<html><head>
<title>Modern CMS - Logged in as ".$login.". Main</title>
<meta http-equiv=Content-Type content=text/html; charset=utf-8 />
<link href=http://testzone.mcvlad.jino.ru/moderncms/styles.css rel=stylesheet type=text/css />
<link rel=shortcut icon href=/images/favicon.jpg type=image/jpg>
</head>
<body>
<script type=text/javascript src=jquery.js></script>
<style>
#lefttab{float: left; width:25%;margin-left:26px;}
#righttab{margin-left:25%;border:1px solid;border-radius:5px;}
	#createcategory{
				position: absolute;
				max-width: 400px;
				background-color: #CCCCFF;
				   color: #71653a;
				       border: 1px solid #71653a;
    border-radius: 10px;
    padding: 20px;
	}
</style>";
	echo"<div id=statustop> <p>Logged as <b>".$_SESSION["username"]."</b>&nbsp<a href=quit.php>Quit</a></p>
</div>
<br><br><br>
<p class=header>Full Content Manage</p><h3><a href=http://testzone.mcvlad.jino.ru/moderncms/main.php>Go Home</a></h3>
<div id=lefttab>
<p>Choose here:</p>";