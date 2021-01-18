<?php
include('header.php');
$cur_page='fee';
include('side_menu.php');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-file-o fa-fw"></i> Fee Details</h3>
				</div>
				<div class="panel-body">
					<table id="dttable" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Fee</th>
								<th>Amount</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$rnum=$_SESSION['user_id'];
						$fee_details=get_fee_details_id($rnum);
						foreach($fee_details as $fee)
						{
							echo '<tr>';
							echo '<td>'.$fee['fee_description'].'</td>';
							echo '<td>'.$fee['fee_amount'].'</td>';
							if($fee['status']=='1')
								echo '<td>Paid</td>';
							else
								echo '<td>Due</td>';
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


<script>
$(document).ready(function(){
    $('#dttable').DataTable();
});
</script>
<?php
   include('footer.php');
?>
