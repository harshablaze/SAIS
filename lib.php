<?php
error_reporting(E_ERROR);
$ROOT_PATH = __DIR__ . '/';
include($ROOT_PATH."db_connect.php");
session_start();
db_query("CREATE TABLE IF NOT EXISTS `notifications` (  `id` int( 10  )  unsigned NOT  NULL  AUTO_INCREMENT , `name` varchar( 100  )  NOT  NULL , `url` varchar( 200  )  NOT  NULL , PRIMARY  KEY (  `id`  )  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1");
function makesafe($string)
{
	$string=(get_magic_quotes_gpc() ? stripslashes($string) : $string);
	return db_escape($string);		
}
	
function sqlValue($statment){
	// executes a statment that retreives a single data value and returns the value retrieved
	if(!$res=db_query($statment)){
		return FALSE;
	}
	if(!$row=db_fetch_array($res)){
		return FALSE;
	}
	return $row[0];
}

function register_user($first_name,$last_name,$roll_no,$branch,$gender,$dob,$mobile,$email,$address,$password)
{
	$y_o_joining=substr($roll_no,0,2);
	$y_o_joining="20".$y_o_joining;
	$password=$password;
	
	$q="INSERT INTO `students`(`roll_no`, `first_name`, `last_name`, `dob`, `address`, `phone_no`, `email`, `branch_id`, `y_o_joining`) VALUES ('".$roll_no."','".$first_name."','".$last_name."','".$dob."','".$address."','".$mobile."','".$email."','".$branch."','".$y_o_joining."')";
	
	$res=db_query($q);
	
	$q1="INSERT INTO `users`(`user_name`, `password`, `email`, `user_type`) VALUES ('".$roll_no."','".$password."','".$email."','student')";
	
	$res1=db_query($q1);
	
	if($res)
		return TRUE;
	
	return FALSE;
}

function get_attendance($from_date=false,$to_date=false)
{	
	$data=array();
	$q="SELECT att.id, att.student_id, att.month, att.year, att.working_days, att.attended_days,st.first_name,st.last_name FROM `attendance` att LEFT OUTER JOIN students st ON st.roll_no=att.student_id ";
	if(empty($from_date) && empty($to_date))
	{
		$prev_month=date('m', strtotime('-1 month'));
		$prev_month=str_replace("0","",$prev_month);
		$q.=" WHERE month='".$prev_month."'";
	}

	$result=db_query($q);
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}



function get_attendance_id($id)
{
	$q="SELECT * FROM `attendance` WHERE `id`='$id'";
	$result=db_query($q);
	return db_fetch_assoc($result);
}

function delete_attendance_id($id)
{
	$q="DELETE FROM `attendance` WHERE `id`='$id'";
	$result=db_query($q);
	return true;
}


function attendance_insert($data)
{
	$query="INSERT INTO `attendance`(`student_id`, `month`, `year`, `working_days`, `attended_days`) VALUES ('".$data['student_id']."','".$data['month']."','".$data['year']."','".$data['working_days']."','".$data['attended_days']."')";
	
	db_query($query);
	return $query;
}

function attendance_update($data)
{
	$query="UPDATE `attendance` SET `student_id`='".$data['student_id']."',`month`='".$data['month']."',`year`='".$data['year']."',`working_days`='".$data['working_days']."',`attended_days`='".$data['attended_days']."' WHERE `id`='".$data['id']."'";
	
	db_query($query);
	return true;
}

