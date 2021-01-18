<?php
header('location:students.php');
exit;
include('header.php');
$cur_page='profile';
include('side_menu.php');
?>
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
					<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-user fa-fw"></i> User Profile</h3>
						</div>
						<div class="panel-body">
						<?php
						$rnum=$_SESSION['user_id'];
						$profile=get_students_id($rnum);
						?>
							<table class="table table-bordered table-hover table-striped">
								<tbody>
									<tr>
										<td rowspan="6"><img src="images/profile.gif" style="height:100px;" class="img-responsive" /></td>
										<th>First Name</th>
										<td><?php echo $profile['first_name']; ?></td>
									</tr>
									<tr>
										<th>Last Name</th>
										<td><?php echo $profile['last_name']; ?></td>
									</tr>
									<tr>
										<th>Roll No</th>
										<td><?php echo $profile['roll_no']; ?></td>
									</tr>
									<tr>
										<th>Branch</th>
										<td><?php
											$branch=get_branches_id($profile['branch_id']);
											echo $branch['branch_name']; ?></td>
									</tr>
									<tr>
										<th>Email</th>
										<td><?php echo $profile['email']; ?></td>
									</tr>
									<tr>
										<th>Phone No</th>
										<td><?php echo $profile['phone_no']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					</div>
                </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php
   include('footer.php');
?>
