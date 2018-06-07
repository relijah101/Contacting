<?php

	//ip address or the name of the server that host this database
	$dbhost="localhost";
	//database name
	$dbname="contact_database";
	$user="root";
	//password by defaul
	$pwd="mysql";
	// to connect database and php
	$con=mysql_connect($dbhost,$user,$pwd)or die("failed to establish connection");
	//to select database connected
	$db=mysql_select_db($dbname) or die("failed to select database");
	
?>