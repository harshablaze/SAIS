<?php
include('header.php');
$cur_page='attendance';
include('side_menu.php');
			
$all_attendance=get_attendance();
		
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			
			<button class="btn btn-success" data-toggle="modal" data-target="#add_new_attendace"> Add New</button>
			<br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Attendance</h3>
				</div>
				<div class="panel-body">
				<table class="table table-bordered table-striped" id="admin_att">
					<thead>
						<tr>
							<th>Student Id</th>
							<th>Name</th>
							<th>Month</th>
							<th>Year</th>
							<th>No of Working days</th>
							<th>No of attended days</th>
						</tr>
					</thead>
					<tbody>
					
					<?php
					foreach($all_attendance as $student_att)
					{
						echo '<tr>';
						echo '<td>'.$student_att['student_id'].'</td>';
						echo '<td>'.$student_att['first_name']." ".$student_att['last_name'].'</td>';
						$jd=gregoriantojd($student_att['month'],01,$student_att['year']);
						echo '<td>'.jdmonthname($jd,0).'</td>';
						echo '<td>'.$student_att['year'].'</td>';
						echo '<td>'.$student_att['working_days'].'</td>';
						echo '<td>'.$student_att['attended_days'].'</td>';
						echo '</tr>';
					}
					?>
					</tbody>
				</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add_new_attendace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="attendance_submit.php" method="post" role="form">
				
				  
				  <div class="form-group">
						<label class="control-label col-sm-3" for="id">ID </label>
						<div class="col-sm-7">
							 <input type="text" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" readOnly> 
						 </div>
					</div>
				  <div class="form-group">
					<label class="control-label col-sm-3" for="email">Student Roll Number</label>
					<div class="col-sm-7">
						<select class="form-control" id="student_id" name="student_id" required>
							<option value=''></option>";
							<?php
							$students=get_students();							
							foreach($students as $stu)
							{
								echo "<option value='".$stu['roll_no']."'>".$stu['roll_no']." / ".$stu['first_name']." ".$stu['last_name']."</option>";
							}
							
							?>				
						</select>
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
							echo "<option value=\"".$i."\"".($i==$data['month'] ? " selected class=\"$class\"" : " class=\"$selectedClass\"").">".$arr[$k]."</option>";
						
						}
						
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
						<label class="control-label col-sm-3" for="year">Year *</label>
						<div class="col-sm-7">
							 <input type="text" class="form-control" id="year" name="year" value="<?php echo $data['year']; ?>" required> 
						 </div>
					</div>
				  
					<div class="form-group">
						<label class="control-label col-sm-3" for="working_days">Working Days *</label>
						<div class="col-sm-7">
							 <input type="text" class="form-control" id="working_days" name="working_days" value="<?php echo $data['working_days']; ?>" required> 
						 </div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3" for="attended_days">Attended Days *</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="attended_days" name="attended_days" value="<?php echo $data['attended_days']; ?>" required> 
						</div>
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
    $('#admin_att').DataTable();
});
</script>
<?php
   include('footer.php');
?>