function get_branches()
{	
	$data=array();
	$result=db_query("SELECT * FROM `branches`");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_branches_id($id)
{
	$result=db_query("SELECT * FROM `branches` WHERE `branch_id`='$id'");
	return db_fetch_assoc($result);
}

function branches_insert($data)
{
	$query="INSERT INTO `branches`(`branch_name`) VALUES ('".$data['branch_name']."')";
	db_query($query);
	return true;
}

function branches_update($data)
{
	$query="UPDATE `branches` SET `branch_name`='".$data['branch_name']."' WHERE `branch_id`='".$data['branch_id']."'";
	db_query($query);
	return true;
}

function get_certificates()
{
	$data=array();
	$result=db_query("SELECT * FROM `certificates`");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_certificates_student_id($student_id)
{
	$result=db_query("SELECT * FROM `certificates` WHERE `student_id`='$student_id'");
	while($row=db_fetch_assoc($result))
	{
		$data[]=$row;
	}
	return $data;
}

function certificates_insert($data)
{
	$query="INSERT INTO `certificates`(`student_id`, `file_location`, `file_description`, `last_downloaded`) VALUES ('".$data['student_id']."', '".$data['file_location']."', '".$data['file_description']."', NOW())";
	
	db_query($query);
	return true;
}

function certificates_update($data)
{
	$query="UPDATE `certificates` SET `student_id`='".$data['student_id']."',`file_location`='".$data['file_location']."',`file_description`='".$data['file_description']."',`last_downloaded`='".$data['last_downloaded']."' WHERE `id`='".$data['id']."'";

	db_query($query);
	return true;
}


function certificates_delete($cert_id)
{
	$query="DELETE FROM `certificates` WHERE `id`='".$cert_id."' ";	
	$res=db_query($query);
	if($res)
		return true;
		
	return false;
}

function download_certificate($cert_id)
{
	$query="UPDATE `certificates` SET `last_downloaded`=NOW() WHERE `id`='".$cert_id."' ";
	
	$res=db_query($query);

	$path=sqlValue("SELECT file_location FROM certificates WHERE `id`='".$cert_id."'");
	if($res)
		return $path;
	else
		return false;
}

function get_fee_details()
{
	$data=array();
	$result=db_query("SELECT * FROM `fee_details`");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_fee_details_id($id)
{
	$result=db_query("SELECT * FROM `fee_details` WHERE `student_id`='$id'");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_fee_details_fee_id($id)
{
	$result=db_query("SELECT * FROM `fee_details` WHERE `id`='$id'");
	$row=db_fetch_assoc($result);
		
	
	return $row;
}

function delete_fee_details_fee_id($id)
{
	$q="DELETE FROM `fee_details` WHERE `id`='$id'";
	$result=db_query($q);

	if($result)
		return true;
	else
		return false;
}

function fee_details_insert($data)
{
	$query="INSERT INTO `fee_details`(`student_id`, `fee_description`, `fee_amount`, `pay_status`) VALUES ('".$data['student_id']."', '".$data['fee_description']."', '".$data['fee_amount']."', '".$data['pay_status']."')";
	db_query($query);
	return true;
}

function fee_details_update($data)
{
	$query="UPDATE `fee_details` SET `student_id`='".$data['student_id']."',`fee_description`='".$data['fee_description']."',`fee_amount`='".$data['fee_amount']."',`pay_status`='".$data['pay_status']."' WHERE `id`='".$data['id']."'";
	
	db_query($query);
	return true;
}

function get_students()
{
	$data=array();
	$result=db_query("SELECT st.roll_no, st.first_name, st.last_name, st.dob, st.address, st.phone_no, st.email, st.branch_id, st.y_o_joining, st.last_login,br.branch_name FROM students st LEFT OUTER JOIN branches br ON br.branch_id=st.branch_id");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_students_id($rnum)
{
	$result=db_query("SELECT * FROM `students` WHERE `roll_no`='$rnum'");
	return db_fetch_assoc($result);
}

function students_insert($data)
{
	$query="INSERT INTO `students`(`roll_no`, `first_name`, `last_name`, `dob`, `address`, `phone_no`, `email`, `branch_id`, `y_o_joining`, `last_login`) VALUES ('".$data['roll_no']."', '".$data['first_name']."', '".$data['last_name']."', '".$data['dob']."', '".$data['address']."', '".$data['phone_no']."', '".$data['email']."', '".$data['branch_id']."', '".$data['y_o_joining']."', '".$data['last_login']."')";
	
	db_query($query);
	return true;
}

function students_update($data)
{
	$query="UPDATE `students` SET `phone_no`='".$data['phone_no']."',`email`='".$data['email']."',profile_pic='".$data['profile_pic']."' WHERE `roll_no`='".$data['roll_no']."'";
	
	db_query($query);
	return true;
}

function get_subjects()
{
	$data=array();
	$result=db_query("SELECT * FROM `subjects`");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

function get_subjects_id($subcode)
{
	$result=db_query("SELECT * FROM `subjects` WHERE `subject_code`='$subcode'");
	return db_fetch_assoc($result);
}

function subjects_insert($data)
{
	$query="INSERT INTO `subjects`(`subject_code`, `subject_name`, `branch_id`, `subect_year`) VALUES ('".$data['subject_code']."', '".$data['subject_name']."', '".$data['branch_id']."', '".$data['subect_year']."')";
	
	db_query($query);
	return true;
}

function subjects_update($data)
{
	$query="UPDATE `subjects` SET `subject_name`='".$data['subject_name']."',`branch_id`='".$data['branch_id']."',`subect_year`='".$data['subect_year']."' WHERE `subject_code`='".$data['subject_code']."'";
	
	db_query($query);
	return true;
}

function get_distinct_year_student($student_id)
{
	
	$q="SELECT DISTINCT year FROM attendance WHERE student_id='".$student_id."' ORDER BY year ASC";	
	$res=db_query($q);
	$data=array();
	while($row=db_fetch_assoc($res))
	{
		array_push($data,$row['year']);
	}
	
	return $data;
}

function get_attendance_student_year($student_id,$year)
{
	$q="SELECT * FROM attendance WHERE student_id='".$student_id."' AND year='".$year."' ORDER BY month ASC";	
	$res=db_query($q);
	while($row=db_fetch_assoc($res))
	{
		$data[]=$row;
	}
	return $data;
}

function get_notification_data()
{
	$data=array();
	$result=db_query("SELECT name, url FROM notifications");
	if(db_num_rows($result) > 0)
	{
		while($row=db_fetch_assoc($result))
		{
			$data[]=$row;
		}
	}
	
	return $data;
}

?>