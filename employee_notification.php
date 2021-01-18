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
