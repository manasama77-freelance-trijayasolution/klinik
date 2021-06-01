<?php
	/*ini_set("display_errors", 0);
	error_reporting(0);*/

	$base_path		= "http://10.17.44.3/finger/";
	$db_name		= "demo_flexcodesdk";
	$db_user		= "root";
	$db_pass		= "";
	// $db_pass		= "m355age45";
	$db_host		= "localhost";
	//$db_host		= "127.0.0.1:3316";
	$time_limit_reg = "15";
	$time_limit_ver = "10";

	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	//if (!$conn) die("Connection for user $db_user refused!");
	//mysql_select_db($db_name, $conn) or die("Can not connect to database!");
?>