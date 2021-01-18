<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Academic Information System</title>
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link id="bsdp-css" href="css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>   
<?php
include('lib.php');
$branches=get_branches();
?>     
<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Student Academic Information System</a>
		</div>
	</nav>
<br>
        <div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Register</h3>
						</div>
						<div class="panel-body">
							<form role="form" method="POST" action="register_new.php">
								<fieldset>	
									<div class="form-group">
										<input class="form-control" placeholder="First Name" name="first_name" type="text" required />
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Last Name" name="last_name" type="text" required />
									</div>
									<div class="form-group">
										<input class="form-control"  maxlength="10" placeholder="Roll No" name="roll_no" type="text" required >
									</div>
									<div class="form-group">
										<select class="form-control" name="branch" required >
										<option value="">Select Branch</option>
										<?php
										foreach($branches as $branch)
										{
											echo '<option value="'.$branch['branch_id'].'">'.$branch['branch_name'].'</option>';
										}
										?>											
										</select>
									</div>
									<div class="form-group">
										<div class="col-xs-6"><label><input  name="gender"  type="radio" required /> Male</label></div>
										<div class="col-xs-6"><label><input name="gender" type="radio" required /> Female</label></div>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Date of Birth" id="dob" name="dob" type="text" required />
									</div>
									<div class="form-group">
										<textarea required class="form-control" placeholder="Address" id="address" name="address" ></textarea>
									</div>									
									<div class="form-group">
										<input required class="form-control" placeholder="Mobile" id="Mobile" name="mobile" type="text" value="" maxlength="10"/>
										<span style="color:red;font-size:10px;" id="mob_div"></span>
									</div>
									<div class="form-group">
										<input required class="form-control" placeholder="E-mail" name="email" type="email" />
									</div>
									<div class="form-group">
										<input required class="form-control" placeholder="Password" name="password" type="password" />
									</div>							
									<!-- Change this to a button or input when using this as a form -->
									<button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#dob').datepicker();
		$("#Mobile").keypress(function (e) {
			 //if the letter is not digit then display error and don't type anything
			 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				//display error message
				$("#mob_div").html("Digits Only").show().fadeOut("slow");
					   return false;
			}
		   });
	</script>

</body>

</html>
