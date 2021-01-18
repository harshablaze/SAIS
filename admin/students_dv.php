<?php
if(!isset($_REQUEST['student_id']) || empty($_REQUEST['student_id']))
{
	header("location:students.php");
	exit;
}
include('header.php');
$cur_page='students';
include('side_menu.php');

$student_id=$_REQUEST['student_id'];

$years=get_distinct_year_student($student_id);
?>
<style>
.alert-custom
{
	position: absolute;
    top: 60px;
    left: 30%;
    z-index: 1;
    opacity: 0.95;
    padding: 0px;
	width:50%;
}
.alert-custom h4
{
	margin-top: 10px;
}
</style>

<div id="page-wrapper">
<?php
	if($_REQUEST['att_status']=='1')
		echo '<center><div id="info_alert" class="alert-custom alert alert-success"><h4><i class="fa fa-info-circle"></i> Attendance added Successfully</h4></div></center>';
	if($_REQUEST['att_status']=='0')
		echo '<center><div id="info_alert" class="alert-custom alert alert-warning"><h4><i class="fa fa-warning"></i> Attendance adding Failed</h4></div></center>';

	if($_REQUEST['fee_status']=='1')
		echo '<center><div id="info_alert" class="alert-custom alert alert-success"><h4><i class="fa fa-info-circle"></i> Fee added Successfully</h4></div></center>';
	if($_REQUEST['fee_status']=='0')
		echo '<center><div id="info_alert" class="alert-custom alert alert-warning"><h4><i class="fa fa-warning"></i> Fee adding Failed</h4></div></center>';

	if($_REQUEST['delete']=='1')
		echo '<center><div id="info_alert" class="alert-custom alert alert-success"><h4><i class="fa fa-check"></i> Deleted  Successfully</h4></div></center>';
	if($_REQUEST['delete']=='0')
		echo '<center><div id="info_alert" class="alert-custom alert alert-warning"><h4><i class="fa fa-times"></i> Delete Failed</h4></div></center>';


