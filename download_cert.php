<?php
include('lib.php');
$cert['student_id']=$_SESSION['user_id'];
$cert_id=makesafe($_REQUEST['cert']);
$path=download_certificate($cert_id);
if($path)
{
	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary");
	header("Content-disposition: attachment; filename=\"".basename($path)."\""); 
	
	echo readfile($path);

}
?>