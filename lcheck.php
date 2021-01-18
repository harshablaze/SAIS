<?php 
include("lib.php");

$username=makesafe($_POST['user_id']);
$password=makesafe($_POST['password']);

$lquery="SELECT * FROM `users` WHERE user_name='".$username."' AND `password`='".$password."'";

$lresp=db_query($lquery);
$lres=db_fetch_assoc($lresp);

$db_uname=$lres['user_name'];

if($db_uname==$username)
{
	if($lres['user_type']=='admin')
	{
		$_SESSION['admin_user_id']=$db_uname;
		header('location:admin/dashboard.php');
		exit;
	}
	if($lres['user_type']=='student')
	{		
		$_SESSION['user_id']=$db_uname;
		header('location:dashboard.php');
		exit;
	}
	
	header('location:signout.php');
	
}
else
{
	header('location:login.php?signIn=1');
}

?>