<?php
include('header.php');
$cur_page='attendance';
include('side_menu.php');

$rnum=$_SESSION['user_id'];
$years=get_distinct_year_student($rnum);

?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
		<?php
		if(!empty($years))
		{
			foreach($years as $year)
			{
			?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-calendar-o"></i> <?php echo $year; ?></h3>
				</div>
				<div class="panel-body">
					<?php
					$attendance_all_months=get_attendance_student_year($rnum,$year);
					foreach($attendance_all_months as $month_data)
					{
						
						$working_days=$month_data['working_days'];
						$attended_days=$month_data['attended_days'];$absent=$absent=$working_days-$attended_days;
						if(empty($attended_days))
							$attended_days=0;
						if(empty($absent))
							$absent=0;
								
						?>
						<div class="col-md-3">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-calendar"></i> 
									<?php
										$jd=gregoriantojd($month_data['month'],01,$year);
										echo jdmonthname($jd,0); 
									?>
									</h3>
								</div>
								<div class="panel-body">
									<div class="col-md-12">
										<h4 class="text-success"><i>Attended:</i> <b><?php echo $attended_days; ?></b></h4>
										<h4 class="text-danger"><i>Absent:</i> <b><?php echo $absent; ?></b></h4>
									</div>
									<div class="col-md-12" style="min-height:120px;" id="chart_<?php echo$month_data['month'].$year; ?>">
									</div>
								</div>
							</div>
							<?php
								
								
							?>
							<script>
								$(document).ready(function(){
									Morris.Donut({
										element: 'chart_<?php echo$month_data['month'].$year; ?>',
										data: [{
											label: "Attended",			
											value: <?php echo $attended_days; ?>
										}, {
											label: "Absent",
											value: <?php echo $absent; ?>
										}],
										colors: [ "#66ba0d", "#bf0909" ],
										resize: true
									});
								});
							</script>
						</div>
						<?php						
					}
					?>
				</div>
			</div>
			<?php
			}
		}
		else
		{
			?>
			<div class="alert alert-info" style="margin-top:20%;margin-bottom:20%;">
				<center><h4><i class="fa fa-info-circle"></i> No Attendance Available</h4></center>
			</div>
			<?php
		}
		?>
			
		</div>
		<!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<script>
$(document).ready(function(){
    $('#dttable').DataTable();
  
});
</script>
<?php
   include('footer.php');
?>
