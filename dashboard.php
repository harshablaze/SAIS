<?php
if(isset($_POST['action']))
{
	include('lib.php');
	if($_POST['action']=='update')
	{
		$res=move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "images/profile/".$_FILES["profile_pic"]["name"]);
		if($res)
		{
			$pic_location="images/profile/".$_FILES["profile_pic"]["name"];

			$user['phone_no']=makesafe($_POST['phone_no']);
			$user['email']=makesafe($_POST['email']);
			$user['roll_no']=$_SESSION['user_id'];
			$user['profile_pic']=makesafe($pic_location);

			$res=students_update($user);
			header('location:dashboard.php');
			exit;
		}
	}
}
include_once('header.php');
$cur_page='profile';
include('side_menu.php');
?>
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
					<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-user fa-fw"></i> User Profile <a id="edit_profile" class="pull-right"><i class="fa fa-edit"></i></a></h3>

						</div>
						<div class="panel-body">
						<?php
						$rnum=$_SESSION['user_id'];
						$profile=get_students_id($rnum);
						?>
							<table class="table table-bordered table-hover table-striped">
								<tbody>
									<tr>
										<?php
											if(!empty($profile['profile_pic']))
												$img=$profile['profile_pic'];
											else
												$img='images/profile.gif';
										?>
										<td rowspan="6">
											<img src="<?php echo $img; ?>" style="height:150px,width:85px;" class="img-responsive" /></td>
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

<div class="modal fade" id="NewStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" >Edit Profile</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="dashboard.php"  enctype="multipart/form-data" >
					<input type="hidden" name="action" value="update" />
					<input type="text" placeholder="Phone No" name="phone_no" class="form-control" value="<?php echo $profile['phone_no']; ?>" />
					<br>
					<input type="email" placeholder="Email" name="email" class="form-control" value="<?php echo $profile['email']; ?>" />
					<br>
					<?php
						if(!empty($profile['profile_pic']))
							$img=$profile['profile_pic'];
						else
							$img='images/profile.gif';
					?>
					<img src="<?php echo $img; ?>" style="height:100px;" class="img-responsive"/>
					<input type="file" value="Change Pic" name="profile_pic" accept="image/x-png,image/gif,image/jpeg" />

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
	$('#edit_profile').click(function(){
		$('#NewStudentModal').modal('show');
	});
</script>
<?php
   include('footer.php');
?>
