<?php

	include("../lib.php");
	$data['id']=$_POST['id'];
	$data['delete_id']=$_POST['delete_id'];
	$data['student_id']=$_POST['student_id'];
	$data['fee_description']=$_POST['fee_desc'];
	$data['fee_amount']=$_POST['fee_amount'];
	$data['pay_status']=$_POST['pay_status'];

	if(!empty($data['delete_id']))
	{
		$res=delete_fee_details_fee_id($data['delete_id']);
		if($res)
			header("location:./students_dv.php?student_id=".$data['student_id']."&delete=1");
		else
			header("location:./students_dv.php?student_id=".$data['student_id']."&delete=0");
		
		exit;
	}
	
	if(!empty($data['id']))
	{
		$res=fee_details_update($data);
	}
	
	if(empty($data['id']))
	{
		$res=fee_details_insert($data);		
	}
	
	
	
	
	
	if($res)
		header("location:./students_dv.php?student_id=".$data['student_id']."&fee_status=1");
	else
		header("location:./students_dv.php?student_id=".$data['student_id']."&fee_status=0");


?>