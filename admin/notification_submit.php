<?php

include("../lib.php");

if(isset($_POST['add_notification']) && $_POST['add_notification']='yes')
{
	$data_des = $_POST['des'];
	$data_url = $_POST['url'];
	$query=db_query("INSERT INTO `notifications`(`name`, `url`) VALUES ('".$data_des."','".$data_url."')");
	if($query == true)
	$data['status']='success';
	else
	$data['status']='fail';	
	echo json_encode($data);
}

?>