?>
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-3">
				<a class="btn btn-danger" href="students.php"><i class="fa fa-arrow-left"></i> Back</a>
			</div>
		</div>
		<br>

		<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-calendar-o"></i> Attendance<button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#add_new_attendace"><i class="fa fa-plus"></i> Add Attendance</button></h3>
			</div>
			<div class="panel-body">
			<?php
			if(!empty($years))
			{
				foreach($years as $year)
				{
				?>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-calendar-o"></i> <?php echo $year; ?></h3>
					</div>
					<div class="panel-body">
					<table class="table table-bordered table-striped" id="admin_att_<?php echo $year; ?>">
						<thead>
							<tr>
								<th>Month</th>
								<th>Year</th>
								<th>Working days</th>
								<th>Attended days</th>
								<th>Absent days</th>
								<th>Edit / Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$attendance_all_months=get_attendance_student_year($student_id,$year);
						foreach($attendance_all_months as $month_data)
						{

							$working_days=$month_data['working_days'];
							$attended_days=$month_data['attended_days'];$absent=$absent=$working_days-$attended_days;
							if(empty($attended_days))
								$attended_days=0;
							if(empty($absent))
								$absent=0;

							$jd=gregoriantojd($month_data['month'],01,$year);

							echo '<tr>';
								echo '<td>'.jdmonthname($jd,1).'</td>';
								echo '<td>'.$year.'</td>';
								echo '<td>'.$working_days.'</td>';
								echo '<td>'.$attended_days.'</td>';
								echo '<td>'.$absent.'</td>';
								echo '<td><button class="btn btn-info" name="edit_attendance" id="'.$month_data['id'].'"><i class="fa fa-edit"></i></button><button class="btn btn-danger" name="delete_attendance" id="'.$month_data['id'].'"><i class="fa fa-trash"></i></button></td>';
							echo '</tr>';

						}
						?>
						</tbody>
					</table>
					</div>
					<script>
						$(document).ready(function(){
							$('#admin_att_<?php echo $year; ?>').DataTable();
						});
					</script>
				</div>
				<?php
				}
			}
			else
			{
				?>
				<div class="alert alert-info">
					<center><h4><i class="fa fa-info-circle"></i> No Attendance Available</h4></center>
				</div>
				<?php
			}
			?>
			</div>
		</div>
		</div>

		<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-calendar-o"></i> Fee Details<button class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#add_new_fee"><i class="fa fa-plus"></i> Add Fee</button></h3>
			</div>
			<div class="panel-body">
			<table id="admin_fee_table" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Fee</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Edit / Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$fee_details=get_fee_details_id($student_id);
				foreach($fee_details as $fee)
				{
					echo '<tr>';
					echo '<td>'.$fee['fee_description'].'</td>';
					echo '<td>'.$fee['fee_amount'].'</td>';
					if($fee['pay_status']=='1')
						echo '<td>Paid</td>';
					else
						echo '<td>Due</td>';

					echo '<td><button class="btn btn-info" name="edit_fee" id="'.$fee['id'].'"><i class="fa fa-edit"></i></button><button class="btn btn-danger" name="delete_fee" id="'.$fee['id'].'"><i class="fa fa-trash"></i></button></td>';

					echo '</tr>';

				}
				?>
				</tbody>
			</table>
			<script>
				$(document).ready(function(){
					$('#admin_fee_table').DataTable();
				});
			</script>
			</div>
		</div>
		</div>

		<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-calendar-o"></i> Student E-books</h3>
			</div>
			<div class="panel-body">
			<table id="dttable" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>File</th>
						<th>Last Downloaded</th>
						<th>Download</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$certificates=get_certificates_student_id($student_id);
				foreach($certificates as $certificate)
				{
					echo '<tr>';
					echo '<td>'.$certificate['file_description'].'</td>';
					echo '<td>'.$certificate['last_downloaded'].'</td>';
					echo '<td class="text-center"><a target="_blank" name="last_downloaded" href="download_cert.php?cert='.$certificate['id'].'&action=download"><i class="fa fa-download fa fa-2x"></i></a></td>';
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



<!--Edit Attendance Modal start-->
<div class="modal fade" id="edit_attendace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Attendance</h4>
			</div>
			<div class="modal-body">


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="edit_att_submit" class="btn btn-primary">Save changes</button>

			</div>
		</div>
	</div>
</div>
<!--Edit Attendance Modal end -->

<!--Add Attendance Modal start-->
<div class="modal fade" id="add_new_attendace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="attendance_submit.php" method="post" role="form">

				<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />

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
<!--Add Attendance Modal end -->

<!--Delete Attendance Modal start-->
<div class="modal fade" id="delete_attendace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Attendance</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h4>Are You Sure To Delete this Record?</h4>
				</div>
				<form id="delete_attendance_form" action="attendance_submit.php" method="POST">
					<input type="hidden" name="delete_id" id="delete_att_id" />
					<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" id="delete_att_submit" class="btn btn-danger">Delete</button>

			</div>
		</div>
	</div>
</div>
<!--Delete Attendance Modal end -->



<!--Add Fee Modal start-->
<div class="modal fade" id="add_new_fee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Fee </h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="add_fee_details.php" method="post" role="form">

				<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />

				  <div class="form-group">
					<label class="control-label col-sm-3" for="email">Student ID</label>
					<div class="col-sm-7">
						<label><?php echo $student_id; ?></label>
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-sm-3" for="fee_amount">Fee Amount *</label>
					<div class="col-sm-7">
					  <input type="text" class="form-control" id="fee_amount" name="fee_amount" required />
					</div>
				  </div>

				  <div class="form-group">
						<label class="control-label col-sm-3" for="fee_desc">Fee Description *</label>
						<div class="col-sm-7">
							 <textarea class="form-control" id="fee_desc" name="fee_desc" required></textarea>
						 </div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="fee_desc">Pay Status *</label>
						<div class="col-sm-7">
							 <select class="form-control" id="pay_status" name="pay_status" required>
								<option value="0">UnPaid</option>
								<option value="1">Paid</option>
							 </select>
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
<!--Add Fee Modal end -->


<!--Edit Fee Modal start-->
<div class="modal fade" id="edit_fee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Fee Details</h4>
			</div>
			<div class="modal-body">


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="edit_fee_submit" class="btn btn-primary">Save changes</button>

			</div>
		</div>
	</div>
</div>
<!--Edit Fee Modal end -->


<!--Delete Attendance Modal start-->
<div class="modal fade" id="delete_fee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Fee Details</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h4>Are You Sure To Delete this Record?</h4>
				</div><br><br>
				<form id="delete_fee_form" action="add_fee_details.php" method="POST">
					<input type="hidden" name="delete_id" id="delete_fee_id" />
					<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" id="delete_fee_submit" class="btn btn-danger">Delete</button>

			</div>
		</div>
	</div>
</div>
<!--Delete Attendance Modal end -->



<script>
$(document).ready(function(){
    $('#students').DataTable();
	setTimeout(function(){
		$('#info_alert').fadeOut('slow');
	},2000);
});

// Attendance Script start
$('button[name=edit_attendance]').click(function(){
	var att_id=$(this).attr('id');
	var student_id="<?php echo $student_id; ?>";
	$('#edit_attendace .modal-body').load('./edit_attendance.php?id='+att_id+'&student_id='+student_id);
	$('#edit_attendace').modal('show');
});
$('#edit_att_submit').click(function(){
	$('#edit_attendance_form').submit();
});

$('button[name=delete_attendance]').click(function(){
	var att_id=$(this).attr('id');
	var student_id="<?php echo $student_id; ?>";
	$('#delete_att_id').val(att_id);
	$('#delete_attendace').modal('show');
});
$('#delete_att_submit').click(function(){
	$('#delete_attendance_form').submit();
});

// Attendance Script end


// Fee Script start
$('button[name=edit_fee]').click(function(){
	var fee_id=$(this).attr('id');
	var student_id="<?php echo $student_id; ?>";
	$('#edit_fee .modal-body').load('./edit_fee.php?id='+fee_id+'&student_id='+student_id);
	$('#edit_fee').modal('show');
});
$('#edit_fee_submit').click(function(){
	$('#edit_fee_form').submit();
});

$('button[name=delete_fee]').click(function(){
	var fee_id=$(this).attr('id');
	var student_id="<?php echo $student_id; ?>";
	$('#delete_fee_id').val(fee_id);
	$('#delete_fee').modal('show');
});
$('#delete_fee_submit').click(function(){
	$('#delete_fee_form').submit();
});

// Fee Script end


</script>
<?php
   include('footer.php');
?>
