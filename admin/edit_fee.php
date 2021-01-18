<?php
include("../lib.php");

$fee_id=$_REQUEST['id'];
$student_id=$_REQUEST['student_id'];

$fee=get_fee_details_fee_id($fee_id);

?>

<form class="form-horizontal" id="edit_fee_form" action="add_fee_details.php" method="post" role="form">
	<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" /> 
	<input type="hidden" name="id" value="<?php echo $fee['id']; ?>" />	
	  <div class="form-group">
		<label class="control-label col-sm-3" for="email">Student ID</label>
		<div class="col-sm-7">
			<label><?php echo $student_id; ?></label>
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-3" for="fee_amount">Fee Amount *</label>
		<div class="col-sm-7"> 
		  <input type="text" class="form-control" id="fee_amount" name="fee_amount" required value="<?php echo $fee['fee_amount']; ?>"/>						
		</div>
	  </div>
	  
	  <div class="form-group">
			<label class="control-label col-sm-3" for="fee_desc">Fee Description *</label>
			<div class="col-sm-7">
				 <textarea class="form-control" id="fee_desc" name="fee_desc" required><?php echo $fee['fee_description']; ?></textarea>		
			 </div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="fee_desc">Pay Status *</label>
			<div class="col-sm-7">
				 <select class="form-control" id="pay_status" name="pay_status" required>
					<?php 
						if($fee['pay_status']=='1')
						{
							?>
							<option value="0">UnPaid</option>
							<option value="1" selected>Paid</option>
							<?php
						}
						else
						{
						?>
							<option value="0">UnPaid</option>
							<option value="1">Paid</option>
							<?php
						}
						?>
				 </select>		
			 </div>
		</div>
</form>