<?php
$username = "admin";
$password = "admin123";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");
  
$db_selected = mysql_select_db('resume_management_mysql', $dbhandle);  
?>