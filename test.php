<?php
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '\\');
		$extra="index.php";		
		$_SESSION["id"]="";
        echo $host.$uri.$extra;
		header("Location: http://$host$uri/$extra");
?>