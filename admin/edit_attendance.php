<?php
include("../lib.php");

$attendance_id=$_REQUEST['id'];
$student_id=$_REQUEST['student_id'];

$attendance=get_attendance_id($attendance_id);

?>

<form class="form-horizontal" id="edit_attendance_form" action="attendance_submit.php" method="post" role="form">
	<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" /> 
	<input type="hidden" name="id" value="<?php echo $attendance_id; ?>" />
	  <div class="form-group">
		<label class="control-label col-sm-3" for="email">Student ID</label>
		<div class="col-sm-7">
			<label><?php echo $student_id; ?></label>
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-3" for="month">Month *</label>
		<div class="col-sm-7"> 
		  <select class="form-control" id="month" name="month" required>
			<option value=''></option>";
			<?php
			$k=0;
			$arr=array('January','February','March','April','May','June','July','August','September','October','November','December');
			for($i=1;$i<=12;$i++,$k++)
			{
				if($i==$attendance['month'])
					echo '<option value="'.$i.'" selected>'.$arr[$k].'</option>';
				else
					echo '<option value="'.$i.'" >'.$arr[$k].'</option>';
			}
			
			?>
		  </select>
		</div>
	  </div>
	  
	  <div class="form-group">
			<label class="control-label col-sm-3" for="year">Year *</label>
			<div class="col-sm-7">
				 <input type="text" class="form-control" id="year" name="year" value="<?php echo $attendance['year']; ?>" required> 
			 </div>
		</div>
	  
		<div class="form-group">
			<label class="control-label col-sm-3" for="working_days">Working Days *</label>
			<div class="col-sm-7">
				 <input type="text" class="form-control" id="working_days" name="working_days" value="<?php echo $attendance['working_days']; ?>" required> 
			 </div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" for="attended_days">Attended Days *</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="attended_days" name="attended_days" value="<?php echo $attendance['attended_days']; ?>" required> 
			</div>
		</div>
	</form>