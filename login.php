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
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 
   <!--[if lt IE 9]>
    
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   
     <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
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
<br><br>
        <div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
							<form role="form" method="POST" action="lcheck.php">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="User Id" name="user_id" type="text" autofocus="">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="">
									</div>
									<a href="#" class="pull-right">Forgot Password?</a><br><br>
								
									<!-- Change this to a button or input when using this as a form -->
									<button type="submit" class="btn btn-lg btn-success btn-block">Login</a>
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
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
