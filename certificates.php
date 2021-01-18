<?php
if(isset($_REQUEST['action']))
{
	include('lib.php');
	if($_POST['action']=='create')
	{
		$res=move_uploaded_file($_FILES["upload_cert"]["tmp_name"], "images/profile/".$_FILES["upload_cert"]["name"]);
		if($res)
		{
			$pic_location="images/profile/".$_FILES["upload_cert"]["name"];
			
			$cert['file_description']=makesafe($_POST['file_desc']);
			$cert['student_id']=$_SESSION['user_id'];
			$cert['file_location']=makesafe($pic_location);
			
			$res=certificates_insert($cert);
			header('location:certificates.php');
			exit;
		}
	}
	if($_POST['action']=='delete')
	{
		$cert=$_POST['cert_id'];
		$res=certificates_delete($cert);
		if($res)
			header('location:certificates.php?deleted=1');
		else
			header('location:certificates.php?deleted=0');
		exit;
	}	
}
include_once('header.php');

$cur_page='certificate';
include('side_menu.php');

$student_id=$_SESSION['user_id'];
$certificates=get_certificates(yyyy);

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
<?php

	if($_REQUEST['deleted']=='1')
		echo '<center><div id="info_alert" class="alert-custom alert alert-success"><h4><i class="fa fa-check"></i> Deleted  Successfully</h4></div></center>';
	if($_REQUEST['deleted']=='0')
		echo '<center><div id="info_alert" class="alert-custom alert alert-warning"><h4><i class="fa fa-times"></i> Delete Failed</h4></div></center>';

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-file-o fa-fw"></i> E-books</h3>
				</div>
				<div class="panel-body">
				<!--<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" id="new_cert_modal"><i class="fa fa-plus-circle"></i> Add New</button>
					</div>
				</div>
				<br>-->
					<table id="dttable" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>File</th>
								<th>Last Downloaded</th>
								<th>Download</th>
								<!--<th>Delete</th>-->
							</tr>
						</thead>
						<tbody>
						<?php
						foreach($certificates as $certificate)
						{
							echo '<tr>';
							echo '<td>'.$certificate['file_description'].'</td>';
							echo '<td>'.$certificate['last_downloaded'].'</td>';
							echo '<td class="text-center"><a target="_blank" name="last_downloaded" href="download_cert.php?cert='.$certificate['id'].'&action=download"><i class="fa fa-download fa fa-2x"></i></a></td>';
							/*echo '<td class="text-center"><a href="#" name="delete_cert" id="'.$certificate['id'].'"><i class="text-danger fa fa-times fa fa-2x"></i></a></td>';*/
							echo '</tr>';
							
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


	
<div class="modal fade" id="upload_cert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" >Upload Certifcate</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="certificates.php"  enctype="multipart/form-data" >
					<input type="hidden" name="action" value="create" />
					
					<label>
						Upload Certifcate
					</label>
					<input type="file" class="form-control col-xs-12" name="upload_cert" accept="image/x-png,image/gif,image/jpeg" required />	
					
					<br>
					<label>
						File Description
					</label>
					<textarea placeholder="File Description" name="file_desc" class="form-control col-xs-12" required ></textarea>		
					<br><br><br><br>	
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="delete_cert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" >Delete Certifcate</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					<h4>Are You Sure To Delete this Certificate?</h4>
				</div><br><br>	
				<form method="POST" id="delete_certificate_form" action="certificates.php"  enctype="multipart/form-data" >	
					<input type="hidden" name="action" value="delete" />				
					<input type="hidden" name="cert_id" id="cert_id" />	
				</form>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="del_cert_submit" class="btn btn-danger">Delete</button>
				
			</div>
		</div>
	</div>
</div>

<script>
$('#new_cert_modal').click(function(){
	$('#upload_cert_modal').modal('show');
});

$('a[name=delete_cert]').click(function(){
	var id=$(this).attr('id');
	$('#cert_id').val(id);
	$('#delete_cert_modal').modal('show');
});


$('#del_cert_submit').click(function(){
	$('#delete_certificate_form').submit();
});
</script>
<script>
$(document).ready(function(){
    $('#dttable').DataTable();
	
	setTimeout(function(){
		$('#info_alert').fadeOut('slow');
	},2000);
});
</script>
<?php
   include('footer.php');
?>
