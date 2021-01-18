<?php 
include("lib.php");

$first_name=makesafe($_POST['first_name']);
$last_name=makesafe($_POST['last_name']);
$roll_no=makesafe($_POST['roll_no']);
$branch=makesafe($_POST['branch']);
$address=makesafe($_POST['address']);
$gender=makesafe($_POST['gender']);
$dob=makesafe($_POST['dob']);
$mobile=makesafe($_POST['mobile']);
$email=makesafe($_POST['email']);
$password=makesafe($_POST['password']);

$result=register_user($first_name,$last_name,$roll_no,$branch,$gender,$dob,$mobile,$email,$address,$password);

if($result)
{
	header('location:login.php');
}
else
{
	header('location:register.php');
}

?>