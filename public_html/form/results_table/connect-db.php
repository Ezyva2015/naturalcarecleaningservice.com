<?php
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

 // Database Variables (edit with your own server information)
 $server = 'localhost';
 $user = 'natural_wp';
 $pass = 'xECxw{Q0f-';
 $db = 'natural_wp';
 
 // Connect to Database
 $connection = mysql_connect($server, $user, $pass) 
 or die ("Could not connect to server ... \n" . mysql_error ());
 mysql_select_db($db) 
 or die ("Could not connect to database ... \n" . mysql_error ());


?>
