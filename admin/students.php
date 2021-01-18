<?php
include('header.php');
$cur_page='students';
include('side_menu.php');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Students</h3>
				</div>
				<div class="panel-body">

				<?php
				$students=get_students();
				?>
				<br>
				<br>
					<table id="students" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Roll No</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Branch</th>
								<th>Phone No</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach($students as $student)
						{
							echo '<tr>';
							echo '<td><a href="students_dv.php?student_id='.$student['roll_no'].'">'.$student['roll_no'].' <i class="fa fa-external-link-square"></i></a></td>';
							echo '<td>'.$student['first_name'].'</td>';
							echo '<td>'.$student['last_name'].'</td>';
							echo '<td>'.$student['branch_name'].'</td>';
							echo '<td>'.$student['phone_no'].'</td>';
							echo '<td>'.$student['email'].'</td>';
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


<script>
$(document).ready(function(){
    $('#students').DataTable();
});
</script>
<?php
   include('footer.php');
?>
