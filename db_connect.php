<?php
include($ROOT_PATH."db.php");

$dbServer="localhost";
$dbUsername="root";
$dbPassword="";
$dbDatabase="sais";

$tz='Asia/Calcutta';
$link=db_connect($dbServer, $dbUsername, $dbPassword,$dbDatabase);
date_default_timezone_set($tz);

?>