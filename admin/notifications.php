<?php
include_once('header.php');

$cur_page='notifications';
include('side_menu.php');

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-file-o fa-fw"></i> Notifications</h3>
				</div>
				<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-success" id="new_notification_create_modal"><i class="fa fa-plus-circle"></i> Add New</button>
					</div>
				</div>
				<br>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#latest">Latest</a></li>
						<li><a data-toggle="tab" href="#others">Others</a></li>
					</ul>
					<div class="tab-content" id="tab_content">
						<?php
							$notifications=get_notification_data();
							foreach($notifications as $notifi)
							{
							?>
							<div class="panel panel-default" style="margin-bottom: 0px;">
								<div class="panel-body" style="padding: 10px;"><a href="<?php echo $notifi['url'];?>" class="_blank cvplbd" target="_blank" data-wpel-link="internal"><?php echo $notifi['name']?></a></div>
							</div>
							<?php
							}
							?>
					
					</div>
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

<div class="modal fade" id="upload_notification_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" >Create Notification</h4>
			</div>
			<div class="modal-body">
			<form>
					<input type="hidden" name="action" value="create" />
					<div class="form-group">
						<label class="control-label col-sm-3" for="year">Add description*</label>
						<div class="col-sm-7">
							 <input type="text" class="form-control" id="notification_description" name="notification_description" value="" required> 
						 </div>
					</div>	
					<div class="form-group">
						<label class="control-label col-sm-3" for="working_days">URL*</label>
						<div class="col-sm-7">
							 <input type="text" class="form-control" id="notification_url" name="notification_url" value="" required> 
						 </div>
					</div>
					<br><br><br><br>	
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button  id="notification_submit_id" class="btn btn-primary">Save changes</button>
			</form>
			</div>
		</div>
	</div>
</div>


<script>
$('#new_notification_create_modal').click(function(){
	$('#upload_notification_modal').modal('show');
});

$('#notification_submit_id').click(function(){
	var url = $('#notification_url').val();
	var des = $('#notification_description').val();
	$.ajax({
			url: 'notification_submit.php',type: 'POST', 
			data:{'add_notification':'yes','des':des, 'url':url},
			dataType: 'json',
			success:function(resp)
			{				
				window.load("notifications.php");
			}
		});
});
</script>