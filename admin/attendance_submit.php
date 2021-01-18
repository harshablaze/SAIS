<?php

include("../lib.php");

$data=$_POST;

if(empty($data['id']))
{
	$res=attendance_insert($data);		
}
if(!empty($data['id']))
{
	$res=attendance_update($data);
}
if(!empty($data['delete_id']))
{
	$res=delete_attendance_id($data['delete_id']);
	if($res)
		header("location:./students_dv.php?student_id=".$data['student_id']."&delete=1");
	else
		header("location:./students_dv.php?student_id=".$data['student_id']."&delete=0");
	
	exit;
}

if($res)
	header("location:./students_dv.php?student_id=".$data['student_id']."&att_status=1");
else
	header("location:./students_dv.php?student_id=".$data['student_id']."&att_status=0");


?>